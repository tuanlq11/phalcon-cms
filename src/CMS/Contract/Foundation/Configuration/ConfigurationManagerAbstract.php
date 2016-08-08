<?php
namespace CMS\Contract\Foundation\Configuration;

use ArrayAccess;
use CMS\Foundation\Cache\Cache;
use CMS\Foundation\Configuration\Configuration;

abstract class ConfigurationManagerAbstract implements ConfigurationManagerInterface, ArrayAccess
{
    /**
     * Cache prefix key
     *
     * @var string
     */
    public $prefix = "binary_kernel_configuration:";

    /**
     * @var Configuration[]
     */
    protected $configurations = [];

    /**
     * @var string
     */
    protected $basePath;

    /**
     * @var Cache
     */
    protected $cacheMgr;

    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->configurations[$offset]);
    }

    /**
     * @param mixed $offset
     *
     * @return Configuration
     */
    public function offsetGet($offset)
    {
        return $this->configurations[$offset];
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->configurations[$offset] = $value;
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->configurations[$offset]);
    }

    /**
     * @return Cache
     */
    public function getCacheMgr()
    {
        return $this->cacheMgr;
    }

    /**
     * @param Cache $cacheMgr
     */
    public function setCacheMgr($cacheMgr)
    {
        $this->cacheMgr = $cacheMgr;
    }

    /**
     * Get path of configuration file
     *
     * @param $file
     *
     * @return string
     */
    function path($file)
    {
        return $this->basePath . DIRECTORY_SEPARATOR . $file;
    }

    /**
     * Check has exist configuration
     *
     * @param $name
     *
     * @return boolean
     */
    public function exists($name)
    {
        return isset($this->configurations[$name]);
    }

    /**
     * Remove configuration entity
     *
     * @param $name
     *
     * @return void
     */
    public function remove($name)
    {
        unset($this->configurations[$name]);
    }

    /**
     * Check configuration is cached
     *
     * @param $name
     *
     * @return boolean
     */
    function is_cached($name)
    {
        $name = $this->prefix . $name;

        return $this->cacheMgr->driver()->exists($name);
    }

    /**
     * Get cached entity
     *
     * @param $name
     * @param $lifetime
     *
     * @return mixed
     */
    function get_cached($name, $lifetime)
    {
        $name = $this->prefix . $name;

        return $this->cacheMgr->driver()->get($name, $lifetime);
    }


    /**
     * Caching
     *
     * @param $name
     * @param $content
     * @param $lifetime
     *
     * @return bool
     */
    function save($name, $content, $lifetime)
    {
        $name = $this->prefix . $name;

        return $this->cacheMgr->driver()->save($name, $content, $lifetime);
    }


}