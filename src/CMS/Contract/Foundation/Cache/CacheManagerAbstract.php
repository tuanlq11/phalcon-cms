<?php
namespace CMS\Contract\Foundation\Cache;

use ArrayAccess, Iterator;

abstract class CacheManagerAbstract implements CacheManagerInterface, ArrayAccess, Iterator
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

    /**
     * @return CacheInterface
     */
    public function current()
    {
        return current($this->caches);
    }

    /**
     * @return CacheInterface
     */
    public function next()
    {
        return next($this->caches);
    }

    /**
     * @return string
     */
    public function key()
    {
        return key($this->caches);
    }

    public function valid()
    {
        $key = key($this->caches);

        return ($key !== null && $key !== false);
    }

    public function rewind()
    {
        reset($this->caches);
    }


}