FROM ubuntu:16.04

MAINTAINER Chris Baptista <chris@asianchris.com>

WORKDIR /var/www/html

EXPOSE 80

# Install Services
RUN apt-get -qq update \
    && apt-get -qq install -y \
	git \
	zip \
	apache2 \
	php \
	php-common \
	php-xml \
	libapache2-mod-php \
    && a2enmod rewrite

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('SHA384', 'composer-setup.php') === '669656bab3166a7aff8a7506b8cb2d1c292f042046c5a994c43155c0be6190fa0355160742ab2e1c88d40d5be660b410') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
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
