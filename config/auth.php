<?php

return [


    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'customer' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'sales' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'projectmanager' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'developer' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
    ],


    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
