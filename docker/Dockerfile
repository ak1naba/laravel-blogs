# Используем базовый образ PHP
FROM php:8.2-fpm

# Установим необходимые пакеты для PostgreSQL, Composer и Node.js
RUN apt-get update && apt-get install -y \
    libpq-dev \
    git \
    unzip \
    curl \
    gnupg \
    && docker-php-ext-install pdo pdo_pgsql

# Установим Node.js и npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Установим Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Установим зависимости Laravel
WORKDIR /var/www

# Скопируем файлы Laravel проекта
COPY ./app/ .

# Установим расширение pcntl
RUN docker-php-ext-install pcntl
RUN docker-php-ext-configure pcntl --enable-pcntl

# Установим права доступа
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage

# Установим необходимые npm пакеты
RUN npm install

# Запустим PHP-FPM
CMD ["php-fpm"]
