# Use PHP 8.0.28 with Apache
FROM php:8.0.28-apache

# Install system dependencies & PHP extensions
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev nodejs npm \
    && docker-php-ext-install pdo pdo_mysql zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy all project files
COPY . .

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 storage bootstrap/cache

# Set up .env file
RUN cp .env.example .env

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction --optimize-autoloader

# Install and build front-end assets (Laravel Breeze / Vite)
RUN npm install && npm run build

# Laravel setup commands
RUN php artisan key:generate && \
    php artisan storage:link

# Configure Apache to support Laravel's .htaccess
RUN echo '<Directory /var/www/html>\n\
    AllowOverride All\n\
</Directory>' > /etc/apache2/sites-available/000-default.conf

# Expose Apache port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
