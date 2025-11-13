<?php
require_once '../../conf.php';
require_once '../../auth/jwt.php';

$headers = apache_request_headers();
$token = $headers['Authorization'] ?? '';

if (!$token || !verificarToken($token)) {
    http_response_code(401);
    echo json_encode(["error" => "Token inválido o ausente"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$username = $data['username'] ?? '';
$password = $data['password'] ?? '';

if (!$username || !$password) {
    http_response_code(400);
    echo json_encode(["error" => "Datos incompletos"]);
    exit;
}

$stmt = $conn->prepare("INSERT INTO usuario (username, password) VALUES (:username, :password)");
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password); // usar password_hash en producción

if ($stmt->execute()) {
    echo json_encode(["message" => "Usuario creado"]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Error al crear usuario"]);
}