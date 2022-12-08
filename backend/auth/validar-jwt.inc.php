<?php

require 'jwtutil.class.php';
require 'config.php';

$token = @getallheaders()['authorization'];

$responseBody = '';

if(!isset($token)) {
    http_response_code(401);
    $responseBody = '{ "message": "Sem token" }';
} else {
    try {
        $decodedToken = JwtUtil::decode($token, JWT_SECRET_KEY);
    } catch (Exception $e) {
        // Muda o código de resposta HTTP para 'bad request'
        http_response_code(401);
        $responseBody = '{ "message": "Ocorreu um erro ao tentar executar esta ação. Erro: Código: ' .  $e -> getCode() . '. Mensagem: ' . $e -> getMessage() . '" }';
    }
}

if ($responseBody) {
    // Define que o conteúdo da resposta será um JSON (application/JSON)
    header('Content-Type: application/json');

    // Exibe a resposta
    print_r($responseBody);

    exit; // Encerra o script
}
?>