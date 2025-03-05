<?php

class User
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo; 
    }

    
    public function findUserByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(); 
    }
    public function createUser($email,$password){
        $stmt = $this->pdo->prepare('insert into users (email,password) values(:email, :password)');
        $stmt->execute([
            'email'=> $email,
            'password'=> $password
        ]);
    }

    
}
