<?php
/**
 * User: david bigagli
 * Date: 09/12/17
 * Time: 0.04
 */

namespace Lejubila\PiDomoticHome\app\Http\Controllers;

use \Backpack\PermissionManager\app\Http\Controllers\RoleCrudController as BackpackCrudController;
use Illuminate\Support\Facades\Auth;


class RoleCrudController extends BackpackCrudController
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

        if( ! (config('pidomotichome.permission.allow_manage_rules') || Auth::user()->hasRole('admin')) ) {
            $this->crud->denyAccess([
                'list',
                'create',
                'update',
                'delete',
            ]);
        }

    }

}