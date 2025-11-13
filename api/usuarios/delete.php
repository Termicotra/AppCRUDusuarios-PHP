<?php
require_once '../../conf.php';
require_once '../../auth/jwt.php';

$headers = apache_request_headers();
$token = $headers['Authorization'] ?? '';

verificarToken($token);

$id = $_GET['id'] ?? null;

if (!$id) {
    http_response_code(400);
    echo json_encode(["error" => "ID no proporcionado"]);
    exit;
}

// Verificar si el usuario existe
$stmt = $conn->prepare("SELECT * FROM usuario WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();

if ($stmt->rowCount() === 0) {
    http_response_code(404);
    echo json_encode(["error" => "Usuario no encontrado"]);
    exit;
}

// Eliminar usuario
$delete = $conn->prepare("DELETE FROM usuario WHERE id = :id");
$delete->bindParam(':id', $id);
$delete->execute();

echo json_encode(["mensaje" => "Usuario eliminado correctamente"]);