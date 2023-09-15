### GOTCHA: Container build for dev, not production ready!!!
FROM php:8.2-cli
RUN apt-get update && apt-get install -y libpq-dev \
    && pecl install xdebug \
    && docker-php-ext-install pgsql pdo_pgsql \
    && docker-php-ext-enable xdebug

WORKDIR /app
CMD [ "php", "-S", "0.0.0.0:80" ]
