<?php
namespace Nanos\Campaign;

use Zend\Router\Http;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Http\Segment::class,
                'options' => [
                    'route' => '[/]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index'
                    ]
                ]
            ],
            'api' => [
                'type' => Http\Segment::class,
                'options' => [
                    'route' => '/api/campaign',
                    'defaults' => [
                        'controller' => Api\ApiCampaignController::class
                    ]
                ],
                'child_routes' => [
                    'list' => [
                        'type' => Http\Literal::class,
                        'options' => [
                            'route' => '/list',
                            'defaults' => [
                                'action' => 'list',
                            ],
                        ],
                    ],
                    'view' => [
                        'type' => Http\Segment::class,
                        'options' => [
                            'route' => '/view/[:id]',
                            'defaults' => [
                                'action'     => 'view',
                            ],
                        ],
                    ],
                ]
            ],
        ]
    ],
    'console' => [
        'router' => [
            'routes' => [
                'nanos:campaign:import' => [
                    'options' => [
                        'route' => 'nanos:campaign:import',
                        'defaults' => [
                            'controller' => Cli\CliImportController::class,
                            'action' => 'import'
                        ]
                    ]
                ]
            ]
        ]
    ],
    'controllers' => [
        'factories' => [
            Api\ApiCampaignController::class => Api\Factory\ApiCampaignControllerFactory::class,
            Cli\CliImportController::class => Cli\Factory\CliImportControllerFactory::class,
            Controller\IndexController::class => Controller\Factory\IndexControllerFactory::class,
        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'controller_map' => [
            __NAMESPACE__ => 'campaign'
        ],
        'strategies' => [
            'ViewJsonStrategy'
        ]
    ],
];
