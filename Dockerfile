FROM php:8.2-apache

# Install required PHP extensions and Apache modules
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev \
    libcurl4-openssl-dev libssl-dev \
    libicu-dev libxslt-dev \
    git curl nano \
    && docker-php-ext-install \
        mysqli pdo pdo_mysql zip gd mbstring intl xml bcmath opcache xsl \
    && a2enmod rewrite

# Set working directory to public folder
WORKDIR /var/www/html

# Copy only the public folder into Apache root
COPY . /var/www/html

# Set permissions
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Enable mod_rewrite
RUN a2enmod rewrite

# Set Apache DocumentRoot to /var/www/html/public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && echo '<Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>' >> /etc/apache2/apache2.conf
