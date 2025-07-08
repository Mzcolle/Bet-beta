FROM php:8.1-fpm

# Instalar dependências do sistema
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

# Instalar extensões PHP
RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir diretório de trabalho
WORKDIR /var/www

# Copiar arquivos da aplicação
COPY . .

# Instalar dependências PHP
RUN composer install --no-dev --optimize-autoloader || true

# Corrigir permissões
RUN chown -R www-data:www-data storage bootstrap/cache

# ⚠️ NÃO rode comandos Artisan que dependem de .env aqui!

# Expõe a porta que o Laravel usará
EXPOSE 8000

# Comando de inicialização
CMD php artisan serve --host=0.0.0.0 --port=8000
