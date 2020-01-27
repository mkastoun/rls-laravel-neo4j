FROM php:7.3-fpm

COPY ../../../composer.lock  /var/www/rls
COPY ../../../composer.json  /var/www/rls

WORKDIR /var/www/rls

RUN apt-get update && \
    apt-get install -y libmcrypt-dev libpq-dev cron zlib1g-dev libfcgi0ldbl libpng-dev git zip wget gnupg && \
    rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install bcmath mbstring opcache pdo_mysql

RUN composer install && composer dumpautoload

CMD ["true"]
