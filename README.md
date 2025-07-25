
# Ejecutar proyecto 


Resumen: Cómo Clonar y Ejecutar boletoslaravel
Sigue estos pasos para tener el proyecto corriendo en tu PC:

1. Requisitos Previos (Instalados en tu PC):

XAMPP (con Apache y MySQL iniciados).
Composer.
Git.
Editor de código (VS Code recomendado).
Postman (para probar la API).

2. Pasos a Seguir:

Clonar el Proyecto:
Abre una terminal (CMD, PowerShell, Git Bash).
Navega a la carpeta donde quieres guardar el proyecto (ej: C:\MisProyectos).
Ejecuta:
bash




git clone https://github.com/Alberth812/boletoslaravel.git
cd boletoslaravel
Instalar Dependencias:
Dentro de la carpeta boletoslaravel, ejecuta:
bash



composer install
Configurar el Entorno (.env):
Copia el archivo .env.example y créale una copia llamada .env:
bash



copy .env.example .env
Genera la clave de la aplicación:
bash



php artisan key:generate
Edita el archivo .env y asegúrate de que la configuración de la base de datos sea correcta (normalmente no necesitas cambiar nada si usas XAMPP por defecto):


DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=boletoslaravel
DB_USERNAME=root
DB_PASSWORD=
Crear la Base de Datos:
Abre phpMyAdmin (http://localhost/phpmyadmin ).
Crea una nueva base de datos llamada boletoslaravel.
Crear Tablas y Cargar Datos:
En la terminal, dentro de la carpeta del proyecto, ejecuta:
bash



php artisan migrate --seed
(Esto crea todas las tablas y llena la base de datos con información de ejemplo).
Levantar el Servidor:
En la terminal, ejecuta:
bash



php artisan serve
Verás un mensaje como: Starting Laravel development server: http://127.0.0.1:8000
Probar la API:
Abre tu navegador o Postman.
Ve a: http://127.0.0.1:8000/api/users
Deberías ver una lista de usuarios en formato JSON.

# Listado de rutas:
Para cada recurso, las rutas siguen este patrón:

Listar todos: GET /api/{recurso}
Crear uno: POST /api/{recurso}
Ver uno: GET /api/{recurso}/{id}
Actualizar uno: PUT /api/{recurso}/{id}
Eliminar uno: DELETE /api/{recurso}/{id}
Entonces, tus rutas completas son:

1. Usuarios (users)
GET http://127.0.0.1:8000/api/users (Listar todos)
POST http://127.0.0.1:8000/api/users (Crear uno)
GET http://127.0.0.1:8000/api/users/{id} (Ver uno)
PUT http://127.0.0.1:8000/api/users/{id} (Actualizar uno)
DELETE http://127.0.0.1:8000/api/users/{id} (Eliminar uno)

2. Ubicaciones (ubicaciones)
GET http://127.0.0.1:8000/api/ubicaciones
POST http://127.0.0.1:8000/api/ubicaciones
GET http://127.0.0.1:8000/api/ubicaciones/{id}
PUT http://127.0.0.1:8000/api/ubicaciones/{id}
DELETE http://127.0.0.1:8000/api/ubicaciones/{id}

3. Eventos (eventos)
GET http://127.0.0.1:8000/api/eventos
POST http://127.0.0.1:8000/api/eventos
GET http://127.0.0.1:8000/api/eventos/{id}
PUT http://127.0.0.1:8000/api/eventos/{id}
DELETE http://127.0.0.1:8000/api/eventos/{id}

4. Artistas (artistas)
GET http://127.0.0.1:8000/api/artistas
POST http://127.0.0.1:8000/api/artistas
GET http://127.0.0.1:8000/api/artistas/{id}
PUT http://127.0.0.1:8000/api/artistas/{id}
DELETE http://127.0.0.1:8000/api/artistas/{id}

5. Tipos de Boletos (tipos-de-boletos)
GET http://127.0.0.1:8000/api/tipos-de-boletos
POST http://127.0.0.1:8000/api/tipos-de-boletos
GET http://127.0.0.1:8000/api/tipos-de-boletos/{id}
PUT http://127.0.0.1:8000/api/tipos-de-boletos/{id}
DELETE http://127.0.0.1:8000/api/tipos-de-boletos/{id}

6. Paquetes de Boletos (paquetes-boletos)
GET http://127.0.0.1:8000/api/paquetes-boletos
POST http://127.0.0.1:8000/api/paquetes-boletos
GET http://127.0.0.1:8000/api/paquetes-boletos/{id}
PUT http://127.0.0.1:8000/api/paquetes-boletos/{id}
DELETE http://127.0.0.1:8000/api/paquetes-boletos/{id}

7. Eventos-Artistas (eventos-artistas)
GET http://127.0.0.1:8000/api/eventos-artistas
POST http://127.0.0.1:8000/api/eventos-artistas
GET http://127.0.0.1:8000/api/eventos-artistas/{id}
DELETE http://127.0.0.1:8000/api/eventos-artistas/{id}
(Nota: Para tablas pivote, generalmente no se usa PUT. Se elimina la relación y se crea una nueva).
Descuentos (descuentos)
GET http://127.0.0.1:8000/api/descuentos
POST http://127.0.0.1:8000/api/descuentos
GET http://127.0.0.1:8000/api/descuentos/{id}
PUT http://127.0.0.1:8000/api/descuentos/{id}
DELETE http://127.0.0.1:8000/api/descuentos/{id}

8. Compras (compras)
GET http://127.0.0.1:8000/api/compras
POST http://127.0.0.1:8000/api/compras
GET http://127.0.0.1:8000/api/compras/{id}
PUT http://127.0.0.1:8000/api/compras/{id}
DELETE http://127.0.0.1:8000/api/compras/{id}

9. Boletos (boletos)
GET http://127.0.0.1:8000/api/boletos
POST http://127.0.0.1:8000/api/boletos
GET http://127.0.0.1:8000/api/boletos/{id}
PUT http://127.0.0.1:8000/api/boletos/{id}
DELETE http://127.0.0.1:8000/api/boletos/{id}

10. Compra-Descuentos (compra-descuentos)
GET http://127.0.0.1:8000/api/compra-descuentos
POST http://127.0.0.1:8000/api/compra-descuentos
GET http://127.0.0.1:8000/api/compra-descuentos/{id}
DELETE http://127.0.0.1:8000/api/compra-descuentos/{id}
(Nota: Para tablas pivote, generalmente no se usa PUT. Se elimina la relación y se crea una nueva).










<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
