<?php
require_once __DIR__.'/../database.php';
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
    public function getUserNotes($user_id, $perPage, $currentPage, $order){
        $noteModel = new Note($this->pdo);
        $notes = $noteModel->findNotesPagination($user_id, $perPage, $currentPage, $order);
        return $notes;
    }


    public function getTotalNotes($user_id){
        $noteModel = new Note($this->pdo);
        $totalNotes = $noteModel->countUserNotes($user_id);
        return $totalNotes;
    }

    public function loadDashboardView($notes, $totalPages, $currentPage, $perPage, $order){
        extract([
            'notes' => $notes,
            'totalPages' => $totalPages,
            'perPage' => $perPage,
            'currentPage' => $currentPage,
            'order' => $order
        ]);
        require_once __DIR__.'/../views/dashboard.view.php';
    }
}

session_start();
$userId = $_SESSION['user_id'] ?? null;
if ($userId){
    $dashboard = new Dashboard();
    $perPage = isset($_GET['perPage']) ? (int)$_GET['perPage'] : 5;
    $currentPage = $_GET['page'] ?? 1;
    $order = $_GET['order'] ?? 'newest';
    $totalNotes = $dashboard->getTotalNotes($userId);
    $totalPages = ceil($totalNotes / $perPage);
    $notes = $dashboard->getUserNotes($userId,$perPage, $currentPage, $order);
    $dashboard->loadDashboardView($notes, $totalPages, $currentPage, $perPage,$order);
}
