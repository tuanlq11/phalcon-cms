<?php
namespace CMS\Contract\Foundation\Configuration;

use CMS\Foundation\Cache\Cache;

interface ConfigurationManagerInterface
{
    /**
     * Configuration Manager Interface constructor.
     *
     */
    public function __construct();

    /**
     * Create and add configuration entity
     *
     * @param $name
     * @param $file
     * @param $driver
     * @param $lifetime
     *
     * @return mixed
     */
    public function create($name, $file = null, $driver = null, $lifetime = null);

    /**
     * Add configuration entity
     *
     * @param $configuration
     * @param $name     string
     * @param $lifetime int|null
     *
     * @return mixed
     */
    public function add($configuration, $lifetime = null, $name = null);

    /**
     * Check exists configuration entity name
     *
     * @param $name
     *
     * @return mixed
     */
    public function exists($name);

    /**
     * Remove configuration entity
     *
     * @param $name
     *
     * @return mixed
     */
    public function remove($name);

    /**
     * Check entity is cached
     *
     * @param $name
     *
     * @return mixed
     */
    function is_cached($name);

    /**
     * Get configuration is cached
     *
     * @param $name
     * @param $lifetime
     *
     * @return mixed
     */
    function get_cached($name, $lifetime);

    /**
     * Storing configuration to cache
     *
     * @param $name
     * @param $data
     * @param $lifetime
     *
     * @return mixed
     */
    function save($name, $data, $lifetime);

    /**
     * Path of configuration file
     *
     * @param $file
     *
     * @return mixed
     */
    function path($file);


}