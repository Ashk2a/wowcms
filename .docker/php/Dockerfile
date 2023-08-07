ARG PHP_VERSION=8.2

FROM php:${PHP_VERSION}-alpine AS base

LABEL maintainer="Ashk"

WORKDIR /var/www/app

ENV TZ=UTC
ENV DEBIAN_FRONTEND=noninteractive

# Safety on error
RUN set -eux;

# Default system packets
RUN apk add --no-cache --update \
    tzdata \
    gnupg \
    libcap \
    git \
    make \
    curl \
    path \
    zip \
    unzip

# Php extensions manager
COPY --from=mlocati/php-extension-installer:2.1 /usr/bin/install-php-extensions /usr/bin/

# Install PHP extensions
RUN install-php-extensions \
    http \
    opcache \
    intl \
    pdo_mysql \
    redis \
    gd \
    bcmath \
    zip \
    @composer

# Timezone
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Clean
RUN rm -rf /usr/share/php \
    /usr/share/php8* \
    /usr/src/* \
    /usr/local/bin/phpdbg \
    /usr/local/bin/install-php-extensions \
    /var/lib/apt/lists/* \
    /tmp/* \
    /var/tmp/*

FROM base AS local

ARG WWWUSER=1000
ARG WWWGROUP=1000

# Install shadow
RUN apk add --no-cache --update shadow

# Map host user with container user and host group with container group
RUN usermod -u $WWWUSER www-data
RUN groupmod -g $WWWGROUP www-data

# Permissions
RUN setcap "cap_net_bind_service=+ep" /usr/local/bin/php \
    && chown -R www-data:www-data /var/www \
    && chown -R www-data:www-data /tmp

FROM local AS local-php

# Copy entrypoint and add execution rights
COPY local-php-entrypoint /usr/bin/entrypoint
RUN chmod +x /usr/bin/entrypoint

# Set www-data as default user
USER www-data

ENTRYPOINT ["entrypoint"]

FROM local AS local-worker

# Copy entrypoint and add execution rights
COPY local-worker-entrypoint /usr/bin/entrypoint
RUN chmod +x /usr/bin/entrypoint

# Set www-data as default user
USER www-data

ENTRYPOINT ["entrypoint"]

