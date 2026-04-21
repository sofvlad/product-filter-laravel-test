FROM php:8.5-fpm-alpine

RUN apk add --no-cache \
    libzip-dev \
    oniguruma-dev \
    unzip

RUN docker-php-ext-install \
    pdo_mysql \
    zip \
    mbstring

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-interaction --optimize-autoloader --no-dev

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

USER www-data

CMD ["php-fpm"]
