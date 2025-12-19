FROM php:8.0-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    sqlite3 \
    libsqlite3-dev \
    curl \
    gnupg \
    && docker-php-ext-install pdo pdo_sqlite zip

# -------------------------
# Instalar Node.js (LTS)
# -------------------------
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Directorio de trabajo
WORKDIR /var/www

# Permisos
RUN chown -R www-data:www-data /var/www
