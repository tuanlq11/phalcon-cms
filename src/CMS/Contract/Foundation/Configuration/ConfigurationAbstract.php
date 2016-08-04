<?php
namespace CMS\Contract\Foundation\Configuration;

use Phalcon\Config;
use ArrayAccess;

abstract class ConfigurationAbstract implements ConfigurationInterface, ArrayAccess
{
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


}