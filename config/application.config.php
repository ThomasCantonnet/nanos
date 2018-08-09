<?php
return [
    'modules' => [
        'DoctrineModule',
        'DoctrineORMModule',
        'Zend\Mvc\Console',
        'Zend\Router',
        'Nanos\Foundation',
        'Nanos\Campaign',
    ],
    'module_listener_options' => [
        'module_paths' => [
            './module',
            './vendor',
        ],
        'config_glob_paths' => [
            'config/autoload/{{,*.}global,{,*.}local}.php',
        ],
    ],
];
