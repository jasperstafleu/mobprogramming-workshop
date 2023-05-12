### GOTCHA: Container build for dev, not production ready!!!
FROM php:8.2-cli
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug
WORKDIR /app
CMD [ "php", "-S", "0.0.0.0:80" ]
