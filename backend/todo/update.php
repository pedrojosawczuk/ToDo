<?php

    require_once("../db/connection.inc.php");
    require_once("model/todo.dao.php");
    // Verificar se o token é valido
    require_once('../auth/validar-jwt.inc.php');
    
    $todoDAO = new TodoDAO($pdo);
    
    // Se token Válido, extrai o email to token
    $userId = array_values($decodedToken)[0];
    
    // Obter o corpo da requisição
    $json = file_get_contents('php://input');
    
    // Transforma o JSON em um Objeto PHP
    $todo = json_decode($json);
    
    $responseBody = '';
    
    if (!$userId) {
        http_response_code(400);
        $responseBody = '{ "message": "Token não informado" }';
    } else {
        try {
            $todoDAO -> update($userId, $todo);
        } catch (Exception $e) {
            // Muda o código de resposta HTTP para 'bad request'
            http_response_code(400);
            $responseBody = '{ "message": "Ocorreu um erro ao tentar executar esta ação. Erro:  Código: ' .  $e -> getCode() . '. Mensagem: ' . $e -> getMessage() . '" }';
        }
    }
    
    // Defique que o conteúdo da resposta será um JSON (application/JSON)
    header('Content-Type: application/json');
    
    // Exibe a resposta
    print_r($responseBody);

?>