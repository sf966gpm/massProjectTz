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

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY ./docker/start.sh /tmp/start.sh
#COPY ./ /app
#
#RUN composer install --no-interaction --prefer-dist --optimize-autoloader \
#    && php artisan cache:clear \
#    && php artisan route:cache \
#    && php artisan key:generate \
#    && php artisan config:cache



FROM build as php
RUN ln -s /tmp/start.sh /usr/bin/start.sh
EXPOSE 8000
ENTRYPOINT ["start.sh"]
CMD ["/app"]

#FROM build as cron
#RUN apt-get install -y cron \
#    && crontab /app/docker/cron
#CMD ["cron", "&&","tail","-f","/var/log/cron.log","2>&1"]