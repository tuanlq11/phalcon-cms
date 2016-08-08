<?php
namespace CMS\Contract\Foundation;

use CMS\Contract\Foundation\Cache\CacheInterface;
use CMS\Contract\Foundation\Cache\CacheManagerInterface;
use CMS\Contract\Foundation\Configuration\ConfigurationInterface;
use CMS\Foundation\Cache\Cache;
use CMS\Foundation\Configuration\ConfigurationManager;
use CMS\Foundation\Container\Container;
use CMS\Foundation\Module\ModuleManager;
use CMS\Foundation\Session\Session;
use CMS\Foundation\View\View;
use Phalcon\Di\FactoryDefault;
use Phalcon\Loader;
use Phalcon\Mvc\Application as MvcApplication;
use Phalcon\Mvc\Router;

abstract class ApplicationAbstract implements ApplicationInterface
{
    /**
     * @var ApplicationAbstract
     */
    protected static $instance;

    /**
     * @var MvcApplication
     */
    protected $application;

    /**
     * @var FactoryDefault
     */
    protected $di;

    /**
     * @var string
     */
    protected $environment = "dev";

    /**
     * @var string
     */
    protected $environmentFile = ".env";

    /**
     * @var string
     */
    protected $basePath;

    /**
     * @var  Loader
     */
    protected $loader;

    /**
     * @var ConfigurationManager
     */
    protected $configuration;

    /**
     * @var CacheManagerInterface
     */
    protected $cache;

    /**
     * @var Session
     */
    protected $session;

    /**
     * @var View
     */
    protected $view;

    protected $db;

    protected $url;

    protected $response;

    protected $dispatcher;

    /** @var  ModuleManager */
    protected $module;

    /**
     * @var Router
     */
    protected $router;

    /**
     * @var Cache
     */
    protected $appCache;

    /**
     * @var Container[]
     */
    protected $containers;

    /**
     * @var CacheInterface
     */
    protected $cache_default;

    /**
     * Kernel schema
     * Lifetime is configured in env config
     *
     * @var array
     */
    protected $baseConfigurationSchema = [
        [
            "name"     => ApplicationInterface::PREFIX_KERNEL_CONFIG,
            "file"     => "config/kernel.php",
            "driver"   => ConfigurationInterface::DRIVER_PHP,
            "lifetime" => null,
        ], [
            "name"     => ApplicationInterface::PREFIX_APP_CONFIG,
            "file"     => "config/app.php",
            "driver"   => ConfigurationInterface::DRIVER_PHP,
            "lifetime" => null,
        ],
    ];

    /**
     * Module Schema Config
     *
     * @var array
     */
    protected $moduleConfigurationSchema = [
        "name"     => ApplicationInterface::PREFIX_MODULE_CONFIG,
        "file"     => "config/module.yaml",
        "driver"   => ConfigurationInterface::DRIVER_YAML,
        "lifetime" => null,
    ];

    /**
     * Get current project base path
     *
     * @return string
     */
    public function basePath()
    {
        return $this->basePath;
    }

    /**
     * Set BasePath
     *
     * @param string $basePath
     *
     * @return $this
     */
    function setBasePath($basePath)
    {
        $this->basePath = rtrim($basePath, '\/');

        return $this;
    }

    /**
     * Get number of version application
     *
     * @return string
     */
    public function version()
    {
        return static::VERSION;
    }

    /**
     * @return CacheManagerInterface
     */
    public function getCaches()
    {
        return $this->cache;
    }

    /**
     * @return ConfigurationManager
     */
    public function getConfigurations()
    {
        return $this->configuration;
    }

    /**
     * Bind service
     *
     * @param $name
     * @param $service
     * @param $shared bool
     *
     * @return void
     */
    public function bindService($name, &$service, $shared = false)
    {
        $this->containers[$name] = new Container($name, $service, $shared);
    }

    /**
     * Unbind service
     *
     * @param $name
     *
     * @return void
     */
    public function unbindService($name)
    {
        unset($this->containers[$name]);
    }
}