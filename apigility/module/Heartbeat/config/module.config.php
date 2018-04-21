<?php
return [
    'controllers' => [
        'factories' => [
            'Heartbeat\\V1\\Rpc\\Ping\\Controller' => \Heartbeat\V1\Rpc\Ping\PingControllerFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'heartbeat.rpc.ping' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/ping',
                    'defaults' => [
                        'controller' => 'Heartbeat\\V1\\Rpc\\Ping\\Controller',
                        'action' => 'ping',
                    ],
                ],
            ],
            'heartbeat.rest.status' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/status[/:status_id]',
                    'defaults' => [
                        'controller' => 'Heartbeat\\V1\\Rest\\Status\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'heartbeat.rpc.ping',
            1 => 'heartbeat.rest.status',
        ],
    ],
    'zf-rpc' => [
        'Heartbeat\\V1\\Rpc\\Ping\\Controller' => [
            'service_name' => 'Ping',
            'http_methods' => [
                0 => 'GET',
            ],
            'route_name' => 'heartbeat.rpc.ping',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'Heartbeat\\V1\\Rpc\\Ping\\Controller' => 'Json',
            'Heartbeat\\V1\\Rest\\Status\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'Heartbeat\\V1\\Rpc\\Ping\\Controller' => [
                0 => 'application/vnd.heartbeat.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'Heartbeat\\V1\\Rest\\Status\\Controller' => [
                0 => 'application/vnd.heartbeat.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'Heartbeat\\V1\\Rpc\\Ping\\Controller' => [
                0 => 'application/vnd.heartbeat.v1+json',
                1 => 'application/json',
            ],
            'Heartbeat\\V1\\Rest\\Status\\Controller' => [
                0 => 'application/vnd.heartbeat.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-content-validation' => [
        'Heartbeat\\V1\\Rpc\\Ping\\Controller' => [
            'input_filter' => 'Heartbeat\\V1\\Rpc\\Ping\\Validator',
        ],
        'Heartbeat\\V1\\Rest\\Status\\Controller' => [
            'input_filter' => 'Heartbeat\\V1\\Rest\\Status\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'Heartbeat\\V1\\Rpc\\Ping\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'ack',
                'description' => 'Acknowledge the request with a timestamp.',
            ],
        ],
        'Heartbeat\\V1\\Rest\\Status\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '140',
                        ],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                        'options' => [],
                    ],
                ],
                'name' => 'message',
                'description' => 'A status message of no more than 140 characters',
                'error_message' => 'A status message must contain between 1 and 140 characters',
            ],
            1 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\Regex::class,
                        'options' => [
                            'pattern' => '/^(admin|andrew)$/',
                        ],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                        'options' => [],
                    ],
                ],
                'name' => 'user',
                'description' => 'The user submitting the status message',
                'error_message' => 'You must provide a valid user.',
            ],
            2 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\Digits::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'timestamp',
                'description' => 'The timestamp when the status message was last modified',
                'error_message' => 'You must provide a timestamp',
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            \Heartbeat\V1\Rest\Status\StatusResource::class => \Heartbeat\V1\Rest\Status\StatusResourceFactory::class,
        ],
    ],
    'zf-rest' => [
        'Heartbeat\\V1\\Rest\\Status\\Controller' => [
            'listener' => \Heartbeat\V1\Rest\Status\StatusResource::class,
            'route_name' => 'heartbeat.rest.status',
            'route_identifier_name' => 'status_id',
            'collection_name' => 'status',
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
            'entity_class' => \Heartbeat\V1\Rest\Status\StatusEntity::class,
            'collection_class' => \Heartbeat\V1\Rest\Status\StatusCollection::class,
            'service_name' => 'Status',
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            \Heartbeat\V1\Rest\Status\StatusEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'heartbeat.rest.status',
                'route_identifier_name' => 'status_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \Heartbeat\V1\Rest\Status\StatusCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'heartbeat.rest.status',
                'route_identifier_name' => 'status_id',
                'is_collection' => true,
            ],
        ],
    ],
    'zf-mvc-auth' => [
        'authorization' => [
            'Heartbeat\\V1\\Rest\\Status\\Controller' => [
                'collection' => [
                    'GET' => false,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => true,
                    'PATCH' => true,
                    'DELETE' => true,
                ],
            ],
        ],
    ],
];
