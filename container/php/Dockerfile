FROM php:7.4-cli

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

RUN apt-get update
RUN apt-get install zip
RUN pecl install xdebug-2.9.8
RUN docker-php-ext-enable xdebug
RUN apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

ENV APP_DIR /app

WORKDIR $APP_DIR
VOLUME $APP_DIR

COPY . .

COPY --from=composer:1.10.13 /usr/bin/composer /usr/local/bin/composer

RUN composer install --no-interaction

EXPOSE 80

CMD ["php", "-S", "0.0.0.0:80", "-t", "/app/www", "/app/www/index.php"]
