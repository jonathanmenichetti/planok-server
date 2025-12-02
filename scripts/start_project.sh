#!/bin/bash
# quick-start.sh - Inicio rápido de Laravel Sail

set -e

echo "🚀 Inicio rápido Laravel Sail"

# 1. Comprobación de la carpeta vendor/bin/sail
if [ ! -f "./vendor/bin/sail" ]; then
    echo "📂 La carpeta vendor/bin/sail no existe. Instalando dependencias..."
    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v "$(pwd):/app" \
        -w /app \
        laravelsail/php82-composer:latest \
        composer install --ignore-platform-reqs
fi

# 2. Levantar Sail
echo "🐳 Levantando Sail..."
./vendor/bin/sail down 2>/dev/null || true
./vendor/bin/sail up -d

# 3. Limpiar cachés
echo "🧹 Limpiando cachés..."
./vendor/bin/sail artisan optimize:clear
./vendor/bin/sail artisan view:clear
./vendor/bin/sail artisan route:clear
./vendor/bin/sail artisan config:clear

# 4. Base de datos
echo "🗄️ Configurando base de datos..."
./vendor/bin/sail artisan migrate --force

echo "✅ ¡Listo! http://localhost"
