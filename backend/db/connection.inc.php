<?php
    // Variáveis
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'db_todo';
    $port = 3306;

    // Connect to the MySQL database using the PDO object.

    $pdo = new PDO("mysql:host=$host;dbname=$db;port=$port", 
        $user, $pass);