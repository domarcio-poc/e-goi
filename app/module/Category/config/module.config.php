<?php

declare(strict_types=1);

return [
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'controllers' => [
        'factories' => [
            Category\Controller\Categories::class => Category\Controller\CategoriesFactory::class,
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
                    ]
                ]
            ]
        ]
    ],
    'db' => [
        'inmemo' => [
            'filename' => getcwd() . '/app/data/storage/foobar.json',
        ],
    ],
];
