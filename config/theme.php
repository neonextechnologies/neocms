<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Active Themes
    |--------------------------------------------------------------------------
    |
    | Specify which theme should be active for frontend and admin areas.
    |
    */

    'active_frontend' => env('THEME_FRONTEND', 'default'),
    'active_admin' => env('THEME_ADMIN', 'neo-admin'),

    /*
    |--------------------------------------------------------------------------
    | Theme Paths
    |--------------------------------------------------------------------------
    |
    | Define where themes are located in your application.
    |
    */

    'paths' => [
        'frontend' => base_path('themes/frontend'),
        'admin' => base_path('themes/admin'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Theme Assets
    |--------------------------------------------------------------------------
    |
    | Configure how theme assets should be handled.
    |
    */

    'assets' => [
        'enabled' => true,
        'public_path' => public_path('themes'),
        'cache' => env('THEME_CACHE', true),
        'minify' => env('THEME_MINIFY', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Theme Cache
    |--------------------------------------------------------------------------
    |
    | Enable caching of theme metadata for better performance.
    |
    */

    'cache' => [
        'enabled' => env('THEME_CACHE_ENABLED', true),
        'key' => 'theme.metadata',
        'ttl' => 3600, // 1 hour
    ],

    /*
    |--------------------------------------------------------------------------
    | Theme Validation
    |--------------------------------------------------------------------------
    |
    | Validation rules for theme structure and files.
    |
    */

    'validation' => [
        'required_files' => [
            'theme.json',
            'layouts/app.blade.php',
        ],
        'required_metadata' => [
            'name',
            'slug',
            'version',
            'author',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Theme Settings
    |--------------------------------------------------------------------------
    |
    | Default settings applied to all themes.
    |
    */

    'defaults' => [
        'type' => 'frontend',
        'license' => 'MIT',
        'supports' => [
            'widgets' => true,
            'menus' => true,
            'custom_css' => true,
            'dark_mode' => false,
        ],
    ],
];
