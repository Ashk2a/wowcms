<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Broadcasting
    |--------------------------------------------------------------------------
    |
    | By uncommenting the Laravel Echo configuration, you may connect Filament
    | to any Pusher-compatible websockets server.
    |
    | This will allow your users to receive real-time notifications.
    |
    */

    'broadcasting' => [
        'echo' => [
            'broadcaster' => 'pusher',
            'key' => env('VITE_PUSHER_APP_KEY', 'app-key'),
            'wsHost' => env('VITE_PUSHER_HOST', '127.0.0.1'),
            'wsPort' => env('VITE_PUSHER_PORT', 80),
            'wssPort' => env('VITE_PUSHER_SECURE_PORT', 443),
            'forceTLS' => 'https' === env('PUSHER_SCHEME'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | This is the storage disk Filament will use to put media. You may use any
    | of the disks defined in the `config/filesystems.php`.
    |
    */

    'default_filesystem_disk' => env('FILAMENT_FILESYSTEM_DISK', 'public'),
];
