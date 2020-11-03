FROM php

# installation de composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('SHA384', 'composer-setup.php') === '795f976fe0ebd8b75f26a6dd68f78fd3453ce79f32ecb33e7fd087d39bfeb978342fb73ac986cd4f54edd0dc902601dc') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"

# dépendances pour installation de symfony
RUN apt update -y
RUN apt install zip -y
RUN apt install git -y

RUN apt install libicu-dev -y \
    && docker-php-ext-install -j$(nproc) intl \
    && docker-php-ext-install -j$(nproc) pcntl

RUN pecl install redis \
    && pecl install xdebug \
    && docker-php-ext-enable redis xdebug

RUN php -r "copy('https://get.symfony.com/cli/installer', '/tmp/installer.sh');";
RUN bash /tmp/installer.sh
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony
RUN chmod -R a+w /usr/local/bin # pour pouvoir updater symfony
RUN rm -rf /tmp/installer.sh
RUN mkdir /.symfony
RUN chmod a+w /.symfony

ENV COMPOSER_HOME /tmp
ENV APP_ENV prod
WORKDIR /opt/projet