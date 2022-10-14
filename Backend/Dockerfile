FROM composer:latest as composer
FROM php:8.1-apache

ARG PSR_VERSION=1.2.0
ARG PHALCON_VERSION=5.0.3

#enable htaccess
RUN a2enmod rewrite && a2enmod headers

#install dependecies
RUN apt update -y && \
    apt install -y \
        apt-utils \
        gettext \
        git \
        libgmp-dev \
        libicu-dev \
        libmagickwand-dev \
        libmemcached-dev \
        libpng-dev \
        libpq-dev \
        libyaml-dev \
        libwebp-dev \
        libxpm-dev \
        libzip-dev \
        locales \
        nano \
        sudo \
        wget \
        zip

#phalcon dependecies  
RUN docker-php-ext-install \
        pdo_mysql \
        zip

RUN set -xe && \
        # Download PSR, see https://github.com/jbboehr/php-psr
        curl -LO https://github.com/jbboehr/php-psr/archive/v${PSR_VERSION}.tar.gz && \
        tar xzf ${PWD}/v${PSR_VERSION}.tar.gz && \
        # Download Phalcon
        curl -LO https://github.com/phalcon/cphalcon/archive/v${PHALCON_VERSION}.tar.gz && \
        tar xzf ${PWD}/v${PHALCON_VERSION}.tar.gz && \
        docker-php-ext-install -j $(getconf _NPROCESSORS_ONLN) \
            ${PWD}/php-psr-${PSR_VERSION} \
            ${PWD}/cphalcon-${PHALCON_VERSION}/build/phalcon \
        && \
        # Remove all temp files
        rm -r \
            ${PWD}/v${PSR_VERSION}.tar.gz \
            ${PWD}/php-psr-${PSR_VERSION} \
            ${PWD}/v${PHALCON_VERSION}.tar.gz \
            ${PWD}/cphalcon-${PHALCON_VERSION} 

COPY --from=composer /usr/bin/composer /usr/local/bin/composer

COPY . /var/www/html/

#composer dependecies
RUN composer install 

#database migration
#RUN php vendor/bin/phinx migrate && php vendor/bin/phinx seed:run

#vhost config
COPY ./000-default.conf /etc/apache2/sites-available/


CMD ["apache2-foreground"]