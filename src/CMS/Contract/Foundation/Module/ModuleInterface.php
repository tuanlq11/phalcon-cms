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

    /**
     * @return mixed
     */
    public function modulePath();

    /**
     * @return mixed
     */
    public function bootstrap();

    /**
     * @return mixed
     */
    public function name();

    /**
     * @return mixed
     */
    public function alias();

    /**
     * @return mixed
     */
    public function attr();
}