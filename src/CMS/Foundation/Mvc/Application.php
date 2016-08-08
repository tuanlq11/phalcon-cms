<?php
namespace CMS\Foundation\Mvc;

class Application extends \Phalcon\Mvc\Application
{
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