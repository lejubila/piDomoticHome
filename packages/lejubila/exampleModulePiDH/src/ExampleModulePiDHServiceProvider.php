<?php

namespace Lejubila\PiDomoticHome\ExampleModule;

use Lejubila\PiDomoticHome\module\AbstractModuleServiceProvider;

class ExampleModulePiDHServiceProvider extends AbstractModuleServiceProvider {

    /**
     * Set idModule into $this->idModule
     */
    protected function setIdModule()
    {
        $this->idModule = 'example';
    }

    /**
     * Set module class name in $5his->moduleClassName
     */
    protected function setModuleClassName()
    {
        $this->moduleClassName = Module::class;
    }

    /**
     * Set directory of Module in $this->moduleBaseDir = __DIR__
     */
    protected function setModuleBaseDir()
    {
        $this->moduleBaseDir = __DIR__;
    }
}
