<?php

namespace CMS\Foundation;

use CMS\Contract\Foundation\Cache\CacheInterface;
use CMS\Foundation\Configuration\ConfigurationManager;
use CMS\Foundation\Cache\CacheManager;
use CMS\Foundation\Module\ModuleManager;
use CMS\Foundation\Mvc\Dispatcher;
use CMS\Foundation\Session\Session;
use CMS\Foundation\Translation\Translation;
use CMS\Foundation\View\View;
use CMS\Plugin\Exception;
use CMS\Skeleton\Bootstrap;
use Dotenv\Dotenv;
use Phalcon\Di\FactoryDefault;
use CMS\Contract\Foundation\ApplicationAbstract;
use CMS\Foundation\Mvc\Application as MvcApplication;
use CMS\Foundation\Router\Router;
use Phalcon\Events\Manager as EventManager;

class Application extends ApplicationAbstract
{
    /**
     * Application constructor.
     *
     * @param $basePath string
     */
    public function __construct($basePath)
    {
        static::$instance = &$this;

        $this->setBasePath($basePath);

        $this->initKernel();
    }

    /**
     * Init Kernel requirement
     */
    function initKernel()
    {
        $this->configuration = new ConfigurationManager($this->basePath);

        /** Load Env config */
        $this->loadEnvironment();
        /** End */

        $this->loadBaseConfiguration();

        /** Module Loader */
        $this->loadModuleConfig();
        /** End */

        /** Init Factory Default Instance */
        $this->factoryDefault();
        /** Init MvcApplication */
        $this->application();

        /** Base Service */
        $this->bindBaseService();

        $this->register();
    }

    /**
     * Return instance of application
     *
     * @param $basePath string|null
     *
     * @return Application
     */
    public static function &getInstance($basePath = null)
    {
        if (is_null(self::$instance)) {
            self::$instance = new Application($basePath);
        }

        return self::$instance;
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
            $this->application = new MvcApplication($this->di);
            $this->application->registerModules($this->module->schema());
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
     * @return mixed
     */
    public function handle()
    {
        /** Start session */
        $this->session->handle();

        return $this->application()->handle();
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
                function ($name, &$cache) {
                    $callback = function () use (&$cache) {
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
        $this->configuration->create($this->baseConfigurationSchema);
    }

    /**
     * @return void
     */
    function loadModuleConfig()
    {
        $this->moduleConfigurationSchema["lifetime"] = $this->configuration["kernel"]
                                                           ->get("module", ["schema_lifetime" => null])["schema_lifetime"];

        $this->configuration->create($this->moduleConfigurationSchema);

        if (is_null($this->module)) {
            $config = $this->configuration[static::PREFIX_MODULE_CONFIG];

            $this->module = new ModuleManager(
                $this->basePath,
                $this->configuration["kernel"]->get("app_dir", "app"),
                $config
            );

            $this->module->loadModuleSchema();
        }
    }

    /**
     * Load session instance
     *
     * @return Session
     */
    function session()
    {
        if (is_null($this->session)) {
            $config = $this->configuration[static::PREFIX_APP_CONFIG]->get("session", []);

            $this->session = $session = new Session(
                $config->get("adapter", Session::ADAPTER_FILE),
                $config->get("name", "cms"),
                (array)$config->get("option", []),
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
     * @return View
     */
    function view()
    {
        if (is_null($this->view)) {
            $this->view = new View();
            $this->view->setViewsDir($this->basePath . DIRECTORY_SEPARATOR . static::VIEW_DEFAULT);

            $view     = &$this->view;
            $callback = function () use (&$view) {
                return $view;
            };
            $this->bindService(static::VIEW_SERVICE_NAME, $callback, true);
        }

        return $this->view;
    }

    /**
     * Load Router instance
     *
     * @return Router
     */
    function router()
    {
        if (is_null($this->router)) {
            $this->router = new Router($this->module);
            $this->router->setUriSource(Router::URI_SOURCE_SERVER_REQUEST_URI);

            $router   = &$this->router;
            $callback = function () use (&$router) {
                return $router;
            };
            $this->bindService(static::ROUTER_SERVICE_NAME, $callback, true);
        }

        return $this->router;
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

    /**
     * @return void
     */
    function bindBaseService()
    {
        foreach (["cache", "session", "view", "router", "url", "db", "dispatcher", "translation"] as $service) {
            if (method_exists($this, $service)) {
                $this->$service();
            }
        }
    }

    /**
     * @return string
     */
    public function environment()
    {
        return $this->environment;
    }

    /**
     * @return Translation
     */
    public function translation()
    {
        if (is_null($this->translation)) {
            $this->translation = $translation = new Translation($this);
            $callback          = function () use ($translation) {
                return $translation;
            };

            $this->bindService("translation", $callback, true);
        }

        return $this->translation;
    }

    /**
     * @return void
     */
    public function dispatcher()
    {
        $this->dispatcher = $dispatcher = new Dispatcher();

        $callback = function () use ($dispatcher) {
            $eventManager = new EventManager();

            $class = app()->configuration[app()::PREFIX_APP_CONFIG]->get("exception", Exception::class);
            $eventManager->attach("dispatch:beforeException", new $class());

            $dispatcher->setEventsManager($eventManager);

            return $dispatcher;
        };
        $this->bindService("dispatcher", $callback, true);
    }

}