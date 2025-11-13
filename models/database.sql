-- Crear base de datos (opcional si ya existe)
CREATE DATABASE IF NOT EXISTS tp_final;
USE tp_final;

-- Crear tabla usuario
CREATE TABLE IF NOT EXISTS usuario (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

-- Insertar usuario administrador (contraseña sin encriptar: 1234)
INSERT INTO usuario (username, password)
VALUES ('admin', '1234');