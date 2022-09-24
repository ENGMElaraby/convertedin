FROM php:8.1-fpm-alpine

ADD ./php/www.conf /usr/local/etc/php-fpm.d/www.conf
ADD ./php/php.ini /usr/local/etc/php/php.ini-production
ADD ./php/php.ini /usr/local/etc/php/php.ini-development
ADD ./php/php.ini /usr/local/etc/php/php.ini

RUN addgroup -g 1000 converted && adduser -G converted -g converted -s /bin/sh -D converted

RUN mkdir -p /var/www/html

RUN chown converted:converted /var/www/html

WORKDIR /var/www/html

RUN apk --no-cache add php8-pear php8-dev gcc musl-dev make

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY ./php/90-xdebug.ini ${PHP_INI_DIR}/conf.d

RUN docker-php-ext-install pdo pdo_mysql mysqli