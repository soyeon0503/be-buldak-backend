<?php

return [
    'paths' => [
        'docs' => storage_path('api-docs'),
    ],
    'generate_always' => true,
    'swagger_version' => '3.0',
    'basePath' => env('APP_URL', 'http://localhost:8000'),
];
