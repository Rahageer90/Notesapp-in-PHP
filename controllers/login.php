<?php

require_once __DIR__ . '/../database.php'; 
require_once __DIR__ . '/../models/User.php'; 

class LoginController
{
    private $pdo;

    public function __construct()
    {
        
        $config = require __DIR__ . '/../config.php';
        $dbConfig = $config['database'];

        
        $database = new Database($dbConfig);
        $this->pdo = $database->connection; 
    }

    
    public function startSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    
    public function handleLogin()
    {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new User($this->pdo); 
            $user = $userModel->findUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: /dashboard');
                exit;
            } else {
                $error = 'Invalid credentials'; 
            }
        }

        return $error; 
    }

   
    public function loadLoginView($error = null)
    {
        require_once __DIR__ . '/../views/login.view.php'; 
    }
}


$loginController = new LoginController(); 
$loginController->startSession(); 
$error = $loginController->handleLogin(); 
$loginController->loadLoginView($error); 
