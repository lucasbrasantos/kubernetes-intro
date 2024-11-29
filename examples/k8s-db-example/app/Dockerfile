FROM php:7.4-apache

WORKDIR /var/www/html

COPY src /tmp/src
RUN mv /tmp/src/* /var/www/html/


RUN apt-get update && apt-get install -y \
	libfreetype6-dev \
	libjpeg62-turbo-dev \
	libpng-dev \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd \
	&& docker-php-ext-install pdo_mysql \
	&& docker-php-ext-install mysqli

EXPOSE 80	