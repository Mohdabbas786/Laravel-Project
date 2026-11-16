FROM php:8.2-apache

# Install system dependencies required for Composer and Laravel
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev

# Install required PHP extensions
RUN docker-php-ext-install pdo_mysql zip bcmath gd

# Enable Apache rewrite module
RUN a2enmod rewrite

# Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files into the container
COPY . .

# Run composer install safely
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Expose port 8080 for Render
EXPOSE 8080
RUN sed -i 's/80/8080/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

CMD ["apache2-foreground"]