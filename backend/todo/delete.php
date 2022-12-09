<?php

require_once("../db/connection.inc.php");
require_once("model/todo.dao.php");
// Verificar se o token é valido
//require_once('../auth/validar-jwt.inc.php');
    
$todoDAO = new TodoDAO($pdo);
/*
// Obter o corpo da requisição
$json = file_get_contents('php://input');

// Transforma o JSON em um Objeto PHP
$todo = json_decode($json);

$userId = 1;
$todoId = $todo -> id;
*/

$todoId = $_REQUEST['id'];
$userId = $_REQUEST['id_user'];

$responseBody = '';

if (!$todoId) {
    http_response_code(400);
    $responseBody = '{ "message": "Id Inválido!" }';
} else {
    try {
        if ($todoDAO -> delete($userId, $todoId) != 1) {
            // Muda o código de resposta HTTP para 'not found'
            http_response_code(404);
            $responseBody = '{ "message": "Todo não encontrado" }';
        }
    } catch (Exception $e) {
        // Muda o código de resposta HTTP para 'bad request'
        http_response_code(400);
        $responseBody = '{ "message": "Ocorreu um erro ao tentar executar esta ação. Erro: Código: ' .  $e -> getCode() . '. Mensagem: ' . $e -> getMessage() . '" }';
    }
}

// Define que o conteúdo da resposta será um JSON (application/JSON)
header('Content-Type: application/json');

// Exibe a resposta
print($responseBody);

?>