FROM php:7.3.6-apache-stretch
MAINTAINER Dolyveen Renault <d.renault@karudev-informatique.fr>

COPY etc/php/php.ini /usr/local/etc/php
RUN a2enmod rewrite

# Install wget
RUN apt-get update && apt-get install -y wget \
zlib1g-dev \
libxml2-dev \
libxml2-dev \
libzip-dev

# Install opcache
RUN docker-php-ext-install opcache

# Install extension zip
# Utile pour le composer install
RUN docker-php-ext-install zip

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php composer-setup.php --install-dir=/usr/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"
