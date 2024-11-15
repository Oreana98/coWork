# Sistema de Gestión de Reservas de Salas de Cowork

## Descripción

Esta aplicación web permite a los usuarios reservar salas para trabajar o estudiar. Además, los administradores pueden gestionar las salas disponibles. Cuenta con dos roles principales:

-   **Admin**: Permite gestionar salas y usuarios.
-   **Customer**: Permite buscar y reservar salas.

## Características

-   **Reservar Sala**: Los usuarios pueden ver las salas disponibles, seleccionar una fecha y hora, y realizar reservas.
-   **Crear Sala**: Los administradores pueden agregar, editar o eliminar salas.
-   **Filtrar Información**: Filtros dinámicos para encontrar rápidamente salas disponibles según fecha, hora o tipo.

## Tecnologías Utilizadas

-   **PHP 8.1**: Lenguaje de programación usado para el backend.
-   **Laravel 9**: Framework de PHP utilizado para estructurar la aplicación y manejar lógica compleja.
-   **MySQL 8.1**: Sistema de gestión de bases de datos utilizado para almacenar información de usuarios, salas y reservas.

## Instalación

1.  **Clona** este repositorio:

    ```bash
    git clone https://github.com/tuusuario/tu-repositorio.git
    ```

2.  **Entra** al directorio del proyecto:

    ```bash
    cd tu-repositorio
    ```

3.  **Instala** las dependencias:

    composer install

4.  **Renombrar** el archivo .env.example a .env:

    cp .env.example .env

5.  **Crear** las tablas en la base de datos:
    php artisan migrate

6.  **Genera** un rol de administrador con datos iniciales (seeders):
    php artisan db:seed

## Uso

1.  **Inicia** el servidor:

    php artisan serve

2.  **Abre** `http://127.0.0.1:8000/` en tu navegador para usar la aplicación.
