FROM php:5.6-apache

COPY data /var/www/data

RUN apt-get update && apt-get install vim -y

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli