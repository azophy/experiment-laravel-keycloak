FROM php:8.1-cli-alpine

WORKDIR /app

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY composer.* /app
RUN composer install

COPY .  /app
ENTRYPOINT /app/start.sh

