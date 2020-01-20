FROM php:7.3-fpm-stretch

COPY php.ini /usr/local/etc/php/php.ini

RUN apt-get update \
    && apt-get install -y zlib1g-dev libzip-dev libfreetype6-dev libjpeg62-turbo-dev libpng-dev wget \
    && docker-php-ext-install zip exif gd pdo_mysql mysqli mbstring sockets \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && apt-get install -y zip unzip git \
    && wget https://github.com/jwilder/dockerize/releases/download/v0.6.1/dockerize-linux-amd64-v0.6.1.tar.gz && tar -C /usr/local/bin -xzvf dockerize-linux-amd64-v0.6.1.tar.gz && rm dockerize-linux-amd64-v0.6.1.tar.gz
