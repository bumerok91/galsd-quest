<?php

return [
    'default' => env('DB_CONNECTION', 'mysql'),
    'migrations' => 'migrations',
    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', 'mysql'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'quest'),
            'username' => env('DB_USERNAME', 'user'),
            'password' => env('DB_PASSWORD', 'secret'),
        ],
    ],
];