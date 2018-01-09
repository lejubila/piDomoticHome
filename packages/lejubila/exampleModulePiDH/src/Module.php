<?php
/**
 * User: david bigagli
 * Date: 10/12/17
 * Time: 19.07
 */

namespace Lejubila\PiDomoticHome\ExampleModule;

use Lejubila\PiDomoticHome\module\AbstractModule;

class Module extends AbstractModule {

    /**
     * Set module identifier to $this->idModule
     */
    protected function setIdModule()
    {
        $this->idModule = 'example';
    }

    protected function setMenuData()
    {
        parent::setMenuData();
        if( !$this->menuData ) {

            $this->menuData['home'] = [
                'link1' => [
                    'name' => $this->getNameModule(),
                    'link' => $this->getHomeLink(),
                    'fa-icon'  => 'fa-th-large',
                ]
            ];

            $this->menuData['dashboard'] = [
                'link1' => [
                    'name' => $this->getNameModule(),
                    'link' => $this->getDashboardLink(),
                    'fa-icon'  => 'fa-th-large',
                ]
            ];

            $this->menuData['module'] = [
                'link1' => [
                    'name' => 'Link 1',
                    'link' => '#',
                    'fa-icon'  => 'fa-th-large',
                ],
                'link2' => [
                    'name' => 'Link 2',
                    'link' => '#',
                    'fa-icon'  => 'fa-th-large',
                ],

            ];

            $this->menuData['settings'] = [
                'settings1' => [
                    'name' => 'Settings 1',
                    'link' => '#',
                    'fa-icon'  => 'fa-th-large',
                ]
            ];

        }

    }

}