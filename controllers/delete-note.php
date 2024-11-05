<?php
require_once __DIR__.'/../models/Note.php';

session_start();
$userId = $_SESSION['user_id'] ?? null;
if ($userId && isset($_POST['note_id'])){
    $noteId = $_POST['note_id'];
    $pdo = new PDO('mysql:host=localhost;dbname=notes', 'root', ''); 
    $noteModel = new Note($pdo);
    $noteModel->deleteNote($noteId);
    header('Location: /dashboard');
    exit;
}

header('Location: /dashboard');