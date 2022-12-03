<?php

require 'jwtutil.class.php';
require 'config.php';

$token = @getallheaders()['authorization'];

$responseBody = '';

if($token) {
    $decoded = JwtUtil::decode($token, JWT_SECRET_KEY);
        
} else {
    http_response_code(401); // Não autorizado
    $responseBody = '{ "message": "Sem token" }';
}

print_r($decoded);

// Se existir $responseBody == não está autorizado
if($responseBody) { // Mostrar a resposta para o cliente
    $responseBody = '{ "message": "Token inválido" }';

    // Defique que o conteúdo da resposta será um JSON (application/JSON)
    header('Content-Type: application/json');
    
    // Exibe a resposta
    print_r($responseBody);
    exit; // Encerra o script
}

?>