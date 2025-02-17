# Usa a imagem oficial do PHP com Apache
FROM php:7.4-apache

# Instala extensões necessárias para Laravel e MySQL
RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    zip \
    git \
    mariadb-client \
    && docker-php-ext-configure gd \
    && docker-php-ext-install gd pdo pdo_mysql mbstring zip

# Instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivos do projeto para o container
COPY . .

# Copia o .env.example para .env
RUN cp .env.example .env

# Dá permissões para a pasta storage e bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Instala as dependências do Laravel
RUN composer install --no-progress --no-suggest --no-interaction --optimize-autoloader

# Gera a chave do Laravel
RUN php artisan key:generate

# Expõe a porta 8000 para acesso externo
EXPOSE 8000

# Comando de entrada ao iniciar o container
CMD php artisan migrate --seed && php artisan serve --host=0.0.0.0 --port=8000

