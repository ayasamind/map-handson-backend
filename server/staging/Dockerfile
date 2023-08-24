FROM php:8.2-rc-apache

ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/composer \
    ROOT="/var/www"
SHELL ["/bin/bash", "-oeux", "pipefail", "-c"]

COPY ./server/staging/vhost.conf /etc/apache2/sites-enabled/000-default.conf

RUN apt-get update \
    && apt-get -y install git unzip libzip-dev libicu-dev libonig-dev vim \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install intl pdo_mysql zip bcmath

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html
