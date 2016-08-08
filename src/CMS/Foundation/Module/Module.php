<?php
namespace CMS\Foundation\Module;

use CMS\Contract\Foundation\ApplicationInterface;
use CMS\Contract\Foundation\Configuration\ConfigurationAbstract;
use CMS\Contract\Foundation\Configuration\ConfigurationManagerInterface;
use CMS\Contract\Foundation\Module\ModuleAbstract;
use CMS\Foundation\Application;
use CMS\Foundation\Configuration\ConfigurationManager;

class Module extends ModuleAbstract
{
    /**
     * Module constructor.
     *
     * @param $name
     * @param $appPath
     * @param $application ApplicationInterface
     * @param $alias       string
     */
    public function __construct($name, $appPath, $alias, ApplicationInterface &$application = null)
    {
        if (is_null($application)) {
            $this->application = &Application::getInstance();
        } else {
            $this->application = &$application;
        };

        $this->alias   = $alias;
        $this->name    = $name;
        $this->appPath = rtrim($appPath, '\/');

        $this->moduleConfigLifetime = $this->application->getConfigurations()["module"]->get("config_lifetime");
        $this->prefixNamespace      = $this->application->getConfigurations()[Application::PREFIX_KERNEL_CONFIG]->get("app_namespace", "App");
        $this->configurationPrefix  = $this->configuration_prefix = $this->appPath . $this->name;
        $this->cachePrefix          = "cache:module:configuration:" . md5($this->configurationPrefix);
        $this->modulePath           = rtrim($this->appPath . DIRECTORY_SEPARATOR . $this->name, '\/');
        $this->moduleConfigPath     = rtrim($this->modulePath . DIRECTORY_SEPARATOR . static::MODULE_CONFIG_PATH, '\/');
    }

    /**
     * @return string
     */
    public function modulePath()
    {
        return $this->modulePath;
    }

    /**
     * @return array
     */
    public function bootstrap()
    {
        return [
            "className" => $this->prefixNamespace . "\\" . $this->name . "\\Bootstrap",
            "path"      => $this->modulePath . DIRECTORY_SEPARATOR . static::MODULE_BOOTSTRAP,
        ];
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function alias()
    {
        return $this->alias;
    }

    /**
     * @return array
     */
    public function attr()
    {
        return $this->attr;
    }

    /**
     * @return ConfigurationManagerInterface
     */
    public function configuration()
    {
        if (is_null($this->configuration)) {
            if ($this->application->environment() == "production" &&
                $this->application->cache_default()->exists($this->cachePrefix)
            ) {
                /** Load Configuration From Cache */
                /** @var ConfigurationManager configuration */
                $this->configuration = $this->application->cache_default()->get($this->cachePrefix);
            } else {
                $this->configuration = new ConfigurationManager();

                /** Scan dir config to load file */
                foreach (scandir($this->moduleConfigPath) as $file) {
                    if ($file == "." || $file == "..") continue;
                    $separate = explode(".", $file);
                    if (!isset(ConfigurationAbstract::$EXTENSION_DRIVER[$separate[1]])) continue;

                    $schema = [
                        "name"     => $file,
                        "file"     => $this->moduleConfigPath . DIRECTORY_SEPARATOR . $file,
                        "driver"   => ConfigurationAbstract::$EXTENSION_DRIVER[$separate[1]],
                        "lifetime" => null,
                    ];

                    $this->configuration->create($schema);
                }
                /** End */

                if ($this->application->environment() == "production") {
                    $this->application->cache_default()->save($this->cachePrefix, $this->configuration);
                }
            }
        }

        return $this->configuration;
    }

}