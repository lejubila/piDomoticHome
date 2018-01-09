<?php

Route::group(
    [
        'namespace'  => 'Lejubila\PiDomoticHome\ExampleModule\app\Http\Controllers',
        'middleware' => [ 'web', 'admin' ],
        'prefix'     => config('backpack.base.route_prefix'),
    ],
    function () {
        Route::get('dashboard/'.$this->idModule, 'ModuleController@getDashboard')
            ->name($this->idModule.'.dashboard');

        Route::get('dashboard/'.$this->idModule.'/event', 'ModuleController@getDashboardEvent')
            ->name($this->idModule.'.dashboard.event');

        Route::post('dashboard/'.$this->idModule.'/private-event/{id_user}', 'ModuleController@postDashboardPrivateEvent')
            ->name($this->idModule.'.dashboard.private-event');

    });
