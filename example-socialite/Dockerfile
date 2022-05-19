FROM php:8.1-cli-alpine

#COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

#RUN composer create-project laravel/laravel .
#COPY composer.* /app
#RUN composer install

#COPY .  /app
#CMD [ "sh", "start.sh" ]
WORKDIR /app
CMD [ "php", "-S", "0.0.0.0:8000" ]

