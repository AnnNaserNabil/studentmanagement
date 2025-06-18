# Use PHP 8.3 FPM as base
FROM php:8.3-fpm

# Install system dependencies with build essentials
RUN apt-get update && apt-get install -y \
    nginx \
    procps \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    libpng-tools \
    libjpeg-dev \
    libfreetype6-dev \
    libwebp-dev \
    libssl-dev \
    libicu-dev \
    libpq-dev \
    libxpm-dev \
    libvpx-dev \
    default-mysql-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) pdo_mysql mbstring gd zip opcache intl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy only necessary files for production
COPY --chown=www-data:www-data . .

# Create necessary directories with correct permissions
RUN mkdir -p storage/framework/{sessions,views,cache} \
    && mkdir -p bootstrap/cache \
    && mkdir -p public/uploads \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 755 storage bootstrap/cache public

# Install dependencies if composer.json exists
RUN if [ -f "composer.json" ]; then \
        composer install --no-dev --no-interaction --optimize-autoloader --ignore-platform-reqs --no-scripts; \
    fi

# Create a health check script
COPY --chmod=755 <<EOF /usr/local/bin/healthcheck.sh
#!/bin/sh
set -e

# Check if the web server is running
if ! pgrep -f "nginx: master" > /dev/null; then
    echo "Nginx is not running"
    exit 1
fi

# Check if PHP-FPM is running
if ! pgrep "php-fpm" > /dev/null; then
    echo "PHP-FPM is not running"
    exit 1
fi

echo "Application is healthy"
exit 0
EOF

# Add health check
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
    CMD /bin/sh /usr/local/bin/healthcheck.sh || exit 1

# Configure PHP-FPM
RUN echo 'pm = dynamic' >> /usr/local/etc/php-fpm.d/www.conf \
    && echo 'pm.max_children = 5' >> /usr/local/etc/php-fpm.d/www.conf \
    && echo 'pm.start_servers = 2' >> /usr/local/etc/php-fpm.d/www.conf \
    && echo 'pm.min_spare_servers = 1' >> /usr/local/etc/php-fpm.d/www.conf \
    && echo 'pm.max_spare_servers = 3' >> /usr/local/etc/php-fpm.d/www.conf

# Configure Nginx
RUN rm -f /etc/nginx/sites-enabled/*
RUN mkdir -p /run/nginx

# Create a script to generate the Nginx config with the correct port
RUN echo '#!/bin/sh\n\
set -e\n\
# Get the port from the environment variable or use 8080 as default\n\
PORT="${PORT:-8080}"\n\
# Create the Nginx config with the correct port\n\
cat > /etc/nginx/conf.d/default.conf <<NGINX_CONF\n\
server {\n\
    listen ${PORT} default_server;\n\
    listen [::]:${PORT} default_server;\n\
    server_name _;\n\
    root /var/www/html/public;\n\
    index index.php index.html index.htm;\n\
    access_log /var/log/nginx/access.log;\n\
    error_log /var/log/nginx/error.log;\n\
    # Increase timeouts\n\
    client_max_body_size 100M;\n\
    fastcgi_read_timeout 300;\n\
    proxy_connect_timeout 600s;\n\
    proxy_send_timeout 600s;\n\
    proxy_read_timeout 600s;\n\
    fastcgi_send_timeout 600s;\n\
    fastcgi_read_timeout 600s;\n\
    location / {\n\
        try_files \$uri \$uri/ /index.php?\$query_string;\n\
    }\n\
    # PHP-FPM Configuration\n\
    location ~ \\.php$ {\n\
        try_files \$uri =404;\n\
        fastcgi_split_path_info ^(.+\\.php)(/.+)$;\n\
        fastcgi_pass 127.0.0.1:9000;\n\
        fastcgi_index index.php;\n\
        include fastcgi_params;\n\
        fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;\n\
        fastcgi_param PATH_INFO \$fastcgi_path_info;\n\
        fastcgi_param PATH_TRANSLATED \$document_root\$fastcgi_path_info;\n\
        fastcgi_param QUERY_STRING \$query_string;\n\
        fastcgi_intercept_errors on;\n\
        fastcgi_buffer_size 128k;\n\
        fastcgi_buffers 4 256k;\n\
        fastcgi_busy_buffers_size 256k;\n\
    }\n\
    # Deny access to hidden files\n\
    location ~ /\\. {\n\
        deny all;\n\
        access_log off;\n\
        log_not_found off;\n\
    }\n\
    # Disable access to .git directories\n\
    location ~ /\\.git {\n\
        deny all;\n\
        access_log off;\n\
        log_not_found off;\n\
    }\n\
    # Deny access to sensitive files\n\
    location ~* \\.(env|log|sql|sqlite|gitignore|gitattributes)$ {\n\
        deny all;\n\
    }\n\
    # Cache static files\n\
    location ~* \\.(jpg|jpeg|gif|png|css|js|ico|webp|svg|woff|woff2|ttf|eot)$ {\n\
        expires 30d;\n\
        add_header Cache-Control "public, no-transform";\n\
        try_files \$uri =404;\n\
    }\n\
}\n\
NGINX_CONF\n\
echo "Nginx configured to listen on port ${PORT}"' > /docker-entrypoint.d/10-listen-on-ipv6-by-default.sh

# Make the script executable
RUN chmod +x /docker-entrypoint.d/10-listen-on-ipv6-by-default.sh
EOF

# Create a custom PHP-FPM config to listen on a Unix socket
RUN echo '[global]\n\
error_log = /proc/self/fd/2\n\
[www]\n\
user = www-data\n\
group = www-data\n\
listen = /var/run/php-fpm.sock\n\
listen.owner = www-data\n\
listen.group = www-data\n\
listen.mode = 0660\n\
clear_env = no\n' > /usr/local/etc/php-fpm.d/zz-docker.conf

# Create a more reliable startup script
COPY <<EOF /usr/local/bin/start.sh
#!/bin/bash
set -e

# Create necessary directories
mkdir -p /run/php /var/log/php-fpm /var/run/nginx

# Generate Nginx config with the correct port
if [ -d /docker-entrypoint.d ]; then
    for f in /docker-entrypoint.d/*.sh; do
        if [ -x "$f" ]; then
            echo "Running $f"
            "$f"
        fi
    done
fi

# Start PHP-FPM in background
echo "Starting PHP-FPM..."
php-fpm -D

# Simple check if PHP-FPM is running
if ! (ps -ef | grep -v grep | grep php-fpm); then
    echo "PHP-FPM failed to start"
    exit 1
fi

# Wait a bit to ensure PHP-FPM is ready
sleep 3

# Start Nginx in foreground
echo "Starting Nginx..."
nginx -t
exec nginx -g 'daemon off; error_log /dev/stderr info;'
EOF

# Make startup script executable
RUN chmod +x /usr/local/bin/start.sh

# Create necessary directories and set permissions
RUN mkdir -p /var/log/nginx /var/lib/nginx /var/tmp/nginx \
    && chown -R www-data:www-data /var/log/nginx /var/lib/nginx /var/tmp/nginx \
    && chmod -R 755 /var/log/nginx /var/lib/nginx /var/tmp/nginx

# Expose port 8080 (Nginx)
EXPOSE 8080

# Start services
CMD ["/usr/local/bin/start.sh"]
