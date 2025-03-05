# docker/Dockerfile
FROM php:8.2-fpm

# Установим необходимые пакеты для PostgreSQL и Composer
RUN apt-get update && apt-get install -y \
    libpq-dev \
    git \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql

# Установим Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Установим зависимости Laravel
WORKDIR /var/www

# Скопируем файлы Laravel проекта
COPY ./app/ .

# Запустим PHP-FPM
CMD ["php-fpm"]
