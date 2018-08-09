<?php
use Doctrine\ORM\Mapping\Driver;

return [
    'doctrine' => [
        'cache' => [
            'redis' => [
                'instance' => \Redis::class
            ]
        ],
        'driver' => [
            'annotation_driver' => [
                'class' => Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    'module/Nanos/Foundation/src/Entity',
                ]
            ],
            'orm_default' => [
                'drivers' => [
                    'Nanos\Foundation\Entity' => 'annotation_driver',
                ]
            ],
        ],
        'configuration' => [
            'orm_default' => [
                'metadata_cache'    => 'array',
                'query_cache'       => 'array',
                'result_cache'      => 'array',
                'hydration_cache'   => 'array',
                'generate_proxies'  => true,
                'driver'            => 'orm_default',
            ]
        ],
        'connection' => [
            'orm_default' => [
                'driverClass' => Doctrine\DBAL\Driver\PDOPgSql\Driver::class,
                'params' => [
                    'host'     => 'pgsql',
                    'port'     => 5432,
                    'user'     => 'postgres',
                    'password' => 'TuFzaFVNNVTK8xHIkHgNeblIxNQAygUDwq7w7hRtGwanXlOwsT2',
                    'dbname'   => 'nanos',
                    'charset'  => 'utf8'
                ],
            ]
        ],
        'migrations_configuration' => [
            'orm_default' => [
                'directory' => 'data/DoctrineORMModule/Migrations',
                'namespace' => 'DoctrineORMModule\Nanos',
                'table'     => 'nanos_migrations',
            ],
        ],
    ],
];
