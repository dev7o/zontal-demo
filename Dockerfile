FROM php:8.1-apache
# Install MySQL extension
RUN docker-php-ext-install mysqli pdo pdo_mysql
# Install other required extensions
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip
# Enable Apache mod_rewrite
RUN a2enmod rewrite
# Copy application files
COPY . /var/www/html/
# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html
# Update Apache config
RUN echo '<Directory /var/www/html/>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/override.conf \
    && a2enconf override
EXPOSE 80
CMD ["apache2-foreground"]
