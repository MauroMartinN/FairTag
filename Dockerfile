FROM php:8.2-apache

# Instalar las extensiones necesarias
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo_mysql mysqli

# Copiar los archivos de la aplicación
COPY . /var/www/html/

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Establecer la raíz del documento
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Modificar la configuración de Apache para usar la raíz del documento correcta
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf
