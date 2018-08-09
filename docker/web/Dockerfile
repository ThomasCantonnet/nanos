FROM phusion/baseimage:latest

# Set envs
RUN locale-gen en_GB.UTF-8
ENV LANG en_GB.UTF-8
ENV LANGUAGE en_GB:en
ENV LC_ALL en_GB.UTF-8
ENV TERM xterm

# Timezone
ENV TZ=Europe/Zurich
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Running updates
RUN curl -sL https://deb.nodesource.com/setup_8.x | bash -
RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list
RUN add-apt-repository ppa:ondrej/php
RUN apt-get update && apt-get upgrade -y -o Dpkg::Options::="--force-confold"

# Installing dependencies
RUN apt-get install -y vim curl git \
    php7.2-common php7.2-dev php7.2-cli php7.2-fpm php7.2-redis php7.2-pgsql php7.2-intl nginx zip yarn

RUN git clone https://github.com/ThomasCantonnet/nanos.git /home/nanos

# Install vendor dependencies
RUN php /home/nanos/composer.phar install -d /home/nanos

# Setup nginx
ADD docker/web/nginx/default /etc/nginx/sites-available/default
ADD docker/web/nginx/nginx.conf /etc/nginx/nginx.conf
RUN echo 'server_tokens off;' > /etc/nginx/conf.d/server_tokens.conf

# Setup nginx
RUN mkdir /etc/service/nginx
ADD docker/web/service/nginx.sh /etc/service/nginx/run
RUN chmod +x /etc/service/nginx/run

# Setup php-fpm
RUN mkdir /etc/service/php-fpm
ADD docker/web/service/php-fpm.sh /etc/service/php-fpm/run
RUN chmod +x /etc/service/php-fpm/run

RUN chown -R www-data:www-data /home/nanos
RUN chmod 777 www-data:www-data /home/nanos/data/DoctrineORMModule/Proxy
