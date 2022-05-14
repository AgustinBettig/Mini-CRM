## Mini-CRM

# Requerimientos:
    PHP: 8.0.12
    Tipo de servidor: 10.4.21 MariaDB
    Framework: Laravel 8

# Como levantar el proyecto 

Comenzamos realizando la descarga del repositorio
-- Creamos una data base.

-- Copiamos el env.example y editamos el archivo `.ENV` asociando nuestra data base.
    **cp .env.example .env**

-- Luego  `npm install && npm run dev` para reinstalar nuestros paquetes y scripts.

-- `php artisan migrate` aquí realizamos las migraciones.

-- `php artisan db:seed` con este comando ejecutamos el seeder que crea nuestro usuario admin.

-- `php artisan storage:link` Realiza el enlace simbolico.

Ejecutar `php artisan serve` e iniciar sesion con el usuario admin.




