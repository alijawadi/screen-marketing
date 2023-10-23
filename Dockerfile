FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www

# Copy composer.lock and composer.json
COPY composer.json ./

# Install dependencies
RUN apt-get update

RUN apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN apt-get update \
    && apt-get install -y postgresql-client-common postgresql-client libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && docker-php-ext-install zip exif pcntl \
    && docker-php-ext-install gd

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy existing application directory contents
COPY . .

COPY ./caddy/php.ini /usr/local/etc/php/php.ini

# Install project dependencies
RUN composer install

RUN chmod -R u=rwx,g=rwx,o=rwx public
RUN chmod -R u=rwx,g=rwx,o=rwx storage

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
