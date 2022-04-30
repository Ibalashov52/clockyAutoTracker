FROM php:8.1.4-fpm

WORKDIR "/application"

ARG DOCKER_GID=1000
ARG DOCKER_UID=1000

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

# установка необходимых пакетов
RUN apt-get update \
    && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libzip-dev \
        libpng-dev \
        libpq-dev \
        git \
        && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*


# установка php расширений
RUN docker-php-ext-install bcmath zip pdo_pgsql exif

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN pecl install redis xdebug \
    && docker-php-ext-enable redis.so xdebug

# установка composer
RUN curl -sS https://getcomposer.org/installer | php -- --quiet \
    && mv composer.phar /usr/local/bin/composer

# настройка пользователя и прав
RUN groupadd -g $DOCKER_GID dev
RUN useradd -g $DOCKER_GID -u $DOCKER_UID dev
RUN mkdir /home/dev
RUN chown -R dev:dev /home/dev

# копирование файлов проекта
COPY ./App /application
#COPY "docker/php-fpm/php-ini-overrides.ini" "/etc/php/8.0/fpm/conf.d/99-overrides.ini"
COPY "docker/php-fpm/php-ini-overrides.ini" "/usr/local/etc/php/conf.d/99-overrides.ini"

# для ci, чтобы ждать готовность бд
#RUN chmod +x /application/wait-for-it.sh

# Для Тинкера
RUN mkdir -p /var/www/.config/psysh
RUN chown 33:33 /var/www/.config/psysh
RUN chown 33:33 /application/bootstrap/cache

USER root
