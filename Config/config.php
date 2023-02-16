<?php

return [
    'name' => 'Core',
    'navigation'=>[
        'name' => 'Administration',
        'enabled' => true,
    ],
    'installed-modules' => [
        'file' => [
            'class' => \Modules\Core\Activators\FileInstaller::class,
            'name' => base_path('installed_modules.json'),
            'cache-key' => 'modules.installed',
            'cache-lifetime' => 604800,
        ],
    ],

    'installed-module' => 'file',

    'cache' => [
        'enabled' => false,
        'driver' => 'file',
        'key' => 'core-modules',
        'lifetime' => 60,
    ],
];
