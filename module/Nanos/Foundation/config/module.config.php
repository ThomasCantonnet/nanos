<?php

namespace Nanos\Foundation;

use Nanos\Foundation\Factory\Controller\Plugin\SerializerPluginFactory;
use Nanos\Foundation\Service;

return [
    'service_manager' => [
        'factories' => [
            Service\SerializerService::class => Service\Factory\SerializerFactory::class
        ]
    ],
    'controller_plugins' => [
        'factories' => [
            'serializer' => SerializerPluginFactory::class,
        ],
    ],
    'view_manager' => [
        'display_exceptions'       => true,
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'error/404'     => __DIR__ . '/../view/error/404.phtml',
            'error/index'   => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'controller_map' => [
            __NAMESPACE__ => 'error'
        ]
    ],
];
