<?php

declare(strict_types=1);

return [
    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
    'controllers' => [
        'factories' => [
            Category\API\Category::class => Category\API\CategoryFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            Category\Repository\CategoryInterface::class => Category\Repository\CategoryFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'restful_category' => [
                'type' => 'segment',
                'options' => [
                    'route'    => '/category[/:id]',
                    'constraints' => [
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Category\API\Category::class,
                    ]
                ],
            ],
        ],
    ],
    'db' => [
        'inmemo' => [
            'filename' => getcwd() . '/data/storage/categories.json',
        ],
    ],
];
