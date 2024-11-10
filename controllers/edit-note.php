<?php
require_once __DIR__.'/../Database.php';
require_once __DIR__.'/../models/Note.php';

class EditNote {
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

    public function handleEditNote() {
        $this->startSession();
        $userId = $_SESSION['user_id'] ?? null;
        $noteId = $_GET['note_id'] ?? null;
        $error = null;

        if ($noteId && $userId) {
            $noteModel = new Note($this->pdo);
            $note = $noteModel->findNoteById($noteId);

            if (!$note) {
                $error = "Note not found.";
                return $error;
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $title = trim($_POST['title']);
                $content = trim($_POST['content']);
                $private = isset($_POST['private']) ? 1 : 0;

                if (!empty($title) && !empty($content)) {
                    $noteModel->updateNote($noteId, $title, $content, $private);
                    header('Location: /dashboard');
                    exit;
                } else {
                    $error = 'Both title and content are required.';
                }
            }
            return [$note, $error];
        }
        return "Invalid user or note ID.";
    }

    public function loadEditNoteView($note = null, $error = null) {
        require_once __DIR__.'/../views/edit-note.view.php';
    }
}

$editNote = new EditNote();
[$note, $error] = $editNote->handleEditNote();
$editNote->loadEditNoteView($note, $error);
