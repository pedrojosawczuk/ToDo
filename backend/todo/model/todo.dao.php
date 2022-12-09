<?php

class TodoDAO {
    function __construct($pdo) {
        $this -> pdo = $pdo;
    }

    public function getById($userId, $todoId) {
        $sql = "SELECT id, title, description, deadline, status, created_at, updated_at FROM tb_todo WHERE id = :id AND fk_user = :fk_user";
        $stmt = $this -> pdo -> prepare($sql);
        $stmt -> bindValue(':id', $todoId);
        $stmt -> bindValue(':fk_user', $userId);
        $stmt -> execute();

        return $stmt -> fetchObject();
    }

    public function getAll($userId) {
        $sql = "SELECT * FROM tb_todo WHERE fk_user = :fk_user";
        $stmt = $this -> pdo -> prepare($sql);
        $stmt -> bindValue(':fk_user', $userId);
        $stmt -> execute();
    
        // Retorna um array de objetos
        return $stmt -> fetchAll(PDO::FETCH_CLASS);
    }

    public function insert($userId, $todo) {
        $sql = "INSERT INTO tb_todo (title, description, deadline, status, fk_user)
            VALUES (:title, :description, :deadline, :status, :fk_user)";
        $stmt = $this -> pdo -> prepare($sql);

        $stmt -> bindValue(':title', $todo -> title);
        $stmt -> bindValue(':description', $todo -> description);
        $stmt -> bindValue(':deadline', $todo -> deadline);
        $stmt -> bindValue(':status', $todo -> status);
        $stmt -> bindValue(':fk_user', $userId);
        $stmt -> execute();
        $todo = clone $todo;
    
        $todo -> id = $this -> pdo -> lastInsertId();
    
        return $todo;
    }
    
    public function update($userId, $todo) {
        $sql = "UPDATE tb_todo SET 
            title = :title,
            description = :description,
            deadline = :deadline,
            status = :status
            WHERE id = :id AND fk_user = :fk_user";
        
        $stmt = $this -> pdo -> prepare($sql);
        $stmt -> bindValue(':id', $todo -> id);
        $stmt -> bindValue(':title', $todo -> title);
        $stmt -> bindValue(':description', $todo -> description);
        $stmt -> bindValue(':deadline', $todo -> deadline);
        $stmt -> bindValue(':status', $todo -> status);
        $stmt -> bindValue(':fk_user', $userId);

        $stmt -> execute();
        $todo = clone $todo;
    
        $todo -> id = $this -> pdo -> lastInsertId();
    
        return $todo;
    }

    public function delete($userId, $todoId) {
        $sql = "DELETE FROM tb_todo WHERE id = :id AND fk_user = :fk_user";

        $stmt = $this -> pdo -> prepare($sql);
        $stmt -> bindValue(':id', $todoId);
        $stmt -> bindValue(':fk_user', $userId);

        $stmt -> execute();

        return $stmt -> rowCount(); // Retorna a quantidade de linhas afetadas
    }
}

?>