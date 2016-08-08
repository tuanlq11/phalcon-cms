<?php
namespace CMS\Contract\Foundation\Module;

use CMS\Foundation\Configuration\Configuration;

interface ModuleManagerInterface
{
    /**
     * ModuleManagerInterface constructor.
     *
     * @param $appPath
     */
    public function __construct($appPath);

    public function loadModuleSchema(Configuration $config);

}