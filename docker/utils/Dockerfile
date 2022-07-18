FROM php:7.4-alpine

RUN apk update \
    apt add php-xml php-mbstring composer \
    curl

RUN docker-php-ext-install exif
RUN docker-php-ext-configure exif \
            --enable-exif

############################### Install composer ###############################
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

CMD composer update -d /var/www  \
    && chmod -R 777 /var/www/vendor
