<?php

use Morsum\Application;

$loader = require __DIR__ . '/../vendor/autoload.php';

$app = new Application();
$app['config'] = require_once __DIR__ . '/config.php';

$app->addRoute('GET', '/user/{id}/profile/{type}', 'App\\Controller\\UserController', 'getProfile');
$app->addRoute('GET', '/user/{id}/billing/{type}', 'App\\Controller\\UserController', 'getBilling');

return $app;
