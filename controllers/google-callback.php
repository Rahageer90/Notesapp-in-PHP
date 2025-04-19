<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../database.php';
require_once __DIR__ . '/../models/User.php';

use Google\Client as GoogleClient;
use Google\Service\Oauth2;

session_start();

// Initialize Google Client
$client = new GoogleClient();
$client->setClientId('722234426503-ckp8udm4am8dlj9svb876b4gtld7l1f7.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('https://notesapp-in-php.onrender.com//google-callback');
$client->addScope('email');
$client->addScope('profile');

// Handle the callback
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if (!isset($token['error'])) {
        $client->setAccessToken($token['access_token']);

        $googleOAuthService = new Oauth2($client);
        $googleUser = $googleOAuthService->userinfo->get();

        $email = $googleUser->getEmail();

        // Initialize DB
        $config = require __DIR__ . '/../config.php';
        $db = new Database($config['database']);
        $pdo = $db->connection;

        $userModel = new User($pdo);
        $user = $userModel->findUserByEmail($email);

        if (!$user) {
            // Auto-register the user
            $userId = $userModel->createUser($email, null); // Google users don't have password
        } else {
            $userId = $user['id'];
        }

        $_SESSION['user_id'] = $userId;
        header('Location: /dashboard');
        exit;
    }
}

// If something goes wrong
header('Location: /login?error=Google login failed');
exit;
