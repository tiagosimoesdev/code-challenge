FROM php:8.2-fpm

RUN apt-get update \
  && apt-get install -y build-essential zlib1g-dev curl gnupg procps vim git unzip libzip-dev libpq-dev \
  && docker-php-ext-install zip pdo pdo_mysql

# Xdebug
RUN pecl install xdebug \
 && docker-php-ext-enable xdebug \
 && echo "zend_extension=xdebug" > /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
 && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
 && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin
RUN composer config --global process-timeout 3600
RUN composer global require "laravel/installer"

WORKDIR /root

EXPOSE 5173
WORKDIR /var/www
