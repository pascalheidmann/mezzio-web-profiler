<?php

declare(strict_types=1);


return [
    'doctrine' => [
        'driver' => [
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            'orm_default_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AttributeDriver::class,
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../../src/App/Entity',
                ],
            ],

            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => [
                'drivers' => [
                    // register `my_annotation_driver` for any entity under namespace `My\Namespace`
                    'App\Entity' => 'orm_default_driver',
                ],
            ],
        ],

        'connection' => [
            // Configuration for service `doctrine.connection.orm_default` service
            'orm_default' => [
                'driverClass'   => \Doctrine\DBAL\Driver\PDO\SQLite\Driver::class,
                'params' => array(
                    'path'=> __DIR__.'/../../data/test.sqlite.db',
                )
            ],
        ],
    ],
];
