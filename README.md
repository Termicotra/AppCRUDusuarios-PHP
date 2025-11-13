# AppCRUDLoginUsuarios

##  Descripción

AppCRUDLoginUsuarios es una aplicación web desarrollada en PHP que permite gestionar usuarios mediante operaciones CRUD (Crear, Leer, Actualizar, Eliminar) protegidas por autenticación JWT. Incluye un sistema de login con control de acceso, vistas dinámicas con AJAX y una interfaz diferenciada para administradores.

##  Tecnologías utilizadas

- PHP 8.3
- Apache 2.4 (WAMP)
- MySQL
- JWT (Firebase/php-jwt)
- Composer
- Bootstrap 5
- JavaScript (AJAX)
- Postman o Httpie (para pruebas de API)

##  Tutorial de uso

### 1. Extraer el .zip del proyecto en `C:\wamp64\www\TP_Final`

### 2. Configurar la base de datos
- Ejecutar el archivo database.sql
#### Alternativa 
- Crear una base de datos MySQL llamada `tp_final`
- Importar la tabla `usuario`:

`CREATE TABLE usuario (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL
);`

- Insertar un usuario administrador:
`INSERT INTO usuario (username, password) VALUES ('admin', '1234');`

### 3. Instalar dependencias JWT
`composer require firebase/php-jwt`

### 4. Configurar Apache
- Verificá que el proyecto esté accesible desde `http://localhost/TP_Final/`

### 5. Iniciar sesión
- Accedé a `http://localhost/TP_Final/Views/login/index.php`
- Ingresá con credenciales válidas (por ejemplo: admin / 1234)
- Si el usuario es admin, se habilita el panel CRUD con formularios dinámicos

### 6. Usar el panel CRUD
Desde welcome/index.php, el usuario admin puede:
- Ver todos los usuarios
- Crear nuevos usuarios
- Actualizar usuarios existentes
- Eliminar usuarios por ID
Todas las operaciones se realizan vía AJAX contra la API protegida con JWT.
7. Probar la API con Postman
Crear una colección en Postman o Httpie con los siguientes endpoints:  

    `http://localhost/TP_Final/api/usuarios/login.php  `
    
    `http://localhost/TP_Final/api/usuarios/create.php  `


    `http://localhost/TP_Final/api/usuarios/index.php  `

    `http://localhost/TP_Final/api/usuarios/read.php?id=1  `

    `http://localhost/TP_Final/api/usuarios/update.php?id=1  `
    
    `http://localhost/TP_Final/api/usuarios/delete.php?id=1  `


En cada request protegida, agregar el header:
`Authorization: <token JWT>`

Se puede guardar el token como variable de entorno en Postman para reutilizarlo fácilmente.





