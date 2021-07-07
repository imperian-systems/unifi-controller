<?php

return [
    'middleware' => [
        'api', 
        'auth:api'
    ],
    'proxy' => [
        'enabled'=>false,
        'host'=>'unifi-controller',
        8080
    ]
];
