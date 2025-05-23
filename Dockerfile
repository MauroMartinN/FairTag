FROM php:8.2-apache

# Instalar dependencias necesarias
RUN apt-get update && \
    apt-get install -y \
        libpng-dev libjpeg-dev libfreetype6-dev \
        msmtp msmtp-mta \
        ca-certificates && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo_mysql mysqli

# Copiar archivos de la aplicación
COPY . /var/www/html/

# Copiar la configuración de msmtp
COPY msmtprc /etc/msmtprc
RUN chmod 600 /etc/msmtprc

# Establecer permisos adecuados
RUN chown www-data:www-data /etc/msmtprc

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Establecer la raíz del documento
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Cambiar el DocumentRoot en Apache
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf
