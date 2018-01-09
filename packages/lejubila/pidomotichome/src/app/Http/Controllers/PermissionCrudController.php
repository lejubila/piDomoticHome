<?php
/**
 * User: david bigagli
 * Date: 09/12/17
 * Time: 0.32
 */

namespace Lejubila\PiDomoticHome\app\Http\Controllers;

use Backpack\PermissionManager\app\Http\Controllers\PermissionCrudController as BackpackPermissionCrudController;
use Illuminate\Support\Facades\Auth;

class PermissionCrudController extends BackpackPermissionCrudController
{

    public function setup()
    {
        parent::setup();

        $this->crud->allowAccess([
            'list',
            'create',
            'update',
            'delete',
        ]);

        if( !(config('pidomotichome.permission.allow_permission_manage') || Auth::user()->hasRole('admin')) ) {
            $this->crud->denyAccess([
                'list',
                'create',
                'update',
                'delete',
            ]);
        }
    }

}