<?php
$host = 'localhost';       // o la IP del servidor MySQL
$port = 3306;              // puerto por defecto de MySQL
$dbname = 'TP_Final_SPD';  // nombre de la base de datos
$username = 'root';  // reemplaza con tu usuario de MySQL
$password = ''; // reemplaza con tu contraseña

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Conexión exitosa a la base de datos.";
} catch (PDOException $e) {
    //echo "Error de conexión: " . $e->getMessage();
}
?>