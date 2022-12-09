<?php

require_once("../db/connection.inc.php");
require_once("model/user.dao.php");

require('../auth/jwtutil.class.php');
require('../auth/config.php');

$userDAO = new UserDAO($pdo);

// Obter o corpo da requisição
$json = file_get_contents('php://input');

// Transforma o JSON em um Objeto PHP
$user = json_decode($json);

@$email = $user -> email;
@$password = $user -> password;
/*
$user = $_REQUEST;

$email = $user['email'];
$password = $user['password'];*/
/*
print_r($user);
print_r($email);
print_r($password);
*/
$responseBody = '';

if (($email == '') && ($password == '')) { // Retornar um único objeto pelo EMAIL e SENHA
    http_response_code(403);
    $responseBody = '{ "message": "Usuário/Senha não podem estar vázios!!!" }';
} else {
    try {
        $user = $userDAO -> login($email, $password);
        $responseBody = json_encode($user);

        if($user) {
            @$id = $user -> id;
            @$email = $user -> email;
    
            // Carga útil do token (payload)
            $payload = [
                'id' => $id, // user id
                'email' => $email, // user email
            ];
    
            // Gerar o token
            $jwt = JwtUtil::encode($payload, JWT_SECRET_KEY);
            
            /*$responseBody = "{ \"token\": \"$jwt\" }";*/
            $responseBody = "{ \"id\": \"$id\" }";
        } else {
            $responseBody = '{ "message": "Usuário/Senha Inválidos" }';
        }
    } catch (Exception $e) {
        // Muda o código de resposta HTTP para 'bad request'
        http_response_code(400);
        $responseBody = '{ "message": "Ocorreu um erro ao tentar executar esta ação. Erro: Código: ' .  $e -> getCode() . '. Mensagem: ' . $e -> getMessage() . '" }';
    }
}

// Defique que o conteúdo da resposta será um JSON (application/JSON)
header('Content-Type: application/json');

// Exibe a resposta
print_r($responseBody);

?>