# Use PHP 8.0.28 with Apache
FROM php:8.0.28-apache as app

# Install system dependencies & PHP extensions
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev \
    nodejs npm gnupg2 ca-certificates \
    && docker-php-ext-install pdo pdo_mysql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy project files into container
COPY . .

# Ensure Laravel storage and cache directories exist
RUN mkdir -p storage/logs bootstrap/cache

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 storage bootstrap/cache

# Copy Composer from official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN composer install --no-interaction --optimize-autoloader

# Setup .env (optional: safer to mount in production)
RUN cp .env.example .env

# Laravel app setup
RUN php artisan key:generate \
    && php artisan storage:link

# Install and compile front-end assets
RUN npm install && npm run build

# Apache config for .htaccess override
RUN echo '<Directory /var/www/html>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/sites-available/000-default.conf

# Expose Apache port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
