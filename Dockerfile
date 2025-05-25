FROM php:8.2-apache

RUN apt-get update && \
    apt-get install -y \
        libpng-dev libjpeg-dev libfreetype6-dev \
        msmtp msmtp-mta \
        ca-certificates && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo_mysql mysqli

COPY . /var/www/html/

COPY msmtprc /etc/msmtprc
RUN chmod 600 /etc/msmtprc

RUN chown www-data:www-data /etc/msmtprc

RUN a2enmod rewrite

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf
