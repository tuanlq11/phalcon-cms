<?php
namespace CMS\Foundation\Module;

use CMS\Contract\Foundation\Module\ModuleManagerAbstract;
use CMS\Foundation\Configuration\Configuration;

class ModuleManager extends ModuleManagerAbstract
{
    /**
     * ModuleManager constructor.
     *
     * @param $appPath
     * @param $config Configuration
     */
    public function __construct($appPath, Configuration &$config)
    {
        $this->appPath = $appPath;
        $this->config = &$config;
    }

    /**
     * Load Module Schema from module.yaml
     *
     */
    public function loadModuleSchema()
    {
        print_r($this->config->toArray());
    }
}