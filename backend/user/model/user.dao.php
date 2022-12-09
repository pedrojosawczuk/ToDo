<?php

    class UserDAO {
        function __construct($pdo) {
            $this -> pdo = $pdo;
        }
    
        public function login($email, $password) {
            $sql = "SELECT * FROM tb_user WHERE email = ? AND password = ?";
            $stmt = $this -> pdo -> prepare($sql);
            $stmt -> bindParam(1, $email);
            $stmt -> bindParam(2, $password);
        
            $stmt -> execute();
            return $stmt -> fetchObject();
        }
    
        public function getById($email) {
            $sql = "SELECT * FROM tb_user WHERE email = ?";
            $stmt = $this -> pdo -> prepare($sql);
            $stmt -> bindParam(1, $email);
        
            $stmt -> execute();
            return $stmt -> fetchObject();
        }
    
        public function getAll() {
            $sql = "SELECT * FROM tb_user";
            $stmt = $this -> pdo -> prepare($sql);
            $stmt -> execute();
        
            // Retorna um array de objetos
            return $stmt -> fetchAll(PDO::FETCH_CLASS);
        }
        
        public function insert($user) {
            $sql = "INSERT INTO tb_user (name, email, password)
                VALUES (:name, :email, :password)";
            $stmt = $this -> pdo -> prepare($sql);
        
            $stmt -> bindValue(':name', $user -> name);
            $stmt -> bindValue(':email', $user -> email);
            $stmt -> bindValue(':password', $user -> password);
            
            $stmt -> execute();
            $user = clone $user;
        
            $user -> id = $this -> pdo -> lastInsertId();
        
            return $user;
        }
        
        public function update($email_token, $user) {
            $sql = "UPDATE tb_user SET 
                name = :name,
                email = :email,
                password = :password
                WHERE email = :email_token";
            
            $stmt = $this -> pdo -> prepare($sql);
            $stmt -> bindValue(':name', @$user -> name);
            $stmt -> bindValue(':email', @$user -> email);
            $stmt -> bindValue(':password', @$user -> password);
            $stmt -> bindValue(':email_token', @$email_token);
        
            $stmt -> execute();
            $user = clone $user;
        
            $user -> id = $this -> pdo -> lastInsertId();
        
            return $user;
        }
        
        public function delete($email_token) {
            $sql = "DELETE FROM tb_user WHERE email = :email_token";
        
            $stmt = $this -> pdo -> prepare($sql);
            $stmt -> bindValue(':email_token', @$email_token);
        
            $stmt -> execute();
        
            return $stmt -> rowCount(); // Retorna a quantidade de linhas afetadas
        }
    }

?>