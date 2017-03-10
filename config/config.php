<?php

$config = [
    'framework' => [
        'templates_dir' => __DIR__ . '/../src/View'
    ],
    'mysql' => [
        'connection' => [
            'host' => '127.0.0.1',
            'user' => 'root',
            'passwd' => '',
            'dbname' => 'morsum',
            'port' => '3306'
        ],
        'models_dir' => __DIR__ . '/../src/Models'
    ],
    'lastfm' => [
        'api_id' => 'ee0d10514b680b1a09213dfe4eaaf708'
    ]
];

return $config;
