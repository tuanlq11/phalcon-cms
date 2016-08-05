<?php
namespace CMS\Contract\Foundation\Module;

use CMS\Contract\Foundation\ApplicationInterface;
use CMS\Contract\Foundation\Configuration\ConfigurationManagerInterface;

interface ModuleInterface
{
    const MODULE_CONFIG_PATH = "config";

    /**
     * ModuleInterface constructor.
     *
     * @param $name
     * @param $appPath
     * @param $application ApplicationInterface
     */
    public function __construct($name, $appPath, ApplicationInterface &$application = null);

    /**
     * @return ConfigurationManagerInterface
     */
    public function configuration();

}