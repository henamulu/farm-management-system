<?php

return [
    'paths' => [
        'docs' => 'api/documentation',
        'docs_json' => 'api-docs.json',
        'annotations' => [
            base_path('app'),
            base_path('routes'),
        ],
    ],

    'security' => [
        'bearer_token' => [
            'type' => 'apiKey',
            'description' => 'Enter token in format (Bearer <token>)',
            'name' => 'Authorization',
            'in' => 'header',
        ],
    ],

    'api' => [
        'title' => 'API de Gestión Agrícola',
        'version' => '1.0.0',
    ],
]; 