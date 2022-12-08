<?php

    require_once("../db/connection.inc.php");
    require_once("model/user.dao.php");
    // Verificar se o token é valido
    require_once('../auth/validar-jwt.inc.php');
    
    $userDAO = new UserDAO($pdo);

    // Se token Válido, extrai o email to token
    $email = array_values($decodedToken)[1];

    $responseBody = '';

    if (!$email) {
        http_response_code(400);
        $responseBody = '{ "message": "E-mail Inválido" }';
    } else {
        try {
            if ($userDAO -> delete($email) != 1) {
                // Muda o código de resposta HTTP para 'not found'
                http_response_code(404);
                $responseBody = '{ "message": "Usuário não encontrado" }';
            }
        } catch (Exception $e) {
            // Muda o código de resposta HTTP para 'bad request'
            http_response_code(401);
            $responseBody = '{ "message": "Ocorreu um erro ao tentar executar esta ação. Erro: Código: ' .  $e -> getCode() . '. Mensagem: ' . $e -> getMessage() . '" }';
        }
    }

    // Define que o conteúdo da resposta será um JSON (application/JSON)
    header('Content-Type: application/json');

    // Exibe a resposta
    print($responseBody);

?>