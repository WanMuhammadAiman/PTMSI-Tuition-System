# ==========================
# Stage 1: Frontend Builder
# ==========================
FROM node:20 as node-builder

WORKDIR /app
COPY . .

# Install Node modules and build Vite assets
RUN npm install && npm run build


# ==========================
# Stage 2: Laravel + Apache
# ==========================
FROM php:8.0.28-apache

# Install system packages and PHP extensions
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy Laravel project files
COPY . .

# Copy built frontend assets from Node build stage
COPY --from=node-builder /app/public/build /var/www/html/public/build

# Set correct permissions for Laravel
RUN mkdir -p storage/logs bootstrap/cache && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 755 storage bootstrap/cache

# Add Composer (from official image)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN composer install --no-interaction --optimize-autoloader

# Laravel setup
RUN cp .env.example .env && \
    php artisan key:generate && \
    php artisan storage:link

# Fix Apache DocumentRoot to point to /public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf && \
    echo '<Directory /var/www/html/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' >> /etc/apache2/apache2.conf

# Expose port 80 and run Apache
EXPOSE 80
CMD ["apache2-foreground"]
