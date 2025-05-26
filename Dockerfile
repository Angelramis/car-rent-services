FROM php:8.2-apache

# Instala extensiones necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Habilita mod_rewrite si lo necesitas
RUN a2enmod rewrite

# Copia SOLO el contenido interior, no la carpeta contenedora
COPY . /var/www/html/car-rent-services

# Cambia DocumentRoot de Apache para que sirva la carpeta directamente
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/car-rent-services|g' /etc/apache2/sites-available/000-default.conf \
 && sed -i 's|<Directory /var/www/html>|<Directory /var/www/html/car-rent-services>|g' /etc/apache2/apache2.conf

# Elimina el warning del ServerName
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Asegura permisos correctos
RUN chown -R www-data:www-data /var/www/html/car-rent-services \
 && chmod -R 755 /var/www/html/car-rent-services

# Define index.php como archivo predeterminado
RUN echo "DirectoryIndex index.php" > /etc/apache2/conf-enabled/directoryindex.conf
