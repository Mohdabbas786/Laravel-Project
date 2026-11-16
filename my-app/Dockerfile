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

# Enable Apache rewrite
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .RUN chown -R www-data:www-data
/var/www/html/storage 
/var/www/html/bootstrap/cache

# Run composer install
RUN composer install --no-dev --optimize-autoloader --no-interaction
# Point Apache document root to Laravel's public folder
RUN sed -i 
's!/var/www/html!/var/www/html/public!
g' /etc/apache2/sites-available/000-
default.conf
RUN sed -i
's!/var/www/!/var/www/html/public!g' 
/etc/apache2/apache2.conf
EXPOSE 8080
RUN sed -i 's/80/8080/g' 
/etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf
CMD ["apache2-foreground"]