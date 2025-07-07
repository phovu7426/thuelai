FROM php:8.2-apache

# Cài extension PHP
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl && \
    docker-php-ext-install pdo pdo_mysql zip

# Bật rewrite cho Laravel
RUN a2enmod rewrite

# Trỏ Apache vào thư mục public/
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy source vào container
COPY . /var/www/html

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
RUN composer install --no-dev --optimize-autoloader

# Tạo APP_KEY (chỉ khi có .env)
RUN if [ -f .env ]; then php artisan key:generate; fi

# EXPOSE cổng 80
EXPOSE 80

# Khởi động Apache
CMD ["apache2-foreground"]
