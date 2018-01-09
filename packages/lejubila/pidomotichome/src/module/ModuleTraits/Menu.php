<?php
/**
 * User: david bigagli
 * Date: 15/12/17
 * Time: 21.57
 */

namespace Lejubila\PiDomoticHome\module\ModuleTraits;

trait Menu
{

    /**
     * @var array data of menus
     */
    protected $menuData = null;
    /*
    [
        'home' => null,
        'dashboard' => null,
        'module' => null,
        'settings' => null,
    ];
    */

    /**
     * Set data of module menus
     */
    protected function setMenuData() {
    }

    /**
     * Get html of Dashboard menu
     * @return string
     */
    public function getDashboardMenu() {
        $this->setMenuData();

        if( !empty($this->menuData['dashboard']) ) {
            return view($this->viewNamespace . '::menu.dashboard', ['menu' => $this->menuData['dashboard']]);
        }
        return '';
    }

    /**
     * Get html of Module menu
     * @return string
     */
    public function getModuleMenu() {
        $this->setMenuData();

        if( !empty($this->menuData['module'])) {
            return view( $this->viewNamespace . '::menu.module', ['menu' => $this->menuData['module']] );
        }
        return '';
    }

    /**
     * Get html of Settings Menu
     * @return string
     */
    public function getSettingsMenu() {
        $this->setMenuData();

        if( !empty($this->menuData['settings'])) {
            return view( $this->viewNamespace . '::menu.settings', ['menu' => $this->menuData['settings']] );
        }
        return '';
    }

    public function getHomeMenu() {
        $this->setMenuData();

        if( !empty($this->menuData['home'])) {
            return view( $this->viewNamespace . '::menu.home', ['menu' => $this->menuData['home']] );
        }
        return '';
    }


}