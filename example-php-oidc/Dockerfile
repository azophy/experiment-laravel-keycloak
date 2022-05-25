FROM php:8.1-cli-alpine

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ref: https://github.com/docker-library/php/issues/221#issuecomment-209920424
#RUN apk add postgresql-dev --no-cache && \
    #docker-php-ext-install pdo pdo_pgsql pgsql

# ref: https://gist.github.com/mingalevme/c47c53e487729400aa3ccb7b1ef8adea
#RUN apk --no-cache add pcre-dev ${PHPIZE_DEPS} \
  #&& pecl install redis \
  #&& docker-php-ext-enable redis \
  #&& apk del pcre-dev ${PHPIZE_DEPS} \
  #&& rm -rf /tmp/pear

COPY .  /app
WORKDIR /app

RUN composer install && composer dump-autoload

CMD [ "php", "-S", "0.0.0.0:8000" ]
