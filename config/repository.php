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
            /*处理业务逻辑*/
            'services'   => 'Services',
            /*处理页面数据*/
            'presenters'   => 'Presenters',
            'provider'     => 'RepositoryServiceProvider',
            'stubsOverridePath' => app_path()
        ]
    ]
];
