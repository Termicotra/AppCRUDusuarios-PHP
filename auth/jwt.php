<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require_once __DIR__ . '/../vendor/autoload.php';

$secret_key = "Ms.0#O(sZJNq*6S28-U6@5;d"; // Clave aleatoria de internet con passwordgenerator

function generarToken($username) {
    global $secret_key;
    $payload = [
        "iss" => "TP_Final",
        "aud" => "TP_Final",
        "iat" => time(),
        "exp" => time() + 3600,
        "data" => [
            "username" => $username
        ]
    ];
    return JWT::encode($payload, $secret_key, 'HS256');
}

function verificarToken($token) {
    global $secret_key;
    try {
        $decoded = JWT::decode($token, new Key($secret_key, 'HS256'));
        return $decoded->data;
    } catch (Exception $e) {
        return null;
    }
}