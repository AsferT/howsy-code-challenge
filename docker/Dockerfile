# PHP with Apache on newest Debian Release.
# Normally though php using alpine would be ideal, and have a seperate Dockerfile for Nginx.
FROM php:8.1.11-apache-bullseye

# php extensions installer: https://github.com/mlocati/docker-php-extension-installer
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions

# persistent / runtime deps
RUN apt-get update && \
    apt-get install -y acl file gettext git zip unzip

RUN set -eux; \
    install-php-extensions \
    	zip \
    ;

COPY ../ /var/www/html/

# Get the Timezone Argument
ARG TIMEZONE

# Copy Default PHP Configuration
COPY php.ini /usr/local/etc/php/conf.d/docker-php-config.ini

# Set Timezone
RUN ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime \
    && echo ${TIMEZONE} > /etc/timezone \
    && printf '[PHP]\ndate.timezone = "%s"\n', ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini \
    && "date"

# Have Composer access in Docker
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY --chown=www-data:www-data ../composer.* ./

USER www-data

# Set Docker Working Folder
WORKDIR /var/www/html