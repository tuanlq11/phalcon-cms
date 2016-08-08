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
        $this->config  = &$config;
    }

    /**
     * Load Module Schema from module.yaml
     *
     * @return void
     */
    public function loadModuleSchema()
    {
        foreach ($this->config->toArray() as $name => $module) {
            if (array_get($module, "disabled", false)) continue;
            $alias = array_get($module, "alias", $name);

            $this->module[$name] = new Module($name, $this->appPath, $alias);
            $this->schema[$name] = [$this->module[$name]->bootstrap()];
        }
    }

    /**
     * @return array
     */
    public function schema()
    {
        return $this->schema;
    }
}