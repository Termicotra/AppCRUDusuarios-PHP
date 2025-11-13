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

$id = $_GET['id'] ?? null;
$data = json_decode(file_get_contents("php://input"), true);
$username = $data['username'] ?? '';
$password = $data['password'] ?? '';

if (!$id || !$username || !$password) {
    http_response_code(400);
    echo json_encode(["error" => "Datos incompletos"]);
    exit;
}

$stmt = $conn->prepare("UPDATE usuario SET username = :username, password = :password WHERE id = :id");
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);
$stmt->bindParam(':id', $id);

if ($stmt->execute()) {
    echo json_encode(["message" => "Usuario actualizado"]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Error al actualizar usuario"]);
}