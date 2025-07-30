#!/bin/bash
set -e

# Esperar pelo MySQL
until nc -z -v -w30 mysql 3306
do
  echo "Aguardando o banco de dados iniciar..."
  sleep 2
done

echo "Banco de dados está disponível, continuando..."

# Cria o symlink do storage
if [ ! -L public/storage ]; then
    php artisan storage:link
fi

# Checa se já foi migrado
if ! php artisan migrate:status > /dev/null 2>&1; then
    echo "Inicializando o banco de dados..."
    php artisan migrate --force
    php artisan db:seed --force
else
    echo "Banco de dados já existe, executando migrações pendentes..."
    php artisan migrate --force
fi

# Inicia o servidor
exec php artisan serve --host=0.0.0.0 --port=8082

