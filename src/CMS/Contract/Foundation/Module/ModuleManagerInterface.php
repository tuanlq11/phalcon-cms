<?php
namespace CMS\Contract\Foundation\Module;

use CMS\Foundation\Configuration\Configuration;

interface ModuleManagerInterface
{
    /**
     * ModuleManagerInterface constructor.
     *
     * @param $appPath
     * @param $config
     */
    public function __construct($appPath, Configuration &$config);

    public function loadModuleSchema();

}