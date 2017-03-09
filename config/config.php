<?php

$config = [
    'framework' => [
        'templates_dir' => __DIR__ . '/../src/View'
    ],
    'mysql' => [
        'host' => '127.0.0.1',
        'user' => 'root',
        'passwd' => '',
        'dbname' => 'morsum',
        'port' => '3306'
    ]
];

return $config;
