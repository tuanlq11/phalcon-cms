<?php
namespace CMS\Foundation;

use CMS\Contract\Foundation\Configuration\ConfigurationAbstract;

class Configuration extends ConfigurationAbstract
{
    /**
     * Configuration constructor
     *
     * @param string $name
     * @param string $file
     * @param string $driver
     * @param mixed $lifetime
     */
    public function __construct($file, $name, $driver, $lifetime = false)
    {
        $this->name = $name;
        $this->file = $file;
        $this->driver = $driver;
        $this->lifetime = $lifetime;
    }

    /**
     * Load config from file
     */
    public function load()
    {
        $this->config = new $this->driver($this->getPath());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return serialize($this);
    }
}