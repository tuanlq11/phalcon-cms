<?php

namespace CMS\Foundation;

use CMS\Foundation\Configuration\ConfigurationManager;
use CMS\Foundation\Cache\CacheManager;
use CMS\Foundation\Configuration\Frontend\KernelConfiguration;
use Dotenv\Dotenv;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application as MvcApplication;
use CMS\Contract\Foundation\ApplicationAbstract;

class Application extends ApplicationAbstract
{
    /**
     * Application constructor.
     *
     * @param $basePath string
     */
    public function __construct($basePath)
    {
        static::$instance = $this;

        $this->setBasePath($basePath);

        /** Load Env config */
        $this->loadEnvironment();
        /** End */

        $this->loadBaseConfiguration();

        $this->loadCacheInstance();
    }

    /**
     * Init FactoryDefault Instance
     *
     * @return FactoryDefault
     */
    function factoryDefault()
    {
        if (is_null($this->di)) {
            $this->di = new FactoryDefault();
        }

        return $this->di;
    }

    /**
     * Init Application instance
     *
     * @return MvcApplication
     */
    function application()
    {
        if (is_null($this->application)) {
            $this->application = new MvcApplication();
        }

        return $this->application;
    }

    /**
     * Register new service for application
     *
     * @param $name     string
     * @param $callback \Closure
     *
     * @return Application
     */
    public function register($name, $callback)
    {
        if (($di = $this->factoryDefault())) {
            $di->set($name, $callback);
        }

        return $this;
    }

    /**
     * Register new service shared for application
     *
     * @param $name     string
     * @param $callback \Closure
     *
     * @return Application
     */
    public function registerShared($name, $callback)
    {
        if (($di = $this->factoryDefault())) {
            $di->setShared($name, $callback);
        }

        return $this;
    }

    /**
     * Handle request
     *
     * @return void
     */
    public function handle()
    {
        $this->application()->handle();
    }

    /**
     * Load env configuration
     */
    public function loadEnvironment()
    {
        (new Dotenv($this->basePath, $this->environmentFile))->load();
        $this->environment = env("APP_ENV", "development");
    }

    /**
     * Load cache instance
     *
     * @return void
     */
    function loadCacheInstance()
    {
        $this->caches = new CacheManager();
        $this->caches->create($this->configurations["kernel"]["cache"]);
    }

    /**
     * Load base/kernel configuration at first
     *
     */
    public function loadBaseConfiguration()
    {
        $this->configurations = new ConfigurationManager($this->basePath);
        $this->configurations->create($this->baseConfigurationSchema);
    }


}