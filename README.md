# To-Do List

## Descripción

To-Do List es una aplicación web que te permite gestionar tus tareas diarias de manera eficiente. Con una interfaz intuitiva y un diseño moderno y dinamico, puedes añadir, editar y eliminar tareas, así como marcar las completadas.

## Funcionalidades

- **Registro de Usuarios**: Registro y manejo de la informacion de usuarios.
- **Login**: Ingreso al aplicativo con un usuario unico.
- **Añadir Tareas**: Permite agregar nuevas tareas a tu lista.
- **Eliminar Tareas**: Puedes eliminar tareas especificas.
- **Editar Tareas**: Modifica el contenido de tareas existentes.
- **Marcar como Completadas**: Marca las tareas que has terminado.
- **Visualizar Tareas**: Obten una lista de las tareas que han creado todos los usuarios.

## Despliegue

Para desplegar el proyecto en tu entorno local, sigue estos pasos:

1. **Requerimientos del Sistema**:
    ```bash
    PHP -v8.2.12
    Composer -v2.7.8
    7zip -24.08
    Node JS -v20.17.0
    ```

2. **Clonar el Repositorio**:
    ```bash
    git clone https://github.com/bsalazar83/to-do-list.git
    cd to-do-list
    ```

3. **Instala las Dependencias de PHP**:
    ```bash
    composer install
    ```

4. **Configura el Entorno**:
    Copia el archivo `.env.example` a `.env` y configura las variables de entorno según tus necesidades.
    ```bash
    cp .env.example .env
    ```

5. **Genera la Clave de Aplicación**:
    ```bash
    php artisan key:generate
    ```

6. **Ejecuta las Migraciones**:
    ```bash
    php artisan migrate
    ```

7. **Instala las Dependencias de Node.js**:
    ```bash
    npm install
    ```

8. **Construye los Estilos con TailwindCSS**:
    ```bash
    npm run build
    ```

9. **Inicia el Servidor de Desarrollo**:
    ```bash
    php artisan serve
    ```

## Tecnologías Usadas

Este proyecto está desarrollado con las siguientes tecnologías:

- ![Laravel 11](https://img.shields.io/badge/Laravel-v11.21.0-brightgreen)
- ![TailwindCSS](https://img.shields.io/badge/TailwindCSS-v3.1.0-blue)
- ![Node.js](https://img.shields.io/badge/Node.js-v20.17.0-green)
- ![AJAX/jQuery](https://img.shields.io/badge/AJAX/jQuery-3.6.0-blueviolet)

## Licencia

Este proyecto está licenciado bajo la [MIT License](LICENSE).

## Contacto

Si tienes alguna pregunta o sugerencia, no dudes en ponerte en contacto conmigo a través de [brandonsalazar545@gmail.com](mailto:brandonsalazar545@gmail.com).
