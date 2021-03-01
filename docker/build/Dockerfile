FROM ubuntu:20.04

ARG DEBIAN_FRONTEND=noninteractive

WORKDIR /var/www

RUN apt-get update && \
    apt-get install --no-install-recommends -y software-properties-common && \
    apt-get install -y --no-install-recommends apt-utils && \
    add-apt-repository ppa:ondrej/php -y && \
    apt-get install --no-install-recommends -y --allow-unauthenticated \
    mongodb \
    composer \
    sshfs \
    curl \
    php7.4 \
    php7.4-common \
    php7.4-cli \
    php7.4-zip \
    php7.4-dev \
    php7.4-pdo \
    php7.4-curl \
    php7.4-gd \
    php7.4-igbinary \
    php7.4-imagick \
    php7.4-intl \
    php7.4-json \
    php7.4-mbstring \
    php7.4-opcache \
    php7.4-soap \
    php7.4-xml \
    php7.4-mongodb \
    tzdata \
    gpg-agent \
    g++ \
    make

RUN ln -fs /usr/share/zoneinfo/America/Fortaleza /etc/localtime && \
    dpkg-reconfigure --frontend noninteractive tzdata

RUN phpenmod \
    curl \
    dev \
    pdo \
    json \
    common \
    gd \
    igbinary \
    imagick \
    intl \
    mbstring \
    opcache \
    soap \
    xml \
    mongodb.so

COPY ./docker/files/php.ini /etc/php/7.4/cli/php.ini