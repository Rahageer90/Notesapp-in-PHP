<?php
class Note{
    private $pdo;
    public function __construct($pdo){
        $this->pdo = $pdo;
    }
    public function findNotesByUserId($userId){
        $stmt = $this->pdo->prepare("SELECT * FROM notes WHERE user_id = :user_id ORDER BY created_at DESC");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function findNoteById($noteId){
        $stmt = $this->pdo->prepare('SELECT * FROM notes WHERE id = :id LIMIT 1');
        $stmt->execute([
            'id'=> $noteId
        ]);

        return $stmt->fetch();
    }
    public function createNote($userId, $title,$content,$private = 0){
        $stmt = $this->pdo->prepare('INSERT INTO notes (user_id, title, content, private, created_at) VALUES (:user_id, :title, :content, :private, NOW())');
        $stmt->execute([
            'user_id'=> $userId,
            'title'=> $title,
            'content'=> $content,
            'private'=> $private
        ]);
    }
    public function updateNote($noteId, $title, $content, $private = 0){
        $stmt = $this->pdo->prepare('UPDATE notes SET title = :title, content= :content, private = :private WHERE id = :id');
        $stmt->execute([
            'id' => $noteId,
            'title'=> $title,
            'content'=> $content,
            'private'=> $private
        ]);
    }
    public function deleteNote($noteId){
        $stmt = $this->pdo->prepare('DELETE FROM notes WHERE id = :id');
        $stmt->execute([
            'id'=> $noteId
        ]);
    }

    public function fetchPublicNotes() {
        try {
            $stmt = $this->pdo->prepare('
                SELECT notes.title, notes.content, notes.created_at, users.email
                FROM notes
                JOIN users ON notes.user_id = users.id
                WHERE notes.private = 0
            ');
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching public notes: " . $e->getMessage();
            return [];
        }
    }
    
}