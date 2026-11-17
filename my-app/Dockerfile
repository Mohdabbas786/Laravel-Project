FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev

# Install PHP extensions required by Laravel
RUN docker-php-ext-install pdo_mysql zip bcmath gd mbstring xml

# Enable Apache rewrite module
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

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
# Create SQLite file and set permissions
RUN mkdir -p /var/www/html/database && touch /var/www/html/database/database.sqlite && chmod -R 777 /var/www/html/database

# Expose port 8080 and cleanly configure Apache ports
EXPOSE 8080
RUN echo "Listen 8080" > /etc/apache2/ports.conf && \
    sed -i 's/:80/:8080/g' /etc/apache2/sites-available/000-default.conf

# Automatically run migrations and start Apache safely
CMD ["sh", "-c", "php artisan migrate --force && apache2-foreground"]