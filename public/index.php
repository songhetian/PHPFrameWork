<?php
require_once __DIR__.'/../vendor/autoload.php';

use app\core\Application;
use app\controllers\siteController;

$path = dirname(__DIR__);

$app = new Application($path);

$app->router->get('/', [siteController::class, 'home']);
$app->router->get('/contact', [siteController::class, 'contact']);
$app->router->post('/contact', [siteController::class, 'handelContact']);

$app->run();