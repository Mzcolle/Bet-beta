FROM php:8.1-fpm

# Instalar extensões e dependências do PostgreSQL
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    libpq-dev

# Instala extensões PHP incluindo PostgreSQL
RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar diretório de trabalho
WORKDIR /var/www

# Copiar aplicação e instalar dependências
COPY . /var/www
RUN composer install --optimize-autoloader --no-dev

# Gerar cache da aplicação
RUN php artisan config:cache && php artisan route:cache

# Configurar permissões
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expor porta e iniciar Laravel
EXPOSE 8000
CMD php artisan serve --host=0.0.0.0 --port=8000
