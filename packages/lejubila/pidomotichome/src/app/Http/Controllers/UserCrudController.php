<?php
/**
 * User: david bigagli
 * Date: 08/12/17
 * Time: 0.12
 */

namespace Lejubila\PiDomoticHome\app\Http\Controllers;

use Backpack\PermissionManager\app\Http\Controllers\UserCrudController as BackpackUserCrudController;
use Illuminate\Support\Facades\Auth;

class UserCrudController extends BackpackUserCrudController
{

    public function setup()
    {
        parent::setup(); //

        $this->crud->allowAccess([
            'list',
            'create',
            'update',
            'delete',
        ]);

        if ( ! ( config('pidomotichome.permission.allow_manage_rules') || Auth::user()->hasRole('admin') ) ) {
            $this->crud->denyAccess([
                'list',
                'create',
                'update',
                'delete',
            ]);
        }

    }

}