<?php
namespace CMS\Contract\Foundation\Configuration;

use Phalcon\Config;
use ArrayAccess;

abstract class ConfigurationAbstract implements ConfigurationInterface, ArrayAccess
{
    public static $EXTENSION_DRIVER = [
        "yaml" => ConfigurationInterface::DRIVER_YAML,
        "php"  => ConfigurationInterface::DRIVER_PHP,
        "ini"  => ConfigurationInterface::DRIVER_INI,
        "json" => ConfigurationInterface::DRIVER_JSON,
    ];
    /**
     * @var Config
     */
    protected $config;

    /**
     * @var array
     */
    protected $arr_config;

    /**
     * @var string
     */
    protected $file;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $driver;

    /**
     * Get name of me
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name for me
     *
     * @param $name
     *
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->arr_config[$offset]);
    }

    /**
     * @param mixed $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->arr_config[$offset];
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     *
     * @return bool
     */
    public function offsetSet($offset, $value)
    {
        $this->arr_config[$offset] = $value;
    }

    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetUnset($offset)
    {
        unset($this->arr_config[$offset]);
    }


}