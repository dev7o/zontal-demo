FROM php:8.1-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    libzip-dev \
    zip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    supervisor \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    mysqli \
    pdo \
    pdo_mysql \
    gd \
    zip

# Copy application files
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Configure Nginx
RUN echo 'server {\n\
    listen 80;\n\
    server_name _;\n\
    root /var/www/html;\n\
    index index.php index.html;\n\
    \n\
    location / {\n\
    rewrite ^/single/([0-9]+)/([a-zA-Z0-9_-]+)$ /single.php?id=$1&name=$2 last;\n\
    rewrite ^/page/([0-9]+)/([a-zA-Z0-9_-]+)$ /page.php?id=$1&slug=$2 last;\n\
    rewrite ^/archive/([a-zA-Z0-9_-]+)$ /archive.php?type=$1 last;\n\
    rewrite ^/game/([a-zA-Z0-9_-]+)$ /category.php?name=$1 last;\n\
    rewrite ^/search/([a-zA-Z0-9_-]+)$ /category.php?query=$1 last;\n\
    rewrite ^/user/([a-zA-Z0-9_-]+)$ /user.php?page=$1 last;\n\
    rewrite ^/sitemap.xml$ /sitemap.php last;\n\
    \n\
    try_files $uri $uri/ $uri.php?$query_string /index.php?$query_string;\n\
    }\n\
    \n\
    location ~ \.php$ {\n\
    fastcgi_pass 127.0.0.1:9000;\n\
    fastcgi_index index.php;\n\
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;\n\
    include fastcgi_params;\n\
    }\n\
    \n\
    location ~ /\.ht {\n\
    deny all;\n\
    }\n\
    }' > /etc/nginx/sites-available/default

# Configure Supervisor
RUN echo '[supervisord]\n\
    nodaemon=true\n\
    \n\
    [program:php-fpm]\n\
    command=/usr/local/sbin/php-fpm --nodaemonize\n\
    autostart=true\n\
    autorestart=true\n\
    priority=5\n\
    stdout_logfile=/dev/stdout\n\
    stdout_logfile_maxbytes=0\n\
    stderr_logfile=/dev/stderr\n\
    stderr_logfile_maxbytes=0\n\
    \n\
    [program:nginx]\n\
    command=/usr/sbin/nginx -g "daemon off;"\n\
    autostart=true\n\
    autorestart=true\n\
    priority=10\n\
    stdout_logfile=/dev/stdout\n\
    stdout_logfile_maxbytes=0\n\
    stderr_logfile=/dev/stderr\n\
    stderr_logfile_maxbytes=0\n\
    ' > /etc/supervisor/conf.d/supervisord.conf

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
