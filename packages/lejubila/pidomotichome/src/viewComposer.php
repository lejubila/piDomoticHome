<?php

View::composer([

    '*::admin.*',
    'crud::create',
    'crud::edit',
    'crud::show',
    'crud::details_row',
    'crud::revisions',
    'crud::inc.revision_timeline',
    'crud::reorder',
    'crud::list',
    'backpack::auth.account.update_info',
    'backpack::auth.account.change_password',

], function(\Illuminate\View\View $view){

    $moduleContainer = App::make(\Lejubila\PiDomoticHome\ModuleContainer::class );

    $menu = [
        'dashboard' => $moduleContainer->getDashboardMenu(),
        'modules' => $moduleContainer->getModulesMenu(),
        'settings' => $moduleContainer->getSettingsMenu(),
    ];
    $view->with('menu', $menu);

});

View::composer([

    '*::public.*',

], function(\Illuminate\View\View $view){

    $moduleContainer = App::make(\Lejubila\PiDomoticHome\ModuleContainer::class );

    $menu = [
        'home' => $moduleContainer->getHomeMenu(),
    ];
    $view->with('menu', $menu);

});