<?php

use Morsum\Application;

$loader = require __DIR__ . '/../vendor/autoload.php';

$config = require_once __DIR__ . '/config.php';
$app = new Application($config);

// Routes
$app->addRoute('GET', '/', 'App\\Controller\\DefaultController', 'defaultAction', 'home');
$app->addRoute('GET', '/user/{id}/json', 'App\\Controller\\DefaultController', 'jsonProfile', 'ajax_profile');
$app->addRoute('GET', '/music/lastfm-top-10', 'App\\Controller\\MusicController', 'lastfmTopTen', 'music_lastfm');

// Services
$app['lastfm_service'] = function() use ($app) {
    return new \App\Service\LastfmService($app['config']['lastfm']);
};

return $app;
