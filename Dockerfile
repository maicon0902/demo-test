FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www

RUN apt-get update && apt-get install -y zlib1g-dev \
    libicu-dev \
    g++ \
    libgd-dev \
    libzip-dev \
    libpng-dev \
    libxpm-dev \
    libpq-dev \
    libwebp-dev \
    zlib1g-dev \
    apt-utils \
    zip \
    unzip \
    dnsutils \
    cron \
    vim \
    libfreetype6-dev \
    libjpeg62-turbo-dev

RUN apt-get update && apt install -y curl supervisor

RUN docker-php-ext-configure gd --enable-shared --with-freetype --with-jpeg=/usr/include/ --with-webp

RUN docker-php-ext-install -j$(nproc) gd

RUN apt-get update && apt-get install mariadb-client -y

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Extension driver
RUN docker-php-ext-configure intl \
    && docker-php-ext-install intl exif \
    && docker-php-ext-install opcache pdo_mysql mysqli zip

RUN { \
	echo 'opcache.memory_consumption=128'; \
	echo 'opcache.interned_strings_buffer=8'; \
	echo 'opcache.max_accelerated_files=4000'; \
	echo 'opcache.revalidate_freq=2'; \
	echo 'opcache.fast_shutdown=1'; \
	echo 'opcache.enable_cli=1'; \
	} > /usr/local/etc/php/conf.d/docker-wn-opcache.ini

RUN pecl install redis && docker-php-ext-enable redis

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN mkdir -p /var/log/supervisor

COPY docker/supervisor/default.conf /etc/supervisor/conf.d/default.conf

# Copy existing app dir
COPY . /var/www

# Set permissions
RUN chown -R www-data:www-data /var/www

# Setup crontab
RUN echo "* * * * * root php /var/www/artisan schedule:run >> /dev/null 2>&1" >> /etc/crontab

RUN service cron start

# Setup supervisord
CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/conf.d/default.conf"]