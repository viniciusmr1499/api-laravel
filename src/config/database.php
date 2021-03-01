<?php

return [
    
    'migrations' => 'migrations',
    'default'=>'mongodb',

    'connections' => [
        'mongodb' => [
            'driver' => 'mongodb',
            'host' => env('DB_MONGO_HOST'),
            'port' => env('DB_MONGO_PORT'),
            'database' => env('DB_MONGO_NAME'),
            'username' => env('DB_MONGO_USER'),
            'password' => env('DB_MONGO_PASS'),
            'options' => []
        ]
    ],

    'redis' => [
        'client' => env('REDIS_CLIENT', 'phpredis'),
        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', 'cache'),
        ],
        'default' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', '6379'),
        ]
    ],
];