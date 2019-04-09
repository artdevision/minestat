FROM ubuntu

ENV DEBIAN_FRONTEND noninteractive

ARG X_DEBUG_REMOTE_HOST
ARG X_DEBUG_PROFILER_ENABLE
ARG USE_BLACKFIRE
ARG USE_HOST_ASSETS_BUILDER

RUN apt-get update --fix-missing
RUN apt-get install -y software-properties-common
RUN add-apt-repository -y ppa:ondrej/php | tail -2
RUN apt-get update

#RUN addgroup -gid 1000 www-data
#RUN adduser www-data -uid 1000 --disabled-login --ingroup www-data --no-create-home --quiet --system
#RUN mkdir /var/www/html

RUN apt-get install -y \
     php7.2-fpm \
     php7.2-mysql \
     php7.2-ldap \
     php7.2-mbstring \
     php-memcache \
     php7.2-curl  \
     php-imagick \
     php7.2-gd \
     php7.2-soap \
     php-xdebug \
     php7.2-xml \
     php7.2-zip \
     php7.2-mongodb \
     php7.2-redis \
     php7.2-memcached \
     curl \
     cron \
     supervisor \
     unzip \
     zip

COPY ./conf/php-fpm.conf /etc/php/7.2/fpm/php-fpm.conf
COPY ./conf/local-fpm.conf /etc/php/7.2/fpm/pool.d/local.conf
COPY ./ini/xdebug.ini /etc/php/7.2/mods-available/xdebug.ini

RUN rm -f /etc/php/7.2/fpm/pool.d/www.conf

RUN echo "xdebug.remote_host = ${X_DEBUG_REMOTE_HOST};" >> /etc/php/7.2/mods-available/xdebug.ini

RUN if [ ${X_DEBUG_PROFILER_ENABLE} = false ]; then \
    echo "xdebug.profiler_enable = off;" >> /etc/php/7.2/mods-available/xdebug.ini && \
    echo "xdebug.profiler_enable_trigger = off;" >> /etc/php/7.2/mods-available/xdebug.ini && \
    echo "xdebug.profiler_append = off;" >> /etc/php/7.2/mods-available/xdebug.ini \
;fi

RUN if [ ${USE_HOST_ASSETS_BUILDER} = false ]; then \
    curl -sL https://deb.nodesource.com/setup_8.x -o nodesource_setup.sh && \
    sh nodesource_setup.sh && \
    apt-get -y install nodejs && \
    npm install yarn -g && \
    apt-get -y install default-jre \
;fi


RUN if [ ${USE_BLACKFIRE} = true ]; then \
    version=$(php -r "echo PHP_MAJOR_VERSION.PHP_MINOR_VERSION;") \
    && curl --insecure -A "Docker" -o /tmp/blackfire-probe.tar.gz -D - -L https://blackfire.io/api/v1/releases/probe/php/linux/amd64/$version \
    && tar zxpf /tmp/blackfire-probe.tar.gz -C /tmp \
    && mv /tmp/blackfire-*.so $(php -r 'echo ini_get("extension_dir");')/blackfire.so \
    && printf "extension=blackfire.so\nblackfire.agent_socket=tcp://blackfire:8707\n" > /etc/php/7.2/mods-available/blackfire.ini \
    && ln /etc/php/7.2/mods-available/blackfire.ini /etc/php/7.2/fpm/conf.d/20-blackfire.ini \
;fi
#RUN chown www:www /app

RUN curl -sS https://getcomposer.org/installer | php -- \
        --filename=composer \
        --install-dir=/usr/local/bin && \
        echo "alias composer='composer'" >> /root/.bashrc && \
        composer

RUN chmod 0600 /var/spool/cron/crontabs/

RUN mkdir -p /var/www/html && \
    chown -R 1000:1000 /var/www/html

ENV PHP_IDE_CONFIG "serverName=minestat.local"

CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
