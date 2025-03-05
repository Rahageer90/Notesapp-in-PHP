<?php
require_once __DIR__.'/../database.php';
require_once __DIR__.'/../models/Todo.php';

class TodoList {
    private $pdo;

    public function __construct() {
        $config = require __DIR__.'/../config.php';
        $dbConfig = $config['database'];

        $database = new Database($dbConfig);
        $this->pdo = $database->connection;
    }

    public function startSession() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function handleTodoList() {
        $this->startSession();
        $userId = $_SESSION['user_id'] ?? null;
        $error = null;

        if (!$userId) {
            header('Location: /login');
            exit;
        }

        $todoModel = new Todo($this->pdo);
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['description']) && !isset($_POST['edit_id'])) {
            $description = trim($_POST['description']);
            if (!empty($description)) {
                $todoModel->addTodoItem($userId, $description);
                header('Location: /todo-list');
                exit;
            } else {
                $error = 'Description is required.';
            }
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'], $_POST['description'])) {
            $todoId = $_POST['edit_id'];
            $description = trim($_POST['description']);
            if (!empty($description)) {
                $todoModel->updateTodoDescription($todoId, $description);
                header('Location: /todo-list');
                exit;
            } else {
                $error = 'Description cannot be empty.';
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['todo_id'], $_POST['completed'])) {
            $todoId = $_POST['todo_id'];
            $completed = $_POST['completed'] == '1';
            $todoModel->updateTodoItem($todoId, $completed);
            header('Location: /todo-list');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
            $todoId = $_POST['delete_id'];
            $todoModel->deleteTodoItem($todoId);
            header('Location: /todo-list');
            exit;
        }

        $todos = $todoModel->getUserTodos($userId);
        return [$todos, $error];
    }

    public function loadTodoListView($todos = [], $error = null) {
        require_once __DIR__.'/../views/todo-list.view.php';
    }
}

$todoList = new TodoList();
[$todos, $error] = $todoList->handleTodoList();
$todoList->loadTodoListView($todos, $error);
