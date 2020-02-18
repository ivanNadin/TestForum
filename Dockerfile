FROM php:7.4-fpm-alpine

#... install postgres pdo
RUN set -ex \
  && apk --no-cache add \
    postgresql-dev

RUN docker-php-ext-install pdo pdo_pgsql
RUN apk del postgresql-dev
RUN apk add --upgrade postgresql --update-cache --repository http://dl-3.alpinelinux.org/alpine/edge/main/
