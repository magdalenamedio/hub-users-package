<?php
return [
 	'guards' => [
        'hub' => [
            'driver' => 'session',
            'provider' => 'hub_users',
        ]
    ],

    'providers' => [
        'hub_users' => [
            'driver' => 'eloquent',
            'model' => App\HubUser::class,
    	],
    ]	
];   