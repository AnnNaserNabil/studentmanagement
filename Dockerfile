# Use official PHP 8.3 with Apache
FROM php:8.3-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring gd zip opcache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create document root and storage directories
RUN mkdir -p /var/www/html/public \
    && mkdir -p /var/www/html/storage/framework/{sessions,views,cache} \
    && mkdir -p /var/www/html/bootstrap/cache

# Copy application files
COPY --chown=www-data:www-data . /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Install dependencies if composer.json exists
RUN if [ -f "composer.json" ]; then \
        composer install --no-dev --no-interaction --optimize-autoloader --ignore-platform-reqs --no-scripts; \
    fi

# Create a simple index.php if it doesn't exist
RUN if [ ! -f /var/www/html/public/index.php ]; then \
        echo "<?php phpinfo();" > /var/www/html/public/index.php; \
    fi

# Set permissions
RUN chown -R www-data:www-data /var/www \
    && find /var/www -type d -exec chmod 755 {} \; \
    && find /var/www -type f -exec chmod 644 {} \; \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 755 /var/www/html/public

# Configure Apache
RUN a2enmod rewrite headers \
    && echo "ServerName localhost" >> /etc/apache2/apache2.conf \
    && echo "<Directory /var/www/html>\n    AllowOverride All\n    Require all granted\n</Directory>" > /etc/apache2/conf-available/php-app.conf \
    && a2enconf php-app

# Configure PHP
RUN { \
    echo 'memory_limit = 512M'; \
    echo 'upload_max_filesize = 100M'; \
    echo 'post_max_size = 100M'; \
    echo 'max_execution_time = 300'; \
    echo 'display_errors = On'; \
    echo 'log_errors = On'; \
    echo 'error_log = /var/log/php_errors.log'; \
} > /usr/local/etc/php/conf.d/custom.ini

# Create a simple Apache config
RUN echo "<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n        Options Indexes FollowSymLinks\n        AllowOverride All\n        Require all granted\n        RewriteEngine On\n        RewriteBase /\n        RewriteCond %{REQUEST_FILENAME} !-f\n        RewriteCond %{REQUEST_FILENAME} !-d\n        RewriteRule ^ index.php [L]\n    </Directory>\n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

# Set environment
ENV APACHE_RUN_USER=www-data \
    APACHE_RUN_GROUP=www-data \
    APACHE_LOG_DIR=/var/log/apache2 \
    APACHE_LOCK_DIR=/var/lock/apache2 \
    APACHE_PID_FILE=/var/run/apache2.pid \
    APACHE_RUN_DIR=/var/run/apache2 \
    APACHE_DOCUMENT_ROOT=/var/www/html/public

# Create necessary directories and set permissions
RUN mkdir -p ${APACHE_RUN_DIR} ${APACHE_LOCK_DIR} ${APACHE_LOG_DIR} \
    && chown -R www-data:www-data /var/run/apache2 /var/log/apache2

# Health check
HEALTHCHECK --interval=30s --timeout=3s \
  CMD curl -f http://localhost/ || exit 1

# Expose port 80
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
