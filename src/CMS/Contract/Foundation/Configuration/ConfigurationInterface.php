<?php
namespace CMS\Contract\Foundation\Configuration;

use Phalcon\Config;

interface ConfigurationInterface
{

    const DRIVER_PHP  = Config\Adapter\Php::class;
    const DRIVER_YAML = Config\Adapter\Yaml::class;
    const DRIVER_INI  = Config\Adapter\Ini::class;
    const DRIVER_JSON = Config\Adapter\Json::class;

    /**
     * ConfigurationAbstract constructor.
     *
     * @param string $driver
     * @param string $name
     * @param string $file
     *
     */
    public function __construct($file, $name, $driver);

    /**
     * Load configuration from file
     *
     * @return mixed
     */
    public function load();

    /**
     * @return mixed
     */
    public function __toString();

    /**
     * @return array
     */
    public function toArray();

    /**
     * Get configuration name
     *
     * @return mixed
     */
    public function getName();

    /**
     * Set name
     *
     * @param $name
     *
     * @return mixed
     */
    public function setName($name);

    /**
     * @return mixed
     */
    public function get($index, $default = null);

}