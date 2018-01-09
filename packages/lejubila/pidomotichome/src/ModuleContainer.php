<?php
/**
 * User: david bigagli
 * Date: 10/12/17
 * Time: 16.41
 */

namespace Lejubila\PiDomoticHome;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Lejubila\PiDomoticHome\module\AbstractModule;
use Lejubila\PiDomoticHome\ModuleTraits\Menu;

class ModuleContainer extends Collection
{

    public function __construct($items = [])
    {
        parent::__construct($items);

        foreach( config('pidomotichome.modulesEnabled', [] ) as $module ) {
            $this->push( App::make($module) );
        }
    }

    /**
     * @return string
     */
    public function getDashboardMenu()
    {
        $menu = '';
        foreach($this->all() as $item) {
            $menu .= $item->getDashboardMenu();
        }
        return $menu;
    }

    /**
     * @return string
     */
    public function getHomeMenu()
    {
        $menu = '';
        foreach($this->all() as $item) {
            $menu .= $item->getHomeMenu();
        }
        return $menu;
    }

    /**
     * @return string
     */
    public function getModulesMenu()
    {
        $menu = '';
        foreach($this->all() as $item) {
            $menu .= $item->getModuleMenu();
        }
        return $menu;
    }

    /**
     * @return string
     */
    public function getSettingsMenu()
    {
        $menu = '';
        foreach($this->all() as $item) {
            $menu .= $item->getSettingsMenu();
        }
        return $menu;
    }

    /**
     * Get data modules to view in dashboard
     * @return array
     */
    public function getDashboardModules()
    {
        $modules = [];
        foreach($this->all() as $item) {
            /**
             * @var BaseModule $item
             */
            if( $link = $item->getDashboardLink() ) {
                $modules[] = [
                    'name' => $item->getNameModule(),
                    'description' => $item->getDescriptionModule(),
                    'link' => $link,
                    'iconUrl' => $item->getIconUrlModule(),
                ];
            }
        }
        return $modules;
    }

    /**
     * Get data modules to view in home page
     * @return array
     */
    public function getHomeModules()
    {
        $modules = [];
        foreach($this->all() as $item) {
            /**
             * @var AbstractModule $item
             */
            if( $link = $item->getHomeLink() ) {
                $modules[] = [
                    'name' => $item->getNameModule(),
                    'description' => $item->getDescriptionModule(),
                    'link' => $link,
                    'iconUrl' => $item->getIconUrlModule(),
                ];
            }
        }

        return $modules;
    }

}