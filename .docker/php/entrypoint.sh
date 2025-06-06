#!/bin/sh

# Corrige permissões
echo "🔧 Fixing permissions..."

mkdir -p storage bootstrap/cache database
chmod -R 775 storage bootstrap/cache database
chown -R appuser:appuser storage bootstrap/cache database

# Executa o comando padrão
exec "$@"
