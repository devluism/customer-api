<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
</p>

## Sobre el repositorio

REST API de customers, donde: Se registran Customers, se consultan Customer por DNI o Email y elimina customers del sistema.

### Requisitos
PHP 8
Laravel 10
MySQL 8
Composer 2.6

### Instalación
- Clonar el repositorio.
- Inicializar MySQL.
- Ejecutar dentro de la carpeta  `compose install`.
- Ejecutar las migraciones `php artisan migrate` o para pruebas `php artisan migrate --seed` le pedirá crear la base de datos si no existe.
- Iniciar el servidor `php artisan serv`.
