FROM php:7.3-apache

RUN apt-get update && apt-get install -y libldap2-dev npm libmcrypt-dev git zip unzip libpng-dev libzip-dev libxml2-dev libmemcached-dev unixodbc-dev libonig-dev\
  && docker-php-ext-install pdo_mysql  && docker-php-ext-install gd && docker-php-ext-install mysqli && docker-php-ext-enable mysqli \
  && docker-php-ext-install mbstring && docker-php-ext-install bcmath && docker-php-ext-install zip
RUN a2enmod rewrite
RUN service apache2 restart
WORKDIR /var/www/html
