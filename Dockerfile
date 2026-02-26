FROM php:8.2-apache

# 1. Instalamos las dependencias del sistema necesarias para PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# 2. Configuramos el DocumentRoot a la carpeta public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 3. Copiamos los archivos y damos permisos
COPY . /var/www/html/
RUN a2enmod rewrite
RUN chown -R www-data:www-data /var/www/html/

EXPOSE 80