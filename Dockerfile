FROM php:8.2-apache

# Cài extension Laravel cần
RUN apt-get update && apt-get install -y \
    unzip zip git libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Cài composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working dir
WORKDIR /var/www/html

# Copy code
COPY . .

# Cài Composer
RUN composer install --optimize-autoloader

# Chmod
RUN chmod -R 777 storage bootstrap/cache

# Apache config: dùng public làm document root
RUN a2enmod rewrite
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Tạo startup script
COPY docker-start.sh /docker-start.sh
RUN chmod +x /docker-start.sh

EXPOSE 80

CMD ["/docker-start.sh"]
