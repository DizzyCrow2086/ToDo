FROM php:8.2-fpm AS base

# Устанавливаем дополнительные зависимости
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip

# Устанавливаем рабочую директорию внутри контейнера
WORKDIR /var/www

# Добавляем Composer в PATH
ENV PATH=$PATH:/usr/local/bin

# Копируем файлы зависимостей
COPY composer.json composer.lock ./


# Копируем все остальные файлы проекта
COPY . .



# Устанавливаем правильные права на директорию storage
RUN chown -R www-data:www-data /var/www/storage

# Устанавливаем правильные права на директории bootstrap
RUN chown -R www-data:www-data /var/www/bootstrap/cache

# Устанавливаем правильные права на директорию vendor
RUN chown -R www-data:www-data /var/www/vendor

# Экспонируем порт нашего приложения
EXPOSE 9000

# Команда запускающая сервер Laravel
CMD ["php-fpm"]
