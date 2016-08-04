<?php
namespace CMS\Contract\Foundation\Cache;

use ArrayAccess;

abstract class CacheManagerAbstract implements CacheManagerInterface, ArrayAccess
{
    /**
     * @var array
     */
    protected $caches = [];

    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->caches[$offset]);
    }

    /**
     * @param mixed $offset
     *
     * @return CacheInterface
     */
    public function offsetGet($offset)
    {
        return $this->caches[$offset];
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->caches[$offset] = $value;
    }

    /**
     * @param mixed $offset
     *
     * @return $this
     */
    public function offsetUnset($offset)
    {
        unset($this->caches[$offset]);

        return $this;
    }



}