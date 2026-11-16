# Set working directory
WORKDIR /var/www/html

# Copy project files into the container
COPY . .

# Set proper permissions for Laravel storage and cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Run composer install
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Point Apache document root to Laravel's public folder
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf
RUN sed -i 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf

# Expose port 8080 and update ports configuration
EXPOSE 8080
RUN sed -i 's/80/8080/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

# Start Apache
CMD ["apache2-foreground"]