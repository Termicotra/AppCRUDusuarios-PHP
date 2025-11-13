<?php
require_once '../../conf.php';
require_once '../../auth/jwt.php';

$data = json_decode(file_get_contents("php://input"), true);
$username = $data['username'] ?? '';
$password = $data['password'] ?? '';

$stmt = $conn->prepare("SELECT * FROM usuario WHERE username = :username AND password = :password");
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $token = generarToken($username);
    echo json_encode(["token" => $token]);
} else {
    http_response_code(401);
    echo json_encode(["error" => "Credenciales inválidas"]);
}