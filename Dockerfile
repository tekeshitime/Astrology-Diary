FROM php:8.2-apache

WORKDIR /var/www/html
COPY /src /var/www/html

RUN apt-get update &&\
  # JPEG 対応
  apt-get install -y libpng-dev libjpeg62-turbo-dev &&\
  docker-php-ext-configure gd --with-jpeg &&\
  docker-php-ext-install -j$(nproc) gd
