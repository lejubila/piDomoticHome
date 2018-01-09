<?php

Route::group([
        'namespace'  => 'Lejubila\PiDomoticHome\app\Http\Controllers',
        'prefix'     => config('backpack.base.route_prefix', 'admin'),
        'middleware' => ['web', 'admin'],
    ], function () {
        CRUD::resource('user', 'UserCrudController');
        CRUD::resource('role', 'RoleCrudController');
        CRUD::resource('permission', 'PermissionCrudController');
    });
