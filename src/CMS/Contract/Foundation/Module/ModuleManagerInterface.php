<?php
namespace CMS\Contract\Foundation\Module;

use CMS\Foundation\Configuration\Configuration;

interface ModuleManagerInterface
{
    /**
     * ModuleManagerInterface constructor.
     *
     * @param $basePath
     * @param $appDir
     * @param $config
     */
    public function __construct($basePath, $appDir, Configuration &$config);

    /**
     * @return mixed
     */
    public function loadModuleSchema();

    /**
     * @return mixed
     */
    public function schema();

}