<?php
require_once __DIR__.'/../database.php';
require_once __DIR__.'/../models/Note.php';

class createNote
{
    private $pdo;

    public function __construct(){
        $config = require __DIR__.'/../config.php';
        $dbConfig = $config['database'];

        $database = new Database($dbConfig);
        $this->pdo = $database->connection;
    }

    public function startSession(){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
    }
    public function handleCreateNote(){
        $this->startSession();
        $userId = $_SESSION['user_id'] ?? null;
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $userId){
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);
            $private = isset($_POST['private']) ? 1 : 0;

            if (!empty($title) && !empty($content)){
                $noteModel = new Note($this->pdo);
                $noteModel->createNote($userId,$title, $content, $private);
                header('Location: /dashboard');
                exit;
            } else{$error = 'Both title and content are required';
            }
            
        }
        return $error;
    }

    public function loadCreateNoteView($error = null){
        require_once __DIR__.'/../views/create-note.view.php';
    }

}

$createNote = new createNote();
$error = $createNote->handleCreateNote();
$createNote->loadCreateNoteView($error);
