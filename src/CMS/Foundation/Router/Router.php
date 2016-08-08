<?php
namespace CMS\Foundation\Router;

use CMS\Foundation\Module\ModuleManager;

class Router extends \Phalcon\Mvc\Router
{
    /** @var  ModuleManager */
    protected $module;

    /**
     * Router constructor.
     *
     * @param bool $defaultRoutes
     * @param      $module
     */
    public function __construct(&$module, $defaultRoutes = true)
    {
        $this->module = &$module;
        parent::__construct($defaultRoutes);
    }


    /**
     * @return void
     */
    public function init()
    {
        foreach ($this->module->schema() as $name => $module) {
            $this->add("/{$module["alias"]}(/)?", [
                "module" => $name,
            ]);
        }
    }
}