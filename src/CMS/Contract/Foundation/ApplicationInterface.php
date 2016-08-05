<?php
namespace CMS\Contract\Foundation;

use CMS\Contract\Foundation\Cache\CacheManagerInterface;
use CMS\Foundation\Configuration\ConfigurationManager;
use CMS\Foundation\Session\Session;

interface ApplicationInterface
{
    const VERSION = "2.0.0";

    const PREFIX_KERNEL_CONFIG = "kernel";
    const PREFIX_APP_CONFIG    = "app";

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
     * Create cache instance for application
     */
    function cache();

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
     * Register shared bind service
     *
     * @return mixed
     */
    public function registerShared();

    /**
     * @param $name
     * @param $service
     *
     * @return mixed
     */
    public function bindService($name, &$service);

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


}