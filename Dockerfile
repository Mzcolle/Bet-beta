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

# Copiar aplicação
COPY . /var/www

# Instalar dependências sem rodar scripts automáticos
RUN composer install --no-scripts --no-dev --optimize-autoloader

# Corrigir permissões
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expor porta da aplicação
EXPOSE 8000

# Iniciar Laravel com cache gerado
CMD php artisan config:cache && php artisan route:cache && php artisan serve --host=0.0.0.0 --port=8000
