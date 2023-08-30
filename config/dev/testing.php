<?php

use App\Enums\RealmDatabaseTypes;

return [
    'databases' => [
        'realm' => [
            'active' => env('TESTING_DB_REALM_ACTIVE', false),
            'host' => env('TESTING_DB_REALM_HOST', '127.0.0.1'),
            'port' => env('TESTING_DB_REALM_PORT', 3306),
            'username' => env('TESTING_DB_REALM_USERNAME', 'root'),
            'password' => env('TESTING_DB_REALM_PASSWORD', 'password'),
            'databases' => [
                RealmDatabaseTypes::AUTH->value => env('TESTING_DB_REALM_AUTH_DATABASE', 'acore_auth'),
                RealmDatabaseTypes::CHARACTERS->value => env('TESTING_DB_REALM_CHARACTERS_DATABASE', 'acore_characters'),
                RealmDatabaseTypes::WORLD->value => env('TESTING_DB_REALM_WORLD_DATABASE', 'acore_world'),
            ],
        ],
    ],
];
