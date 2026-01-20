FROM php:8.2-fpm-bookworm

RUN apt-get update \
    && apt-get install -y \
        git unzip libonig-dev libzip-dev zip curl \
    && docker-php-ext-install mbstring bcmath zip pdo_mysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

RUN composer install --no-dev --optimize-autoloader

EXPOSE 8000

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
