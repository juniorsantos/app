# Offical Docker Image for PHP
# https://hub.docker.com/_/php
FROM php:8.1.7-fpm

# Set Current Directory
WORKDIR /var/www/vhost/

# Install dependencies
RUN apt-get clean && apt-get update && apt-get upgrade -y && apt-get install -y \
    git \
    libcurl4-openssl-dev \
    libonig-dev \
    libpng-dev \
    libssl-dev \
    libicu-dev \
    libxml2-dev \
    libzip-dev \
    unzip \
    wget \
    zip \
    tzdata

RUN docker-php-ext-configure intl
# PHP Extensions
RUN docker-php-ext-install \
    bcmath \
    exif \
    gd \
    mysqli \
    opcache \
    pdo_mysql \
    pcntl \
    xml \
    zip \
    intl
RUN pecl install xdebug

COPY ./config/php.ini "${PHP_INI_DIR}"
COPY ./config/docker-php-ext-xdebug.ini "${PHP_INI_DIR}/conf.d"

RUN docker-php-ext-enable xdebug

# Install Composer from Official Docker Image
# https://hub.docker.com/_/composer
COPY --from=composer:2.3.7 /usr/bin/composer /usr/bin/composer
