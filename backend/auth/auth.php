<?php

require 'jwtutil.class.php';
require 'config.php';
    
// 1) Receber as credenciais do usuário

// Obtendo o body da requisição HTTP
$json = file_get_contents('php://input');
    
// Transforma o JSON em objeto PHP
$credentials = json_decode($json);

$email = $credentials -> email;
$password = $credentials -> password;

// 2) Validar as credenciais do usuário
if(@$credentials -> email == 'admin' && @$credentials -> password == '1234') {
        
    // 3) Devolver o toke caso o usuário esteja ok

    // Carga útil do token (payload)
    $payload = [
        'id' => $id, // ID do usuário
        'email' => $email, // EMAIL to usuário
    ];

    // Gerar o token
    $jwt = JwtUtil::encode($payload, JWT_SECRET_KEY);
    
    $responseBody = "{ \"token\": \"$jwt\" }";

}
// Caso o usuário e senha sejam inválidos
else {
    http_response_code(401); // Status não autorizado
    $responseBody = '{ "message": "Credenciais inválidas" }';
}

header("Content-type: application/json");
print_r($responseBody);

?>