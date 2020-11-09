FROM php

# installation de composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
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

RUN groupadd -g 1000 symfony
RUN useradd -u 1000 --system -m -g 1000 symfony
USER symfony
RUN php -r "copy('https://get.symfony.com/cli/installer', '/tmp/installer.sh');";
RUN bash /tmp/installer.sh
RUN echo "export PATH=\$PATH:/home/symfony/.symfony/bin/" >> /home/symfony/.bashrc

ENV COMPOSER_HOME /tmp
ENV APP_ENV dev
WORKDIR /opt/projet