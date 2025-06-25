# Use PHP 8.0 with Apache
FROM php:8.0-apache

# Install required PHP extensions for Laravel
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite (needed for Laravel routing)
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy Laravel project into container
COPY . /var/www/html

# Set proper permissions (optional but recommended)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Fix .htaccess override (allow Laravel's pretty URLs)
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Change default Apache port to 4000
RUN sed -i 's/80/4000/g' /etc/apache2/ports.conf /etc/apache2/sites-enabled/000-default.conf

# Expose port 4000
EXPOSE 4000

# Start Apache in foreground
CMD ["apache2-foreground"]
