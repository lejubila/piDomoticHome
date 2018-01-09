<?php
return [

    //
    // Enable permission for all user to manage rules, permission and users
    //
    'permission' => [
        'allow_manage_users' => env('PERMISSION_MANAGE_OPEN', false),
        'allow_manage_rules' => env('PERMISSION_MANAGE_OPEN', false),
        'allow_manage_permissions' => env('PERMISSION_MANAGE_OPEN', false),
    ],

    //
    // List of modules enabled in piDomoticHome
    //
    'modulesEnabled' => [
        Lejubila\PiDomoticHome\ExampleModule\Module::class,
    ],

];