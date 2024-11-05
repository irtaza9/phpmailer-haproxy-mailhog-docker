FROM composer:latest AS composer

FROM php:8.0-apache

RUN apt-get update && apt-get install -y \
    libzip-dev \
    git \
    && docker-php-ext-install zip sockets

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --prefer-dist --optimize-autoloader

EXPOSE 80