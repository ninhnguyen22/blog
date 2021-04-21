<?php

/**
 * User site configure
 */
return [
    'name' => 'N-Blog',

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin route settings
    |--------------------------------------------------------------------------
    |
    | The routing configuration of the admin page, including the path prefix,
    | the controller namespace, and the default middleware. If you want to
    | access through the root path, just set the prefix to empty string.
    |
    */
    'route' => [

        'prefix' => env('ADMIN_ROUTE_PREFIX', ''),

        'namespace' => 'App\\User\\Controllers',

        'middleware' => ['web'],
    ],

    'generate' => [
        'output' => [
            'base' => 'cv',
            'articles' => 'articles',
            'category' => 'category'
        ],
    ],
];
