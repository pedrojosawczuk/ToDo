<?php

    require_once("../db/connection.inc.php");
    require_once("model/user.dao.php");
    // Verificar se o token é valido
    require_once("../auth/validar-jwt.inc.php");

    $userDAO = new UserDAO($pdo);

    // Se token Válido, extrai o email to token
    $email = array_values($decodedToken)[1];

    $responseBody = '';

    if (!$email) { // Retornar um único objeto pelo ID
        $user = $userDAO -> getAll();
        $responseBody = json_encode($user);
    } else {
        try {
            $user = $userDAO -> getById($email);
            $responseBody = json_encode($user);
        } catch (Exception $e) {
            // Muda o código de resposta HTTP para 'bad request'
            http_response_code(401);
            $responseBody = '{ "message": "Ocorreu um erro ao tentar executar   esta ação. Erro: Código: ' .  $e -> getCode() . '. Mensagem: ' .  $e -> getMessage() . '" }';
        }
    }

    // Defique que o conteúdo da resposta será um JSON (application/JSON)
    header('Content-Type: application/json');

    // Exibe a resposta
    print_r($responseBody);

?>