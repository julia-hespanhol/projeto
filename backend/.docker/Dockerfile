FROM php:7.3.27-apache as backend_onboarding

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
        git \
        zip \
        unzip \
        iputils-ping \
    && a2enmod rewrite

RUN docker-php-ext-install pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY api/composer.json api/composer.lock /var/www/html/onboarding/api/

WORKDIR /var/www/html/onboarding/api

COPY .docker/apache/vhost.conf /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /var/www/html/onboarding/api

EXPOSE 80

CMD bash -c "composer install && apache2-foreground"