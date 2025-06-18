# Use PHP 8.3 FPM as base
FROM php:8.3-fpm

# Install system dependencies in smaller, more reliable chunks
RUN apt-get update && apt-get install -y --no-install-recommends \
    build-essential \
    ca-certificates \
    curl \
    git \
    gnupg \
    unzip \
    zip \
    && rm -rf /var/lib/apt/lists/*

# Install essential libraries
RUN apt-get update && apt-get install -y --no-install-recommends \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libwebp-dev \
    libxpm-dev \
    libvpx-dev \
    libzip-dev \
    libicu-dev \
    libpq-dev \
    libssl-dev \
    default-mysql-client \
    && rm -rf /var/lib/apt/lists/*

# Install tools and utilities
RUN apt-get update && apt-get install -y --no-install-recommends \
    nginx \
    procps \
    netcat-openbsd \
    vim \
    jpegoptim \
    optipng \
    pngquant \
    gifsicle \
    && rm -rf /var/lib/apt/lists/*

# Configure system user and group
RUN groupadd -r nginx && \
    useradd -r -g nginx -s /sbin/nologin nginx && \
    usermod -a -G www-data nginx

# Configure PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp && \
    docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        mbstring \
        gd \
        zip \
        opcache \
        intl

# Clean up
RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Create necessary directories with proper permissions
RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache /var/log/php-fpm /var/run/php && \
    chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/log/php-fpm /var/run/php && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/log/php-fpm /var/run/php && \
    mkdir -p /var/cache/nginx /var/run/nginx && \
    chown -R nginx:nginx /var/cache/nginx /var/run/nginx && \
    chmod -R 755 /var/cache/nginx /var/run/nginx

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

# Create a directory for entrypoint scripts
RUN mkdir -p /docker-entrypoint.d

# Create a minimal Nginx configuration
RUN echo '#!/bin/sh\n\
set -e\n\
# Get the port from the environment variable or use 8080 as default\n\
PORT="${PORT:-8080}"\n\
# Create the main nginx.conf with global settings\n\
cat > /etc/nginx/nginx.conf <<NGINX_MAIN\n\
user  nginx;\n\
worker_processes  auto;\n\
pid        /var/run/nginx.pid;\n\
events {\n\
    worker_connections  1024;\n\
}\n\
http {\n\
    include       /etc/nginx/mime.types;\n\
    default_type  application/octet-stream;\n\
    sendfile        on;\n\
    tcp_nopush     on;\n\
    tcp_nodelay    on;\n\
    keepalive_timeout  65;\n\
    types_hash_max_size 2048;\n\
    server_tokens off;\n\
    include /etc/nginx/conf.d/*.conf;\n\
    include /etc/nginx/sites-enabled/*;\n\
    # Set the default error log level\n    error_log /var/log/nginx/error.log warn;\n\
    # Gzip Settings\n    gzip on;\n    gzip_disable "msie6";\n    gzip_vary on;\n    gzip_proxied any;\n    gzip_comp_level 6;\n    gzip_buffers 16 8k;\n    gzip_http_version 1.1;\n    gzip_types text/plain text/css application/json application/javascript text/xml application/xml application/xml+rss text/javascript;\n}\n\
NGINX_MAIN\n\
# Create the server configuration\n\
cat > /etc/nginx/conf.d/default.conf <<NGINX_CONF\n\
server {\n\
    listen ${PORT} default_server;\n\
    listen [::]:${PORT} default_server;\n\
    server_name _;\n\
    root /var/www/html/public;\n\
    index index.php index.html index.htm;\n\
    charset utf-8;\n\
    # Logging\n\
    access_log /var/log/nginx/access.log;\n\
    error_log /var/log/nginx/error.log warn;\n\
    # Security headers\n\
    add_header X-Frame-Options "SAMEORIGIN";\n\
    add_header X-Content-Type-Options "nosniff";\n\
    add_header X-XSS-Protection "1; mode=block";\n\
    # File upload size\n\
    client_max_body_size 100M;\n\
    # Root location\n\
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
        # Timeouts\n\
        fastcgi_read_timeout 300s;\n\
        fastcgi_send_timeout 300s;\n\
        fastcgi_connect_timeout 300s;\n\
        # Buffers\n\
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
    # Deny access to sensitive files\n\
    location ~* \\.(env|log|sql|sqlite|gitignore|gitattributes)$ {\n\
        deny all;\n\
        access_log off;\n\
        log_not_found off;\n\
    }\n\
    # Cache static files\n\
    location ~* \\.(jpg|jpeg|gif|png|css|js|ico|webp|svg|woff|woff2|ttf|eot)$ {\n\
        expires 30d;\n\
        add_header Cache-Control "public, no-transform";\n\
        try_files \$uri =404;\n\
        access_log off;\n\
        log_not_found off;\n\
    }\n\
    # Deny access to storage and bootstrap/cache directories\n\
    location ~* /(storage|bootstrap/cache) {\n\
        deny all;\n\
        access_log off;\n\
        log_not_found off;\n\
    }\n\
    # Deny access to .git directory\n\
    location ~ /\.git {\n\
        deny all;\n\
        access_log off;\n\
        log_not_found off;\n\
    }\n\
}\n\
NGINX_CONF\n\
# Test the Nginx configuration\n\
if nginx -t; then\n\
    echo "Nginx configuration test is successful"\n\
else\n\
    echo "Nginx configuration test failed"\n\
    exit 1\n\
fi\n\
echo "Nginx configured to listen on port ${PORT}"' > /docker-entrypoint.d/10-configure-nginx.sh

# Make the scripts executable
RUN chmod +x /docker-entrypoint.d/*.sh

# Configure PHP-FPM
RUN { \
    echo '[global]'; \
    echo 'error_log = /proc/self/fd/2'; \
    echo; \
    echo '[www]'; \
    echo 'user = www-data'; \
    echo 'group = www-data'; \
    echo 'listen = 127.0.0.1:9000'; \
    echo 'listen.owner = www-data'; \
    echo 'listen.group = www-data'; \
    echo 'pm = dynamic'; \
    echo 'pm.max_children = 25'; \
    echo 'pm.start_servers = 5'; \
    echo 'pm.min_spare_servers = 2'; \
    echo 'pm.max_spare_servers = 10'; \
    echo 'pm.max_requests = 500'; \
    echo 'clear_env = no'; \
    echo 'catch_workers_output = yes'; \
    echo 'decorate_workers_output = no'; \
    echo 'php_admin_value[memory_limit] = 256M'; \
    echo 'php_admin_value[post_max_size] = 100M'; \
    echo 'php_admin_value[upload_max_filesize] = 100M'; \
    echo 'php_flag[display_errors] = off'; \
    echo 'php_admin_flag[log_errors] = on'; \
    echo 'php_admin_value[error_log] = /var/log/php-fpm/error.log'; \
    echo 'php_admin_flag[log_errors] = on'; \
} > /usr/local/etc/php-fpm.d/zz-docker.conf

# Create a more reliable startup script
RUN echo '#!/bin/bash\n\
set -e\n\
# Create necessary directories with correct permissions\n\
mkdir -p /run/php /var/log/php-fpm /var/run/nginx /var/cache/nginx/client_temp /var/cache/nginx/proxy_temp /var/cache/nginx/fastcgi_temp /var/cache/nginx/uwsgi_temp /var/cache/nginx/scgi_temp\n\
chown -R nginx:nginx /var/cache/nginx /var/run/nginx\n\
chmod -R 755 /var/cache/nginx /var/run/nginx\n\
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache\n\
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache\n\
# Generate Nginx config with the correct port\n\
if [ -d /docker-entrypoint.d ]; then\n\
    for f in /docker-entrypoint.d/*.sh; do\n\
        if [ -x "$f" ]; then\n\
            echo "Running $f"\n\
            "$f"\n\
        fi\n\
    done\n\
fi\n\
# Start PHP-FPM in background\n\
echo "Starting PHP-FPM..."\n\
php-fpm -D\n\
# Simple check if PHP-FPM is running\n\
if ! pgrep -x "php-fpm" > /dev/null; then\n\
    echo "PHP-FPM failed to start"\n\
    exit 1\n\
fi\n\
# Wait a bit to ensure PHP-FPM is ready\n\
echo "Waiting for PHP-FPM to be ready..."\n\
for i in {1..10}; do\n\
    if [ -S /var/run/php/php-fpm.sock ] || nc -z 127.0.0.1 9000; then\n\
        echo "PHP-FPM is ready"\n\
        break\n\
    fi\n\
    if [ $i -eq 10 ]; then\n\
        echo "PHP-FPM failed to start"\n\
        exit 1\n\
    fi\n\
    sleep 1\n\
done\n\
# Start Nginx in foreground\n\
echo "Starting Nginx..."\n\
# Test Nginx configuration first\n\
if ! nginx -t; then\n\
    echo "Nginx configuration test failed"\n\
    exit 1\n\
fi\n\
# Start Nginx in foreground\n\
exec nginx -g "daemon off; error_log /dev/stderr info;"' > /usr/local/bin/start.sh

# Make startup script executable
RUN chmod +x /usr/local/bin/start.sh

# Create necessary directories and set permissions
RUN mkdir -p /var/log/nginx /var/lib/nginx /var/tmp/nginx \
    && chown -R www-data:www-data /var/log/nginx /var/lib/nginx /var/tmp/nginx \
    && chmod -R 755 /var/log/nginx /var/lib/nginx /var/tmp/nginx

# Expose the port specified by the PORT environment variable (default: 8080)
ARG PORT=8080
EXPOSE ${PORT}

# Start services
CMD ["/usr/local/bin/start.sh"]
