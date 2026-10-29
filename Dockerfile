FROM php:8.2-apache

# 1. تثبيت مكتبات النظام الحاكمة
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    && rm -rf /var/lib/apt-get/lists/*

# 2. ضبط وتثبيت إضافات PHP المطلوبة لـ Laravel و PostgreSQL / MySQL
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) pdo pdo_mysql pdo_pgsql mbstring gd zip xml bcmath

# 3. جلب Composer وتكبير حد الذاكرة لضمان عدم توقف التثبيت
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_MEMORY_LIMIT=-1

WORKDIR /var/www/html

# 4. نسخ ملفات المشروع
COPY . .

# 5. تثبيت حزم Composer بدون تشغيل السكريبتات التلقائية مؤقتاً لتفادي أخطاء البيئة أثناء البناء
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-scripts

# 6. ضبط صلاحيات مجلدات التخزين والـ Cache الخاصة بـ Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 7. إعداد المجلد الرئيسي لـ Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN a2enmod rewrite

EXPOSE 80
CMD ["apache2-foreground"]
