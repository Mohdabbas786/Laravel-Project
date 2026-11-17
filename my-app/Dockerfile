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

# Set working directory to Apache's root
WORKDIR /var/www/html

# Copy your application files (since Dockerfile is inside my-app, copy from current context)
COPY . .

# Set proper permissions for Laravel storage and cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Create SQLite database file and set permissions
RUN mkdir -p /var/www/html/database && touch /var/www/html/database/database.sqlite && chmod -R 777 /var/www/html/database

# Run composer install
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Point Apache document root to Laravel's public folder
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf
RUN sed -i 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf

# Expose port 80
EXPOSE 80

# Automatically run migrations and start Apache safely
CMD ["sh", "-c", "php artisan migrate --force && apache2-foreground"]