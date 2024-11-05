<?php
require_once __DIR__.'/../database.php';
require_once __DIR__.'/../models/user.php';
class RegisterController{
    private $pdo;
    public function __construct(){
        $config = require __DIR__.'/../config.php';
        $dbConfig = $config['database'];
        $database = new Database($dbConfig);
        $this->pdo = $database->connection;
    }

    public function startsession(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
    }
    public function handleRegister()
    {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            if ($this->isValid($email, $password, $confirmPassword)) {
                $userModel = new User($this->pdo);
                if ($userModel->findUserByEmail($email)) {
                    $error = 'Email is already registered'; 
                } else {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $userModel->createUser($email, $hashedPassword);

                    // Confirming registration success
                    echo "User registered successfully!"; // Debug message
                    header('Location: /login');
                    exit;
                }
            } else {
                $error = 'Invalid input';
            }
        }

        return $error;
    }

    public function isValid($email,$password,$confirmpassword){
        if (empty($email)|| empty($password) || empty($confirmpassword)) {
            return false;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return false;
        }
        if ($password !== $confirmpassword){
            return false;
        }
        return true;
    
    }
    public function loadRegisterView($error=null){
        require_once __DIR__.'/../views/register.view.php';
    }
        
    
}

$registerController = new RegisterController();
$registerController -> startsession();
$error = $registerController->handleRegister();
$registerController->loadRegisterView($error);