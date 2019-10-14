FROM php:7.3-fpm-alpine

RUN apk update && \
    apk add zlib-dev libzip mysql-client

RUN apk add --no-cache libpng-dev zlib-dev libzip-dev \
&& docker-php-ext-configure zip --with-libzip \
&& docker-php-ext-install zip

RUN docker-php-ext-configure pdo_mysql --with-pdo-mysql
RUN docker-php-ext-install pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

RUN adduser ideato -D
USER ideato

WORKDIR /var/www
