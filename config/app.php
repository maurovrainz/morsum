<?php

use Morsum\Application;

$loader = require __DIR__ . '/../vendor/autoload.php';

$config = require_once __DIR__ . '/config.php';
$app = new Application($config);

// Default route
$app->addRoute('GET', '/', 'App\\Controller\\DefaultController', 'defaultAction', 'home');
$app->addRoute('GET', '/user/{id}/json', 'App\\Controller\\DefaultController', 'jsonProfile', 'ajax_profile');

return $app;
