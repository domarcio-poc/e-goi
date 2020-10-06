<?php

declare(strict_types=1);

return [
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
    'controllers' => [
        'invokables' => [
            Category\Controller\Categories::class => Category\Controller\Categories::class,
        ],
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
            'categories' => [
                'type' => 'literal',
                'options' => [
                    'route'    => '/categories',
                    'defaults' => [
                        'controller' => Category\Controller\Categories::class,
                        'action'     => 'index',
                    ],
                ],
            ],
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
