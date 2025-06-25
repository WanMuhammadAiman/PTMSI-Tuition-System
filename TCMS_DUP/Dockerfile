# Stage 1: Build front-end assets
FROM node:20 as node-builder

WORKDIR /app
COPY . .

# Install dependencies and build assets
RUN npm install && npm run build


# Stage 2: Laravel app with Apache and PHP
FROM php:8.0.28-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Copy built assets from node stage
COPY --from=node-builder /app/public/build /var/www/html/public/build

# Fix Laravel permissions
RUN mkdir -p storage/logs bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 755 storage bootstrap/cache

# Copy Composer binary
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN composer install --no-interaction --optimize-autoloader

# Laravel setup
RUN cp .env.example .env \
    && php artisan key:generate \
    && php artisan storage:link

# Apache override
RUN echo '<Directory /var/www/html>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/sites-available/000-default.conf

# Expose and run
EXPOSE 80
CMD ["apache2-foreground"]


