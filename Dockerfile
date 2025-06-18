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

# Set working directory
WORKDIR /var/www/html

# Copy composer files first to leverage Docker cache
COPY composer.json composer.lock* ./

# Install dependencies
RUN composer install --no-dev --no-interaction --optimize-autoloader --ignore-platform-reqs --no-scripts

# Copy the rest of the application
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && a2enmod rewrite

# Configure Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN echo "<VirtualHost *:80>\n    DocumentRoot ${APACHE_DOCUMENT_ROOT}\n    <Directory ${APACHE_DOCUMENT_ROOT}>\n        AllowOverride All\n        Require all granted\n    </Directory>\n</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

# Enable necessary Apache modules
RUN a2enmod rewrite headers

# Set environment
ENV APP_ENV=production
ENV APP_DEBUG=false

# Health check
HEALTHCHECK --interval=30s --timeout=3s \
  CMD curl -f http://localhost/ || exit 1

# Expose port 80
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
