<?php
require_once __DIR__.'/../Database.php';
require_once __DIR__.'/../models/Note.php';

class Dashboard {
    private $pdo;

    public function __construct()
    {
        $config = require __DIR__.'/../config.php';
        $dbConfig = $config['database'];

        $database = new Database($dbConfig);
        $this->pdo = $database->connection;
    }
    public function getUserNotes($user_id){
        $noteModel = new Note($this->pdo);
        $notes = $noteModel->findNotesByUserId($user_id);
        return $notes;
    }

    public function loadDashboardView($notes){
        require_once __DIR__.'/../views/dashboard.view.php';
    }
}

session_start();
$userId = $_SESSION['user_id'] ?? null;
if ($userId){
    $dashboard = new Dashboard();
    $notes = $dashboard->getUserNotes($userId);
    $dashboard->loadDashboardView($notes);
}