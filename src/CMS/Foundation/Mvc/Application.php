<?php
namespace CMS\Foundation\Mvc;

use CMS\Foundation\Module\Module;

class Application extends \Phalcon\Mvc\Application
{
    /**
     * @return Module
     */
    public function module()
    {
        return $this->module;
    }

    /**
     * @param array $modules
     * @param bool  $merge
     *
     * @return void
     */
    public function registerModules(array $modules, $merge = false)
    {
        parent::registerModules($modules, $merge);
    }

}