FROM php:8.1-fpm

RUN apt-get update; \
    apt-get install -y \
            libzip-dev \
            libicu-dev; \
    docker-php-ext-install \
            intl \
            pdo \
            pdo_mysql \
            opcache \
            zip;