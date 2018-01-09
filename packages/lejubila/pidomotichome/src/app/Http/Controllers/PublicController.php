<?php

namespace Lejubila\PiDomoticHome\app\Http\Controllers;

use Lejubila\PiDomoticHome\ModuleContainer;

class PublicController extends Controller
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
     * Show the admin dashboard.
     *
     * @param ModuleContainer $moduleContainer
     * @return \Illuminate\Http\Response
     */
    public function getHome(ModuleContainer $moduleContainer)
    {
        $this->data['modules'] = $moduleContainer->getHomeModules();
        $this->data['title'] = trans('pidomotichome::home.title'); // set the page title

        return view('pidomotichome::public.home', $this->data);
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
