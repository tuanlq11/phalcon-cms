<?php
namespace CMS\Contract\Foundation;

use CMS\Contract\Foundation\Cache\CacheManagerInterface;
use CMS\Contract\Foundation\Configuration\ConfigurationInterface;
use CMS\Foundation\Application;
use CMS\Foundation\Cache\Cache;
use CMS\Foundation\Configuration\ConfigurationManager;
use CMS\Foundation\Configuration\Frontend\Kernel;
use CMS\Foundation\Session\Session;
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
     * @var Router
     */
    protected $router;

    /**
     * @var Cache
     */
    protected $appCache;

    /**
     * Kernel schema
     * Lifetime is configured in env config
     *
     * @var array
     */
    protected $baseConfigurationSchema = [
        "name"     => ApplicationInterface::PREFIX_KERNEL_CONFIG,
        "file"     => "config/kernel.php",
        "driver"   => ConfigurationInterface::DRIVER_PHP,
        "lifetime" => null,
        "class"    => Kernel::class,
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
     * Return instance of application
     *
     * @param $basePath string|null
     *
     * @return Application
     */
    public static function getInstance($basePath = null)
    {
        if (is_null(self::$instance)) {
            self::$instance = new Application($basePath);
        }

        return self::$instance;
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


}