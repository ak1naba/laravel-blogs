FROM php:8.2-fpm

# Установим необходимые пакеты для PostgreSQL, MySQL и Composer
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    mariadb-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_pgsql pdo_mysql

# Установим Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Установим зависимости Laravel
WORKDIR /var/www

# Скопируем файлы Laravel проекта
COPY ./app/ .

# Установим права доступа
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage

# Запустим PHP-FPM
CMD ["php-fpm"]
