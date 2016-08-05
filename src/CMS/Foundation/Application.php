<?php

namespace CMS\Foundation;

use CMS\Contract\Foundation\Cache\CacheInterface;
use CMS\Foundation\Configuration\ConfigurationManager;
use CMS\Foundation\Cache\CacheManager;
use CMS\Foundation\Session\Session;
use Dotenv\Dotenv;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application as MvcApplication;
use CMS\Contract\Foundation\ApplicationAbstract;
use Phalcon\Mvc\Router;

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

        /** Init Factory Default Instance */
        $this->factoryDefault();
        /** Init MvcApplication */
        $this->application();

        /** Base Service */
        $this->cache();
        $this->session();
        $this->register();
        /** End */
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
     * @return Application
     */
    public function register()
    {
        foreach ($this->containers as &$container) {
            if ($container->isBooted()) continue;
            $this->di->set($container->getName(), $container->getContent(), $container->isShared());
            $container->setBooted(true);
        }
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
     * @return CacheManager
     */
    function cache()
    {
        if (is_null($this->cache)) {

            $this->cache = new CacheManager();
            $this->cache->create(
                $this->configuration[static::PREFIX_KERNEL_CONFIG]["cache"], null, null, null, null,
                function ($name, $cache) {
                    $callback = function () use ($cache) {
                        return $cache;
                    };
                    $this->bindService($name, $callback, true);
                }
            );

            /** Apply cache manager to configuration instance */
            $this->configuration->setCacheMgr($this->cache_default());
        }

        return $this->cache;
    }

    /**
     * Load base/kernel configuration at first
     *
     */
    function loadBaseConfiguration()
    {
        $this->configuration = new ConfigurationManager($this->basePath);
        $this->configuration->create($this->baseConfigurationSchema);
    }

    /**
     * Load session instance
     *
     * @return Session
     */
    function session()
    {
        if (is_null($this->session)) {
            $config        = $this->configuration[static::PREFIX_APP_CONFIG];
            $this->session = $session = new Session(
                $config->get("adapter", Session::ADAPTER_FILE),
                $config->get("name", "cms"),
                $config->get("option", []),
                $config->get("autostart", true),
                $config->get("enabled", true)
            );

            $callback = function () use ($session) {
                return $session;
            };
            $this->bindService(static::SESSION_SERVICE_NAME, $callback, true);
        }

        return $this->session;
    }

    /**
     * Load Router instance
     *
     * @return Router
     */
    function router()
    {
        // TODO: Implement loadRouter() method.
    }

    /**
     * @return CacheInterface|mixed
     */
    public function cache_default()
    {
        if (is_null($this->cache_default)) {
            $default_cache       = $this->configuration[static::PREFIX_KERNEL_CONFIG]->get(static::CACHE_DEFAULT_CONFIG_KEY, static::CACHE_DEFAULT);
            $this->cache_default = $this->cache->get($default_cache);
        }

        return $this->cache_default;
    }
}