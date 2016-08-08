<?php
namespace CMS\Contract\Foundation\Module;

use CMS\Foundation\Configuration\Configuration;
use CMS\Foundation\Module\Module;
use ArrayAccess;

abstract class ModuleManagerAbstract implements ModuleManagerInterface, ArrayAccess
{
    /** @var  string */
    protected $basePath;
    /** @var  string */
    protected $appDir;

    /** @var  Module[] */
    protected $module = [];

    /** @var array */
    protected $schema = [];

    /** @var  Configuration */
    protected $config;

    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->module[$offset]);
    }

    /**
     * @param mixed $offset
     *
     * @return Module
     */
    public function offsetGet($offset)
    {
        return $this->module[$offset];
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->module[$offset] = $value;
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->module[$offset]);
    }


}