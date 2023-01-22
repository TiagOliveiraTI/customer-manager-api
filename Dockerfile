FROM php:8.2-fpm

ARG uid
ARG user

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libldap2-dev \
    libfreetype6-dev \
    libpq-dev \
    libzip-dev \
    libonig-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    nodejs \
    graphviz \
    fswatch \
    ufw

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ \
    &&  docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pgsql mysqli pdo_pgsql pdo_mysql mbstring zip exif pcntl gd ldap 

RUN ufw allow 9003

RUN pecl install -o -f xdebug \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable xdebug

RUN useradd -G root -u $uid -d /home/$user $user

WORKDIR /var/www

RUN mkdir -p /home/$user/.composer

RUN chown -R $user /home/$user/.composer

USER $user

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY . ./

EXPOSE 9003