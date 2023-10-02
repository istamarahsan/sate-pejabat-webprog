FROM node:18 AS assets

WORKDIR /app

COPY public/ ./public/
COPY resources/ ./resources/
COPY package.json package-lock.json postcss.config.js tailwind.config.js vite.config.js ./

RUN npm ci
RUN npm run build

FROM php:8.2-fpm as system

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libzip-dev \
    oniguruma

RUN apt-get clean && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl gd
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

FROM system as deploy

COPY app/ ./app
COPY bootstrap/ ./bootstrap
COPY config ./config
COPY resources ./resources
COPY routes ./routes
COPY artisan composer.json composer.lock ./

COPY --from=assets /app/node_modules/ ./node_modules/
COPY --from=assets /app/public/ ./app/public

RUN mkdir -p ./storage/app/public
RUN mkdir -p ./storage/framework/cache
RUN mkdir -p ./storage/framework/sessions
RUN mkdir -p ./storage/framework/testing
RUN mkdir -p ./storage/framework/views
RUN mkdir -p ./storage/logs

EXPOSE 9000

RUN /usr/bin/composer install