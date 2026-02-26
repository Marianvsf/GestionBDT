FROM php:8.2-apache

# Copia los archivos de tu proyecto al directorio de Apache
COPY . /var/www/html/

# Habilita el módulo de reescritura de Apache (útil para URLs limpias)
RUN a2enmod rewrite

# Expone el puerto 80
EXPOSE 80