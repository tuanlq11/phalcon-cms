<?php
namespace CMS\Foundation\Module\ModuleManager;

use CMS\Contract\Foundation\Module\ModuleManagerAbstract;
use CMS\Foundation\Configuration\Configuration;

class ModuleManager extends ModuleManagerAbstract
{
    /**
     * ModuleManager constructor.
     *
     * @param $appPath
     */
    public function __construct($appPath)
    {
        $this->appPath = $appPath;
    }

    /**
     * Load Module Schema from module.yaml
     *
     * @param Configuration $config
     */
    public function loadModuleSchema(Configuration $config)
    {
        print_r($config->toArray());
    }
}