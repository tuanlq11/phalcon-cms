<?php
namespace CMS\Foundation\Configuration;

use CMS\Contract\Foundation\Configuration\ConfigurationAbstract;

class Configuration extends ConfigurationAbstract
{
    /**
     * Configuration constructor
     *
     * @param string $name
     * @param string $file
     * @param string $driver
     */
    public function __construct($file, $name, $driver)
    {
        $this->name   = $name;
        $this->file   = $file;
        $this->driver = $driver;
    }

    /**
     * Load config from file
     *
     * @return $this
     */
    public function load()
    {
        $this->config     = new $this->driver($this->file);
        $this->arr_config = $this->config->toArray();

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return serialize($this);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->arr_config;
    }

    /**
     * @param      $index
     * @param null $default
     *
     * @return mixed
     */
    public function get($index, $default = null)
    {
        return $this->config->get($index, $default);
    }

}