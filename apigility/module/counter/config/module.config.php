<?php
return [
    'service_manager' => [
        'factories' => [
            \counter\V1\Rest\Add\AddResource::class => \counter\V1\Rest\Add\AddResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'counter.rest.add' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/add[/:add_id]',
                    'defaults' => [
                        'controller' => 'counter\\V1\\Rest\\Add\\Controller',
                    ],
                ],
            ],
            'counter.rpc.add' => [
                'type' => 'Segment',
                'options' => [
                    'route' => 'add',
                    'defaults' => [
                        'controller' => 'counter\\V1\\Rpc\\Add\\Controller',
                        'action' => 'add',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'counter.rest.add',
            1 => 'counter.rpc.add',
        ],
    ],
    'zf-rest' => [
        'counter\\V1\\Rest\\Add\\Controller' => [
            'listener' => \counter\V1\Rest\Add\AddResource::class,
            'route_name' => 'counter.rest.add',
            'route_identifier_name' => 'add_id',
            'collection_name' => 'add',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \counter\V1\Rest\Add\AddEntity::class,
            'collection_class' => \counter\V1\Rest\Add\AddCollection::class,
            'service_name' => 'add',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'counter\\V1\\Rest\\Add\\Controller' => 'HalJson',
            'counter\\V1\\Rpc\\Add\\Controller' => 'Json',
        ],
        'accept_whitelist' => [
            'counter\\V1\\Rest\\Add\\Controller' => [
                0 => 'application/vnd.counter.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'counter\\V1\\Rpc\\Add\\Controller' => [
                0 => 'application/vnd.counter.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
        ],
        'content_type_whitelist' => [
            'counter\\V1\\Rest\\Add\\Controller' => [
                0 => 'application/vnd.counter.v1+json',
                1 => 'application/json',
            ],
            'counter\\V1\\Rpc\\Add\\Controller' => [
                0 => 'application/vnd.counter.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            \counter\V1\Rest\Add\AddEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'counter.rest.add',
                'route_identifier_name' => 'add_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \counter\V1\Rest\Add\AddCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'counter.rest.add',
                'route_identifier_name' => 'add_id',
                'is_collection' => true,
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            'counter\\V1\\Rpc\\Add\\Controller' => \counter\V1\Rpc\Add\AddControllerFactory::class,
        ],
    ],
    'zf-rpc' => [
        'counter\\V1\\Rpc\\Add\\Controller' => [
            'service_name' => 'add',
            'http_methods' => [
                0 => 'GET',
            ],
            'route_name' => 'counter.rpc.add',
        ],
    ],
];
