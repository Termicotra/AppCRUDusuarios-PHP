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
if (!$id) {
    http_response_code(400);
    echo json_encode(["error" => "ID requerido"]);
    exit;
}

$stmt = $conn->prepare("SELECT id, username FROM usuario WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
if ($usuario) {
    echo json_encode($usuario);
} else {
    http_response_code(404);
    echo json_encode(["error" => "Usuario no encontrado"]);
}