<?php

return [

    /*
     * Each setting collection will be saved in a different table.
     */
    'default_repository' => 'database',

    /*
     * The repositories where settings are stored.
     */
    'repositories' => [
        'database' => [
            'type' => Spatie\LaravelSettings\SettingsRepositories\DatabaseSettingsRepository::class,
            'model' => null,
            'table' => null,
            'connection' => null,
        ],
    ],

    /*
     * The settings classes that will be loaded automatically.
     */
    'settings' => [
        App\Settings\GeneralSettings::class,
    ],

    /*
     * The path where the settings migrations will be stored.
     */
    'migrations_paths' => [
        database_path('settings'),
    ],

    /*
     * Automatically discover settings classes.
     */
    'auto_discover_settings' => [
        app_path('Settings'),
    ],

    /*
     * Cache settings for faster retrieval.
     */
    'discovered_settings_cache_path' => base_path('bootstrap/cache'),
];

