<?php
/*
|--------------------------------------------------------------------------
| HskyZhou Repository Config
|--------------------------------------------------------------------------
|
|
*/
return [
    /*
    |--------------------------------------------------------------------------
    | Log Config
    |--------------------------------------------------------------------------
    */
    'log' => [
        'path' => storage_path(),
        'action' => [
            'create' => true,
            'update' => true,
            'delete' => true,
            'select' => false,
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Generator Config
    |--------------------------------------------------------------------------
    |
    */
    'generator'  => [
        'basePath'      => app_path(),
        'rootNamespace' => 'App\\',
        'paths'         => [
            'processes' => 'Repositories\\Processes',
            'models'       => 'Repositories\\Models',
            'repositories' => 'Repositories\\Eloquents',
            'interfaces'   => 'Repositories\\Contracts',
            'provider'     => 'RepositoryServiceProvider',
            'stubsOverridePath' => app_path()
        ]
    ]
];
