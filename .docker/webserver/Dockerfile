FROM php:8.1-apache

RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql
RUN a2enmod rewrite

COPY conf/urlshort.conf /etc/apache2/sites-enabled/000-default.conf

WORKDIR /var/www/html

CMD ["apache2-foreground"]
