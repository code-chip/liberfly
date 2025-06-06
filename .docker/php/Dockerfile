# Dockerfile

FROM php:8.3-fpm

# Instale dependências do Laravel (opcional)
RUN apt-get update && apt-get install -y \
    git zip unzip curl libzip-dev sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_mysql zip pdo_sqlite

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
    
# Cria o mesmo usuário e grupo do host (garante permissões corretas)
ARG UID=1000
ARG GID=1000
RUN groupadd -g ${GID} appuser && \
    useradd -u ${UID} -g ${GID} -m appuser

# Define o usuário padrão para evitar problemas de permissão
USER appuser

# Entrypoint opcional se quiser garantir permissão automática
COPY entrypoint.sh /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]
CMD ["php-fpm"]
