FROM php:8.2-apache

# 1. تثبيت مكتبات النظام المطلوبة لدعم الـ Extensions و GD
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    zip \
    unzip \
    git \
    curl \
    && rm -rf /var/lib/apt-get/lists/*

# 2. ضبط إعدادات مكتبة GD وتثبيت الإضافات بالشكل الصحيح
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) pdo pdo_mysql pdo_pgsql mbstring gd

# 3. تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# 4. نسخ ملفات المشروع
COPY . .

# 5. تثبيت حزم Composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# 6. ضبط صلاحيات المجلدات في Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 7. ضبط إعدادات Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN a2enmod rewrite

EXPOSE 80
CMD ["apache2-foreground"]
