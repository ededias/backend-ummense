FROM php:8.2-cli

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql

# Instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Define o diretório de trabalho
WORKDIR /var/www

# Copia os arquivos do projeto
COPY . .

# Instala dependências Laravel (sem dev)
RUN composer install --no-dev --optimize-autoloader

# Ajusta permissões
RUN chmod -R 777 storage bootstrap/cache

# Expõe a porta que o Railway vai usar
EXPOSE 8080

# CMD usando a variável de ambiente PORT do Railway
CMD php artisan serve --host=0.0.0.0 --port=$PORT
