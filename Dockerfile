FROM php:8.2-apache

# Extensiones y mod_rewrite
RUN docker-php-ext-install mysqli pdo pdo_mysql \
 && a2enmod rewrite

# Crea la carpeta destino
RUN mkdir -p /var/www/html/car-rent-services

# Copia SOLO lo que está dentro de la sub‑carpeta "car-rent-services"
# (no copia la carpeta duplicada)
COPY ./car-rent-services/ /var/www/html/car-rent-services/

# Ajusta DocumentRoot para que apunte al lugar correcto
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/car-rent-services|g' /etc/apache2/sites-available/000-default.conf \
 && sed -i 's|<Directory /var/www/html>|<Directory /var/www/html/car-rent-services>|g' /etc/apache2/apache2.conf

# Opciones extra (ServerName, permisos, index.php por defecto)
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf \
 && chown -R www-data:www-data /var/www/html/car-rent-services \
 && chmod -R 755 /var/www/html/car-rent-services \
 && echo "DirectoryIndex index.php" > /etc/apache2/conf-enabled/directoryindex.conf
