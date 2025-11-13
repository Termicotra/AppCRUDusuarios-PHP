<?php
require_once __DIR__ . '/../conf.php'; // conexión a la base de datos

try {
    // Crear tabla si no existe
    $sqlCreate = "CREATE TABLE IF NOT EXISTS usuario (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        password VARCHAR(255) NOT NULL
    )";
    $conn->exec($sqlCreate);

    // Insertar usuario solo si no existe
    $sqlCheck = "SELECT COUNT(*) FROM usuario WHERE username = 'admin'";
    $stmt = $conn->query($sqlCheck);
    $exists = $stmt->fetchColumn();

    if ($exists == 0) {
        $sqlInsert = "INSERT INTO usuario (username, password) VALUES ('admin', '1234')";
        $conn->exec($sqlInsert);
        echo "Tabla 'usuario' creada y usuario 'admin' insertado.";
    } else {
        echo "Tabla 'usuario' ya existe y el usuario 'admin' ya está registrado.";
    }

} catch (PDOException $e) {
    echo "Error al crear la tabla o insertar datos: " . $e->getMessage();
}
?>