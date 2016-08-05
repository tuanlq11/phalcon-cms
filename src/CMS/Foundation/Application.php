<?php

namespace CMS\Foundation;

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

        /** Base Service */
        $this->cache();
        $this->session();
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
            $this->cache->create($this->configuration[static::PREFIX_KERNEL_CONFIG]["cache"]);

            foreach ($this->cache as $name => $c) {
                $callback = function () use ($c) {
                    return $c;
                };
                $this->bindService($name, $callback, true);
            }
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
            $this->bindService($this->session->getName(), $callback, true);
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
}