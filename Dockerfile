FROM php:8.2-apache

# Instala extensiones necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Habilita mod_rewrite si lo necesitas
RUN a2enmod rewrite

# Copia todo el contenido del repo (el actual car-rent-services)
COPY . /var/www/html/car-rent-services

# Configura Apache para servir desde la subcarpeta
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/car-rent-services|g' /etc/apache2/sites-available/000-default.conf \
 && sed -i 's|<Directory /var/www/html>|<Directory /var/www/html/car-rent-services>|g' /etc/apache2/apache2.conf

# Opcional: ServerName y permisos
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf \
 && chown -R www-data:www-data /var/www/html/car-rent-services \
 && chmod -R 755 /var/www/html/car-rent-services

# Asegura que Apache sepa usar index.php
RUN echo "DirectoryIndex index.php" > /etc/apache2/conf-enabled/directoryindex.conf
