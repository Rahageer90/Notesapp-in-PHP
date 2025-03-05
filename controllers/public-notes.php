<?php
require_once __DIR__.'/../database.php';
require_once __DIR__.'/../models/Note.php';

class PublicNotes {
    private $pdo;

    public function __construct() {
        $config = require __DIR__.'/../config.php';
        $dbConfig = $config['database'];

        $database = new Database($dbConfig);
        $this->pdo = $database->connection;
    }

    public function getPublicNotes() {
        $noteModel = new Note($this->pdo);
        $publicNotes = $noteModel->fetchPublicNotes();
        return $publicNotes;
    }

    public function loadPublicNotesView($notes) {
        require_once __DIR__.'/../views/public-notes.view.php';
    }
}

$publicNotes = new PublicNotes();
$notes = $publicNotes->getPublicNotes();
$publicNotes->loadPublicNotesView($notes); // Pass the $notes variable correctly
