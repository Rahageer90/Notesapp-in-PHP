<?php
require_once __DIR__.'/../database.php';
require_once __DIR__.'/../models/Note.php';

session_start();
$userId = $_SESSION['user_id'] ?? null;

if ($userId && $_SERVER['REQUEST_METHOD'] === 'POST'){
    $noteIds = $_POST['note_ids'] ?? [];

    if (!empty($noteIds)){
        $config = require __DIR__.'/../config.php';
        $dbConfig = $config['database'];
        $database = new Database($dbConfig);
        $pdo = $database->connection;

        $noteModel = new Note($pdo);
        foreach ($noteIds as $noteId){
            $noteModel->deleteNote($noteId);
        }
    }
}

header('Location: /dashboard');
exit;
