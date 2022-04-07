
<?php

return [
    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        // 'api' => [
        //     'driver' => 'jwt',
        //     'provider' => 'employee',
        // ],


        //Last time use this
        // 'api' => [
        //     'driver' => 'jwt',
        //     'provider' => 'users',
        // ],

        'web' => [
            'driver' => 'jwt',
            'provider' => 'users',
        ],
        // 'api' => [
        //     'provider' => 'jwt',
        //     'driver' => 'session',
        // ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => \App\User::class
        ]

        // 'employee' => [
        //     'driver' => 'eloquent',
        //     'model' => \App\Models\MasterEmployee::class,
        //     'table' => 'm_employees'
        // ]

        // 'jwt' => [
        //     'driver' => 'eloquent',
        //     'model' => App\User::class,
        // ],
    ]
];
