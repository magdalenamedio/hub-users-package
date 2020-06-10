<?php
return [
 	'guards' => [
        'hub_users' => [
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