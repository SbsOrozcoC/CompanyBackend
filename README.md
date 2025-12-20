# 🚀 CompanyBackend – Guía de instalación
Este proyecto es un backend en Laravel 8 ejecutándose en Docker, usando SQLite como base de datos.

CompanyBackend es una aplicación backend desarrollada en Laravel para la gestión de empleados,
cargos (positions), jerarquía organizacional, países y ciudades.
Incluye validaciones de negocio, DataTables y confirmaciones con SweetAlert.


# 📋 Requisitos previos
Antes de comenzar, asegúrate de tener instalado:
- Git
- Docker
- Docker Compose
- Verifica con:

```bash
    git --version
    docker --version
    docker compose version
```

# 🧰 Stack técnico

- Laravel 8
- PHP 8.x
- SQLite
- Docker / Docker Compose
- Laravel Breeze
- DataTables
- SweetAlert2
- Tailwind CSS

# 🔑 Credenciales iniciales

Al ejecutar los seeders se crea automáticamente:

Usuario administrador:
- Email: admin@company.com
- Password: password ( se encuentra en el seeder de usuarios)

Empleado presidente:
- Se crea automáticamente y NO puede ser eliminado.
- Es el jefe raíz de la jerarquía organizacional.

# 📌 Reglas de negocio implementadas

- Solo puede existir un presidente en la empresa.
- El presidente:
  - No puede ser eliminado.
  - No puede tener jefe.
- Todo empleado (excepto el presidente) tiene un jefe.
- La jerarquía no permite ciclos.
- Los cargos NO incluyen "Presidente" (es un rol del sistema).

# 🔐 Seguridad y UX

- Acceso protegido por autenticación.
- Policies para autorización.
- Confirmaciones con SweetAlert antes de eliminar.
- Validaciones backend y frontend.
- Eliminación lógica (soft deletes).


# tener encuenta !importante
Crear el archivo de base de datos si no existe:
```bash
    docker-compose exec app touch database/database.sqlite
```

# 📦 1. Clonar el repositorio
```bash
    git clone https://github.com/TU_USUARIO/CompanyBackend.git
    cd CompanyBackend
```

# 🐳 2. Construir y levantar los contenedores
Desde la raíz del proyecto:
```bash
    docker-compose up -d --build
```
Verifica que los contenedores estén activos:
```bash
    docker ps
```
Debes ver al menos:
- companybackend_app
- companybackend_web


# 📥 3. Instalar dependencias de Laravel
Ejecuta Composer dentro del contenedor:
```bash
    docker-compose exec app composer install
```

# ⚙️ 4. Configurar variables de entorno
Copiar archivo .env
```bash
    docker-compose exec app cp .env.example .env
```
Generar la clave de la aplicación
```bash
    docker-compose exec app php artisan key:generate
```

# 🗄️ 5. Configurar base de datos SQLite
Editar .env
Asegúrate de que estas variables estén así:
```bash
    DB_CONNECTION=sqlite
    DB_DATABASE=/var/www/database/database.sqlite
```

# 🔐 6. Asignar permisos (IMPORTANTE)
```bash
    docker-compose exec app chmod -R 775 storage bootstrap/cache
    docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
```

### Frontend assets (Docker)
El proyecto utiliza Laravel Mix (Laravel 8).
```bash
    docker-compose exec app npm install
    docker-compose exec app npm run production
```

# 🔄 7. Ejecutar migraciones
```bash
    docker-compose exec app php artisan migrate --seed
```
Los seeders crean:
- Países
- Ciudades
- Cargos (positions)

## 🧹 Limpieza de cache (si algo falla)
```bash
    docker-compose exec app php artisan optimize:clear
```

# 🧪 Testing

El proyecto incluye pruebas automáticas para:
- Autenticación
- CRUD de empleados
- Validaciones de negocio
- Regla de presidente único

Ejecutar los tests:
```bash
docker-compose exec app php artisan test
```

# 🌐 8. Acceder a la aplicación
Abre tu navegador y entra a:
```bash
    http://localhost:8000
```
Si ves la pantalla de bienvenida de Laravel, la instalación fue exitosa 🎉

rutas extra.
```bash
    http://localhost:8000/login
    http://localhost:8000/register
```

# 🧠 Notas importantes
- El proyecto NO requiere MySQL.
- SQLite funciona como archivo local.
- Todo el entorno corre dentro de Docker.
- No es necesario instalar PHP o Composer en la máquina local.


# Autor
Sebastian Orozco
Desarrollador Full Stack