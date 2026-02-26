FROM php:8.2-apache

# 1. Cambiamos el DocumentRoot de Apache a la carpeta /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 2. Copiamos los archivos
COPY . /var/www/html/

# 3. Permisos y módulos
RUN a2enmod rewrite
RUN chown -R www-data:www-data /var/www/html/

EXPOSE 80