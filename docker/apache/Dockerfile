FROM php:5.4-apache

RUN ln -sf /dev/stdout /var/log/apache2/access.log \
    && ln -sf /dev/stderr /var/log/apache2/error.log


RUN apt-get update 
RUN docker-php-ext-install curl exif gd iconv imap intl json mcrypt mysql mysqli
