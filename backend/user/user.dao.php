<?php

class UserDAO {
    function __construct($pdo) {
        $this -> pdo = $pdo;
    }

    public function login($email, $password) {
        $stmt = $this -> pdo -> prepare("SELECT name, email FROM tb_user WHERE email = ? AND password = ?");
        $stmt -> bindParam(1, $email);
        $stmt -> bindParam(2, $password);

        $stmt -> execute();
        return $stmt -> fetchObject();
    }

    public function get($email) {
        $stmt = $this -> pdo -> prepare("SELECT * FROM tb_user WHERE email = ?");
        $stmt -> bindParam(1, $email);

        $stmt -> execute();
        return $stmt -> fetchObject();
    }

    public function getAll() {
        $stmt = $this -> pdo -> prepare("SELECT * FROMtb_user");
        $stmt -> execute();
    
        // Retorna um array de objetos
        return $stmt -> fetchAll(PDO::FETCH_CLASS);
    }
    
    public function insert($user) {
        $stmt = $this -> pdo -> prepare("INSERT INTO tb_user (name, email,  password) VALUES (:name, :email, :password)");
        $stmt -> bindValue(':name', $user -> name);
        $stmt -> bindValue(':email', $user -> email);
        $stmt -> bindValue(':password', $user -> password);
    
        $stmt -> execute();
        $user = clone $user;
    
        $user -> id = $this -> pdo -> lastInsertId();
    
        return $user;
    }
    
    public function update($email, $user) {
        $stmt = $this -> pdo -> prepare("UPDATE tb_user
            SET
                name = :name,
                email = :email,
                password = :password
            WHERE
                email = :email");
    
        $data = [
            'name' => $user -> name,
            'email' => $user -> email,
            'password' => $user -> password,
        ];
    
        return $stmt -> execute($data);
    }
    
    public function delete($email) {
        $stmt = $this -> pdo -> prepare("DELETE from tb_user WHERE email = ?");
        $stmt -> bindParam(1, $email);
    
        $stmt -> execute();
    
        return $stmt -> rowCount(); // Retorna a quantidade de linhas afetadas
    }
}

?>