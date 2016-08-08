<?php
namespace CMS\Contract\Foundation\Module;

use CMS\Contract\Foundation\ApplicationInterface;
use CMS\Contract\Foundation\Configuration\ConfigurationManagerInterface;

interface ModuleInterface
{
    const MODULE_BOOTSTRAP       = "Bootstrap.php";
    const MODULE_CONFIG_PATH     = "Config";
    const MODULE_CONTROLLER_PATH = "Controller";

    /**
     * ModuleInterface constructor.
     *
     * @param $name
     * @param $basePath
     * @param $appDir
     * @param $application ApplicationInterface
     * @param $alias       string
     */
    public function __construct($name, $basePath, $appDir, $alias, ApplicationInterface &$application = null);

    /**
     * @return ConfigurationManagerInterface
     */
    public function configuration();

    /**
     * @param $absolute bool
     *
     * @return string
     */
    public function path($absolute = false);

    /**
     * @param $absolute bool
     *
     * @return string
     */
    public function configPath($absolute = false);

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

    /**
     * Namespace
     *
     * @return string
     */
    public function nsController();

}