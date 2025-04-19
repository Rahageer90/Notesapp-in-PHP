<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../database.php';
require_once __DIR__ . '/../models/User.php';

session_start();

$client = new Google_Client();
$client->setClientId('722234426503-ckp8udm4am8dlj9svb876b4gtld7l1f7.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('https://your-app.onrender.com/google-callback');
$client->addScope('email');
$client->addScope('profile');

$authUrl = $client->createAuthUrl();
header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
exit;
