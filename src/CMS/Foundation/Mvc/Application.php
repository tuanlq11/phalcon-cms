<?php
namespace CMS\Foundation\Mvc;

class Application extends \Phalcon\Mvc\Application
{
    public function registerModules(array $modules, $merge = false)
    {
        parent::registerModules($modules, $merge);

        /**
         * Register module
         */
        foreach ($modules as $name => $module) {

        }
    }

}