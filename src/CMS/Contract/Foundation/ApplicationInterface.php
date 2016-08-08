<?php
namespace CMS\Contract\Foundation;

use CMS\Contract\Foundation\Cache\CacheInterface;
use CMS\Contract\Foundation\Cache\CacheManagerInterface;
use CMS\Foundation\Configuration\ConfigurationManager;
use CMS\Foundation\Session\Session;

interface ApplicationInterface
{
    const VERSION = "2.0.0";

    /** Kernel config name. Ex: kernel */
    const PREFIX_KERNEL_CONFIG = "kernel";
    /** App config name. EX: app */
    const PREFIX_APP_CONFIG = "app";
    /** Module schema config name. EX: module */
    const PREFIX_MODULE_CONFIG = "module";

    /** Default session service name */
    const SESSION_SERVICE_NAME = "session";
    /** Default view service name */
    const VIEW_SERVICE_NAME = "view";
    /** Default router service name */
    const ROUTER_SERVICE_NAME = "router";

    /** Default cache key config */
    const CACHE_DEFAULT_CONFIG_KEY = "cache_default";
    /** Default cache name if CACHE_DEFAULT_CONFIG_KEY is empty*/
    const CACHE_DEFAULT = "storage";

    /** Default view DIR */
    const VIEW_DEFAULT = "resource/view";

    /**
     * ApplicationInterface constructor.
     *
     * @param $basePath
     */
    public function __construct($basePath);

    /**
     * @return Session
     */
    function session();

    /**
     * @return mixed
     */
    function router();

    /**
     * @return mixed
     */
    function loadEnvironment();

    /**
     * Load base/kernel config
     *
     * @return mixed
     */
    function loadBaseConfiguration();

    /**
     * @return mixed
     */
    function loadModuleConfig();

    /**
     * Create cache instance for application
     */
    function cache();

    /**
     * @return mixed
     */
    function view();

    /**
     * Set Base Path
     *
     * @param $basePath string
     *
     * @return mixed
     */
    function setBasePath($basePath);

    /**
     * Init Factory Default instance
     *
     * @return mixed
     */
    function factoryDefault();

    /**
     * Init Mvc Application instance
     *
     * @return mixed
     */
    function application();

    /**
     * Get version of application
     *
     * @return mixed
     */
    public function version();

    /**
     * Get APP_PATH of project bootstrap
     *
     * @return mixed
     */
    public function basePath();

    /**
     * Register bind service
     *
     * @return mixed
     */
    public function register();

    /**
     * @return void
     */
    function bindBaseService();

    /**
     * @param $name
     * @param $service
     * @param $shared
     *
     * @return mixed
     */
    public function bindService($name, &$service, $shared = false);

    /**
     * @param $name
     *
     * @return mixed
     */
    public function unbindService($name);

    /**
     * Handle request
     *
     * @return mixed
     */
    public function handle();

    /**
     * @return CacheManagerInterface
     */
    public function getCaches();

    /**
     * @return ConfigurationManager
     */
    public function getConfigurations();

    /**
     * @return CacheInterface
     */
    public function cache_default();

    /**
     * @return string
     */
    public function environment();


    /**
     * @return void
     */
    function initKernel();

}