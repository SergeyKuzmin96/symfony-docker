FROM php:8.4-fpm

# Установка необходимых расширений
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql zip

RUN pecl install xdebug && docker-php-ext-enable xdebug
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini


# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ARG USER_ID=1000
ARG GROUP_ID=1000

RUN groupadd -g ${GROUP_ID} appgroup && \
    useradd -l -u ${USER_ID} -g appgroup appuser && \
    install -d -m 0755 -o appuser -g appgroup /home/appuser

USER appuser


WORKDIR /var/www/html
