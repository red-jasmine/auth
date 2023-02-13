<?php

// config for RedJasmine/Auth
return [


    'guards' => [
        'user' => [
            'driver'   => 'jwt',
            'provider' => 'users',
        ],
        'seller' => [
            'driver'   => 'jwt',
            'provider' => 'seller',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model'  => "RedJasmine\\User\\Models\\User",
        ],
         'seller' => [
             'driver' => 'eloquent',
             'model'  => "RedJasmine\\User\\Models\\User",
         ],
    ],

];
