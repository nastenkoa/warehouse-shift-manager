FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    pkg-config \
    && docker-php-ext-install pdo pdo_sqlite


RUN a2enmod rewrite

COPY ./src/ /var/www/html/
COPY ./admscripts/ /var/www/adm/
COPY ./db/ /var/www/db/

RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

RUN chown -R www-data:www-data /var/www/