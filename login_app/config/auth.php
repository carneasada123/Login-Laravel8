<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'personas',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'personas',
            'hash' => false,
        ],
    ],

    'providers' => [
        'personas' => [
            'driver' => 'eloquent',
            'model' => App\Models\Persona::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'personas',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
