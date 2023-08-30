<?php

return [
    'databases' => [
        'auth' => [
            'active' => env('TEST_DB_AUTH_ACTIVE', false),
            'host' => env('TEST_DB_AUTH_HOST'),
            'port' => env('TEST_DB_AUTH_PORT'),
            'database' => env('TEST_DB_AUTH_DATABASE'),
            'username' => env('TEST_DB_AUTH_USERNAME'),
            'password' => env('TEST_DB_AUTH_PASSWORD'),
        ],
        'characters' => [
            'active' => env('TEST_DB_CHARACTERS_ACTIVE', false),
            'host' => env('TEST_DB_CHARACTERS_HOST'),
            'port' => env('TEST_DB_CHARACTERS_PORT'),
            'database' => env('TEST_DB_CHARACTERS_DATABASE'),
            'username' => env('TEST_DB_CHARACTERS_USERNAME'),
            'password' => env('TEST_DB_CHARACTERS_PASSWORD'),
        ],
        'world' => [
            'active' => env('TEST_DB_WORLD_ACTIVE', false),
            'host' => env('TEST_DB_WORLD_HOST'),
            'port' => env('TEST_DB_WORLD_PORT'),
            'database' => env('TEST_DB_WORLD_DATABASE'),
            'username' => env('TEST_DB_WORLD_USERNAME'),
            'password' => env('TEST_DB_WORLD_PASSWORD'),
        ],
    ],
];
