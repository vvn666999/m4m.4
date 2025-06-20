<?php
require_once __DIR__ . '/cfg/env.php';
require_once __DIR__ . '/lib/Router.php';
require_once __DIR__ . '/lib/Database.php';
require_once __DIR__ . '/mdl/UserModel.php';
require_once __DIR__ . '/controllers/UserController.php';

$config = require __DIR__ . '/cfg/config.php';
$db = new Database($config);
$userModel = new UserModel($db);
$controller = new UserController($userModel);

$router = new Router();

$router->add('GET', '/', function() {
    require __DIR__ . '/pages/home.php';
});
$router->add('GET', '/login', [$controller, 'showLogin']);
$router->add('POST', '/login', [$controller, 'login']);
$router->add('GET', '/register', [$controller, 'showRegister']);
$router->add('POST', '/register', [$controller, 'register']);

$path = $_GET['route'] ?? '/';
$router->dispatch($_SERVER['REQUEST_METHOD'], $path);
