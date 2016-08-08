<?php
namespace CMS\Contract\Foundation\Module;

use CMS\Contract\Foundation\ApplicationInterface;
use CMS\Contract\Foundation\Configuration\ConfigurationManagerInterface;

interface ModuleInterface
{
    const MODULE_BOOTSTRAP   = "Bootstrap.php";
    const MODULE_CONFIG_PATH = "Config";

    /**
     * ModuleInterface constructor.
     *
     * @param $name
     * @param $appPath
     * @param $application ApplicationInterface
     * @param $alias       string
     */
    public function __construct($name, $appPath, $alias, ApplicationInterface &$application = null);

    /**
     * @return ConfigurationManagerInterface
     */
    public function configuration();

}