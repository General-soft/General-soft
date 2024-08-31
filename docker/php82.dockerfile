FROM php:8.2-fpm AS base_php

RUN groupadd -g1000 phpuser && useradd -u1000 -g1000 phpuser

RUN apt update && apt install -y \
        libpq-dev

RUN docker-php-ext-install pdo pdo_pgsql pgsql

ARG PHP_XDEBUG_ENABLE
ARG PHP_XDEBUG_PORT

RUN if [ "$PHP_XDEBUG_ENABLE" = "1" ]; then \
    pecl install xdebug  \
    && docker-php-ext-enable xdebug \
    && echo " \
        xdebug.mode=debug \n\
        xdebug.start_with_request=yes \n\
        xdebug.client_host=host.docker.internal \n\
        xdebug.client_port=${PHP_XDEBUG_PORT} \n\
        xdebug.idekey=xdebug \
    " >> ${PHP_INI_DIR}/conf.d/docker-php-ext-xdebug.ini ; fi
