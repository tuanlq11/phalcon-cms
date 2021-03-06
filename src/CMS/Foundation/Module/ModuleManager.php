<?php
namespace CMS\Foundation\Module;

use CMS\Contract\Foundation\Module\ModuleManagerAbstract;
use CMS\Foundation\Configuration\Configuration;
use CMS\Helper\Str;

class ModuleManager extends ModuleManagerAbstract
{
    /**
     * ModuleManager constructor.
     *
     * @param $basePath
     * @param $appDir string
     * @param $config Configuration
     */
    public function __construct($basePath, $appDir, Configuration &$config)
    {
        $this->basePath = $basePath;
        $this->appDir   = $appDir;
        $this->config   = &$config;
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
            $name  = Str::studly($name);
            $alias = array_get($module, "alias", $name);

            $this->module[$name] = new Module($name, $this->basePath, $this->appDir, $alias);

            $schema              = $this->module[$name]->bootstrap();
            $schema["alias"]     = $alias;
            $this->schema[$name] = $schema;
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