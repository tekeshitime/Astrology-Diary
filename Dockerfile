FROM php:7.2-apache

WORKDIR /var/www/html
COPY /src /var/www/html

# RUN apt-get update &&\
#   # JPEG 対応
#   apt-get install -y libpng-dev libjpeg62-turbo-dev &&\
#   docker-php-ext-configure gd --with-jpeg &&\
#   docker-php-ext-install -j$(nproc) gd

# 7.2
RUN apt-get update --fix-missing
RUN apt-get install -y curl
RUN apt-get install -y build-essential libssl-dev zlib1g-dev libpng-dev libjpeg-dev libfreetype6-dev
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd

RUN docker-php-ext-install pdo_mysql

