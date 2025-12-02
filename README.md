<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Laravel Sail

Este proyecto utiliza Laravel Sail como entorno de desarrollo local. Laravel Sail es una interfaz ligera para Docker que facilita la configuración y ejecución del proyecto.

### Comandos para iniciar el proyecto

1. Asegúrate de tener Docker instalado y en ejecución en tu sistema.

2. Configurar variables de entorno
```bash
cp .env.example .env
```

3. Ejecuta el siguiente comando para iniciar el entorno de desarrollo:
```bash
./vendor/bin/sail up -d
```
Esto iniciará los contenedores necesarios para el proyecto.

#EN CASO DE ERROR

3.1. **IMPORTANTE:** En caso de que el comando anterior no funcione, puede deberse a que es un proyecto existente pero sin dependencias aún. En ese caso, ejecuta el siguiente comando de Docker para instalar las dependencias:
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/app" \
    -w /app \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```
Esto instalará las dependencias necesarias. Una vez completado, vuelve a ejecutar el paso 3.

4. Para detener los servicios, ejecuta el siguiente comando:

```bash
vendor/bin/sail down
```

## Base de Datos

Este proyecto utiliza MySQL como base de datos. Asegúrate de tener MySQL instalado y configurado correctamente en tu sistema.

### Script para levantar el proyecto

En la ruta `scripts/start_project.sh` se encuentra un script que permite levantar el proyecto rápidamente. Este script puede ser modificado y enriquecido con más líneas en el futuro según las necesidades del proyecto.

