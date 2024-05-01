# Используем образ PHP с установленным расширением для работы с Laravel
FROM php:7.4-fpm

# Установка зависимостей
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Установка расширений PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd


WORKDIR /opt/google
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --1
RUN curl -O https://blog.bayrell.org/media/files/archives/v8-ubuntu-18.04-x64-6.4.388.18-2.1.0.tar.gz
RUN tar xzf v8-ubuntu-18.04-x64-6.4.388.18-2.1.0.tar.gz
RUN cp /opt/google/v8/6.4/v8js.so /usr/local/lib/php/extensions/no-debug-non-zts-20170718
RUN echo extension=v8js.so > /usr/local/etc/php/conf.d/50-v8js.ini


WORKDIR /var/www

# Открытие порта для веб-сервера
EXPOSE 80

# Запуск веб-сервера PHP-FPM
CMD ["php-fpm"]