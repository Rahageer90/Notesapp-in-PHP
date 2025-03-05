# Use official PHP image with Apache
FROM php:8.1-apache

# Set working directory
WORKDIR /var/www/html

# Install required extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Enable Apache rewrite module
RUN a2enmod rewrite

# Copy project files
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
