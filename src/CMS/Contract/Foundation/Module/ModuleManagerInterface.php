<?php
namespace CMS\Contract\Foundation\Module;

interface ModuleManagerInterface
{
    /**
     * @param $name
     * @param $appPath
     *
     * @return array
     */
    public function create($name, $appPath);

    /**
     * @param $module
     *
     * @return ModuleInterface
     */
    public function add($module);
}