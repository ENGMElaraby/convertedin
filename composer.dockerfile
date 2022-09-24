FROM composer:2

RUN addgroup -g 1000 converted && adduser -G converted -g converted -s /bin/sh -D converted

WORKDIR /var/www/html

