# Dockerfile

FROM php:8.3-fpm

# Instale dependências do Laravel (opcional)
RUN apt-get update && apt-get install -y \
    git zip unzip curl libzip-dev sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_mysql zip pdo_sqlite

# Instala dependências e Xdebug
RUN pecl install xdebug

# Habilita exibição de erros (opcional)
RUN echo "display_errors=On" >> /usr/local/etc/php/conf.d/docker-php.ini \
    && echo "error_reporting=E_ALL" >> /usr/local/etc/php/conf.d/docker-php.ini

# Cria arquivo de configuração do Xdebug
RUN echo "zend_extension=xdebug.so" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.discover_client_host=0" >> /usr/local/etc/php/conf.d/xdebug.ini

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
    
# Cria o mesmo usuário e grupo do host (garante permissões corretas)
ARG UID=1000
ARG GID=1000
RUN groupadd -g ${GID} appuser && \
    useradd -u ${UID} -g ${GID} -m appuser

# Define o usuário padrão para evitar problemas de permissão
USER appuser

ARG USER_SHELL=/bin/bash
ARG THEME="maran"
RUN <<EOT
    set -ex
    if [ "${USER_SHELL#*"/zsh"}" != "$USER_SHELL" ]; then
        if [ "$THEME" = "powerlevel10k/powerlevel10k" ]; then export THEME=default
        elif [ -z "$THEME" ]; then export THEME=maran; fi
        sh -c "$(wget -O- https://github.com/deluan/zsh-in-docker/releases/download/v1.1.5/zsh-in-docker.sh)" -- -p debian -p sudo -p command-not-found -p colorize -p symfony2 -p composer -p npm -p yarn -t "$THEME" -a "setopt no_nomatch"
        sudo chsh -s /usr/bin/zsh app
    else
        echo "Using bash"
    fi
EOT

# Entrypoint opcional se quiser garantir permissão automática
COPY entrypoint.sh /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]
CMD ["php-fpm"]
