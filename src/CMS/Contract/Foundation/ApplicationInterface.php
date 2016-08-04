<?php
namespace CMS\Contract\Foundation;

use CMS\Contract\Foundation\Cache\CacheManagerInterface;
use CMS\Foundation\Configuration\ConfigurationManager;

interface ApplicationInterface
{
    /**
     * ApplicationInterface constructor.
     *
     * @param $basePath
     */
    public function __construct($basePath);

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
     * Register service
     *
     * @param $name
     * @param $callback
     *
     * @return mixed
     */
    public function register($name, $callback);

    /**
     * Register shared service
     *
     * @param $name
     * @param $callback
     *
     * @return mixed
     */
    public function registerShared($name, $callback);

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
    function loadCacheInstance();

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