<?php

// config for RedJasmine/Auth
return [


    'guards' => [
        'user' => [
            'driver'   => 'jwt',
            'provider' => 'users',
        ],
        'shop' => [
            'driver'   => 'jwt',
            'provider' => 'shop',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model'  => "RedJasmine\\User\\Models\\User",
        ],
        'shop'  => [
            'driver' => 'eloquent',
            'model'  => "RedJasmine\\User\\Models\\User",
        ],
    ],

];
