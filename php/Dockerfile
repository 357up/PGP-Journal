ARG PHP_VERSION=""

FROM php:${PHP_VERSION:+${PHP_VERSION}-}fpm

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install mysqli pdo pdo_mysql

WORKDIR /var/www

RUN mkdir journal && useradd -d /var/www/journal -s /sbin/nologin journal 

WORKDIR /var/www/journal

RUN mkdir tmp webspaceroot && chown -R journal: .

COPY journal.php-fpm.conf /usr/local/etc/php-fpm.d/journal.conf
