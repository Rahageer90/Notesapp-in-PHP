<?php

require 'Core/Router.php';
require 'Core/functions.php';

use Core\Router;

$router = new Router();

$router->get('/', 'controllers/index.php');
$router->get('/register', 'controllers/register.php');
$router->post('/register', 'controllers/register.php');
$router->get('/login', 'controllers/google-login.php');
$router->get('/google-callback', 'controllers/google-callback.php');

$router->get('/dashboard', 'controllers/dashboard.php');
$router->get('/create-note', 'controllers/create-note.php');
$router->post('/create-note', 'controllers/create-note.php');
$router->get('/logout', 'controllers/logout.php');
$router->get('/edit-note', 'controllers/edit-note.php');
$router->post('/edit-note', 'controllers/edit-note.php');
$router->post('/delete-note','controllers/delete-note.php');
$router->get('/public-notes', 'controllers/public-notes.php');
$router->get('/todo-list', 'controllers/todo-list.php');
$router->post('/todo-list', 'controllers/todo-list.php');
$router->post('/delete-notes', 'controllers/delete-notes.php');


$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$controller = $router->route($uri, $method);

if ($controller && file_exists($controller)) {
    require $controller;
} else {
    abort();
}
