 
FROM php:8.0-apache

RUN a2enmod rewrite
RUN docker-php-ext-install mysqli

WORKDIR /var/www/html
COPY . /var/www/html
RUN chown -R www-data:www-data /var/www/html
