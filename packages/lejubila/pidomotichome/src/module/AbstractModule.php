<?php
/**
 * User: david
 * Date: 11/12/17
 * Time: 0.25
 */

namespace Lejubila\PiDomoticHome\module;

use Illuminate\Support\Facades\Route;
use Lejubila\PiDomoticHome\module\ModuleTraits\Menu;

abstract class AbstractModule
{
    use Menu;

    /**
     * @var string identifier module
     */
    protected $idModule = '';

    /**
     * @var string
     */
    protected $nameModule = '';

    /**
     * @var string
     */
    protected $descriptionModule = '';

    /**
     * @var string namespace of view
     */
    protected $viewNamespace = '';

    /**
     * @var string route of module dashboard link
     */
    protected $dashboardRoute = '';

    /**
     * @var string route of module home link
     */
    protected $homeRoute = '';

    /**
     * @var string
     */
    protected $imagePath = '';

    /**
     * BaseModule constructor.
     */
    public function __construct()
    {
        $this->setIdModule();
        $this->viewNamespace = config('pidomotichome.modules.'.$this->idModule.'.viewNamespace');
        $this->nameModule = trans('pidomotichome.modules.'.$this->idModule.'::module.name');
        $this->descriptionModule = trans('pidomotichome.modules.'.$this->idModule.'::module.description');
        $dashboardRoute = $this->idModule.'.dashboard';
        $homeRoute = $this->idModule.'.home';
        if( Route::has($dashboardRoute)) {
            $this->dashboardRoute = $dashboardRoute;
        }
        if( Route::has($homeRoute)) {
            $this->homeRoute = $homeRoute;
        }
        $this->imagePath = $path = 'vendor/pidomotichome/modules/'.$this->getIdModule().'/images/';

    }

    /**
     * Get module name
     * @return string
     */
    public function getNameModule() {
        return $this->nameModule;
    }

    /**
     * Get module description
     * @return string
     */
    public function getDescriptionModule() {
        return $this->descriptionModule;
    }

    /**
     * @return Route|null
     */
    public function getDashboardLink() {
        $link = null;
        if($this->dashboardRoute){
            $link = route($this->dashboardRoute);
        }
        return $link;
    }

    /**
     * @return Route|null
     */
    public function getHomeLink() {
        $link = null;
        if($this->homeRoute){
            $link = route($this->homeRoute);
        }
        return $link;
    }

    /**
     * @return string
     */
    public function getImagePath() {
        return $this->imagePath;
    }

    /**
     * Return url of module image icon
     *
     * @return string
     */
    public function getIconUrlModule() {
        $pathImage = $this->getImagePath() . 'module.png';
        $path = public_path( $pathImage );
        if( !file_exists( $path ) ) {
            $pathImage = 'vendor/pidomotichome/images/module.png';
        }
        return asset($pathImage);
    }


    /**
     * @return string
     */
    public function getIdModule() {
        return $this->idModule;
    }

    /**
     * @return \Illuminate\Config\Repository|mixed|string
     */
    public function getViewNamespace() {
        return $this->viewNamespace;
    }

    /**
     * Set module identifier to $this->idModule
     */
    abstract protected function setIdModule();


}