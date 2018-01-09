<?php

/*
|--------------------------------------------------------------------------
| PiDomoticHome\Base Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are
| handled by the PiDomoticHome\Base package.
|
*/

Route::group(
    [
        'namespace'  => 'Backpack\Base\app\Http\Controllers',
        'middleware' => 'web',
        'prefix'     => config('backpack.base.route_prefix'),
    ],
    function () {
        // Authentication Routes...
        Route::get('login', 'Auth\LoginController@showLoginForm')->name('backpack.auth.login');
        Route::post('login', 'Auth\LoginController@login');
        Route::get('logout', 'Auth\LoginController@logout')->name('backpack.auth.logout');
        Route::post('logout', 'Auth\LoginController@logout');

        // Registration Routes...
        Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('backpack.auth.register');
        Route::post('register', 'Auth\RegisterController@register');

        // Password Reset Routes...
        Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('backpack.auth.password.reset');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset');
        Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('backpack.auth.password.reset.token');
        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('backpack.auth.password.email');

        Route::get('edit-account-info', 'Auth\MyAccountController@getAccountInfoForm')->name('backpack.account.info');
        Route::post('edit-account-info', 'Auth\MyAccountController@postAccountInfoForm');
        Route::get('change-password', 'Auth\MyAccountController@getChangePasswordForm')->name('backpack.account.password');
        Route::post('change-password', 'Auth\MyAccountController@postChangePasswordForm');

    });

Route::group(
    [
        'namespace' => 'Lejubila\PiDomoticHome\app\Http\Controllers',
        'middleware' => [ 'web' ],
    ],
    function () {
        Route::get( '/', 'PublicController@getHome')
            ->name('pidomotichome.home');
    });


Route::group(
    [
        'namespace'  => 'Lejubila\PiDomoticHome\app\Http\Controllers',
        'middleware' => [ 'web', 'admin' ],
        'prefix'     => config('backpack.base.route_prefix'),
    ],
    function () {
        Route::get('dashboard', 'AdminController@getDashboard')->name('backpack.dashboard');
        Route::get('/', 'AdminController@redirect')->name('backpack');

        Route::get('prova', function(){

            //\Lejubila\PiDomoticHome\ModuleContainer $container
            //return $container;
            $container = \App::make(\Lejubila\PiDomoticHome\ModuleContainer::class);
            return print_r($container->getModuleMenu(), true);
        });

    });
