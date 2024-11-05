<?php
class Todo {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getUserTodos($userId) {
        $stmt = $this->pdo->prepare('SELECT * FROM todos WHERE user_id = :user_id ORDER BY created_at DESC');
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addTodoItem($userId, $description) {
        $stmt = $this->pdo->prepare('INSERT INTO todos (user_id, description) VALUES (:user_id, :description)');
        $stmt->execute(['user_id' => $userId, 'description' => $description]);
    }

    public function updateTodoDescription($todoId, $description) {
        $stmt = $this->pdo->prepare('UPDATE todos SET description = :description WHERE id = :id');
        $stmt->execute(['description' => $description, 'id' => $todoId]);
    }

    public function updateTodoItem($todoId, $completed) {
        $stmt = $this->pdo->prepare('UPDATE todos SET completed = :completed WHERE id = :id');
        $stmt->execute(['completed' => $completed, 'id' => $todoId]);
    }

    public function deleteTodoItem($todoId) {
        $stmt = $this->pdo->prepare('DELETE FROM todos WHERE id = :id');
        $stmt->execute(['id' => $todoId]);
    }
}
