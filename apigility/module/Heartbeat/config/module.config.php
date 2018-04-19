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
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'heartbeat.rpc.ping',
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
        ],
        'accept_whitelist' => [
            'Heartbeat\\V1\\Rpc\\Ping\\Controller' => [
                0 => 'application/vnd.heartbeat.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
        ],
        'content_type_whitelist' => [
            'Heartbeat\\V1\\Rpc\\Ping\\Controller' => [
                0 => 'application/vnd.heartbeat.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-content-validation' => [
        'Heartbeat\\V1\\Rpc\\Ping\\Controller' => [
            'input_filter' => 'Heartbeat\\V1\\Rpc\\Ping\\Validator',
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
    ],
];
