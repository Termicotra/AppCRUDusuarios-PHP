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

$stmt = $conn->query("SELECT id, username FROM usuario");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($usuarios);