<?php
Route::group(
    [
        'namespace'  => 'Lejubila\PiDomoticHome\ExampleModule\app\Http\Controllers',
        'middleware' => [ 'web' ],
    ],
    function () {
        Route::get( $this->idModule, 'ModuleController@getHome')
            ->name($this->idModule.'.home');

    });
