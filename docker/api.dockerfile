FROM php:8.2-cli as build

WORKDIR /app

RUN apt-get update \
    # Минимальные утилиты
    && apt-get install -y zip unzip \
    # Модули для php-ext
    libxml2-dev libpq-dev \
    # php extension
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    bcmath

COPY ./src /app
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

COPY ./.env /app
COPY ./docker/start.sh /tmp/start.sh
RUN ln -s /tmp/start.sh /usr/bin/start.sh \
    && chmod +x /tmp/start.sh \
    && php artisan optimize:clear \
    && php artisan cache:clear \
    && php artisan optimize


EXPOSE 8000
ENTRYPOINT ["start.sh"]
CMD ["/app"]