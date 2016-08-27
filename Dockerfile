FROM ubuntu:16.04

MAINTAINER Chris Baptista <chris@asianchris.com>

WORKDIR /var/www/html

EXPOSE 80

# Install Services
RUN apt-get -qq update \
    && apt-get -qq install -y \
	git \
	apache2 \
	php \
	php-common \
	php-xml \
	libapache2-mod-php \
    && a2enmod rewrite

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('SHA384', 'composer-setup.php') === 'e115a8dc7871f15d853148a7fbac7da27d6c0030b848d9b3dc09e2a0388afed865e6a3d6b3c0fad45c48e2b5fc1196ae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php --filename=composer --install-dir=/usr/local/bin \
    && php -r "unlink('composer-setup.php');"

# Update Default site
COPY ./docker-files/000-default.conf /etc/apache2/sites-available/000-default.conf

# Copy Application
COPY . /var/www/html

# Composer install
RUN composer install --quiet

# Allow apache to write to storage
RUN chown -R www-data:www-data /var/www/html/storage

CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
