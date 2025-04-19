<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../database.php';
require_once __DIR__ . '/../models/User.php';

session_start();

$client = new Google_Client();
$client->setClientId('YOUR_GOOGLE_CLIENT_ID');
$client->setClientSecret('YOUR_GOOGLE_CLIENT_SECRET');
$client->setRedirectUri('https://your-app.onrender.com/google-callback');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if (!isset($token['error'])) {
        $client->setAccessToken($token['access_token']);
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();

        $email = $google_account_info->email;

        // Initialize DB
        $config = require __DIR__ . '/../config.php';
        $db = new Database($config['database']);
        $pdo = $db->connection;

        $userModel = new User($pdo);
        $user = $userModel->findUserByEmail($email);

        if (!$user) {
            // Auto-register if user doesn't exist
            $userId = $userModel->createUser($email, null); // Password null for Google users
        } else {
            $userId = $user['id'];
        }

        $_SESSION['user_id'] = $userId;
        header('Location: /dashboard');
        exit;
    }
}

header('Location: /login?error=Google login failed');
exit;
