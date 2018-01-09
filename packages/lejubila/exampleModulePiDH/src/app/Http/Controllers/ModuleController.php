<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 27/12/17
 * Time: 0.12
 */

namespace Lejubila\PiDomoticHome\ExampleModule\app\Http\Controllers;

use App\Events\ExampleEvent;
use App\Events\ExamplePrivateEvent;
use App\Events\ShippingStatusUpdated;
use App\User;
use Lejubila\PiDomoticHome\app\Http\Controllers\Controller;
use Lejubila\PiDomoticHome\ExampleModule\Module;

class ModuleController extends Controller
{
    protected $data = []; // the information we send to the view

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        //$this->middleware('admin');
    }

    /**
     * Show the module dashboard.
     *
     * @param Module $module
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDashboard(Module $module)
    {
        $this->data['title'] = trans('pidomotichome::dashboard.title') . ' - ' . $module->getNameModule();
        $this->data['name_module'] = $module->getNameModule();

        return view($module->getViewNamespace().'::admin.dashboard', $this->data);
    }

    public function getDashboardEvent()
    {
        /*
        $update = new \stdClass();
        $update->order_id = 1;
        $event = new ShippingStatusUpdated($update);
        event($event);
        */

        $event = new ExampleEvent(['name' => 'David', 'nickname' => 'lejubila']);
        //event($event);
        broadcast($event)->toOthers();

    }

    public function postDashboardPrivateEvent($id_user)
    {
        $event = New ExamplePrivateEvent(['id_user' => $id_user , 'name' => 'David', 'nickname' => 'lejubila']);
        broadcast($event)->toOthers();
        return redirect()->back();
    }

    /**
     * Redirect to the dashboard.
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function redirect()
    {
        // The '/admin' route is not to be used as a page, because it breaks the menu's active state.
        return redirect(config('backpack.base.route_prefix').'/dashboard');
    }
}
