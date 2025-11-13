<?php
session_start();
require_once '../conf.php';
require_once '../auth/jwt.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(403);
    echo "Acceso no autorizado";
    exit;
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Validar usuario
$stmt = $conn->prepare("SELECT * FROM usuario WHERE username = :username AND password = :password");
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    
    $_SESSION['username'] = $username;

    
    $token = generarToken($username);
    $_SESSION['token'] = $token;

    
    header("Location: ../views/welcome/index.php");
    exit;
} else {
    header("Location: ../views/login/index.php?error=Credenciales inválidas&invalid=1");
    exit;
}