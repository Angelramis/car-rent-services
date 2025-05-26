# Usa la imagen oficial de PHP con Apache
FROM php:8.2-apache

# Habilita extensiones necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copia todos los archivos del proyecto local al contenedor
COPY . /var/www/html/

# Otorga permisos (opcional)
RUN chown -R www-data:www-data /var/www/html
