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
     */
    public function __construct($appPath)
    {
        $this->appPath = $appPath;
        print_r($appPath);
        exit;
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