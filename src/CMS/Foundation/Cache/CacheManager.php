<?php
namespace CMS\Foundation\Cache;

use CMS\Contract\Foundation\Cache\CacheInterface;
use CMS\Contract\Foundation\Cache\CacheManagerAbstract;
use CMS\Contract\Foundation\Cache\CacheManagerInterface;

class CacheManager extends CacheManagerAbstract
{

    /**
     * @param $name
     * @param $driver
     * @param $dataType
     * @param $lifetime
     * @param $parameter
     * @param $callback \Closure
     *
     * @return mixed
     */
    public function create($name, $driver = null, $dataType = null, $lifetime = null, $parameter = null, $callback = null)
    {
        /** Create multiple configuration  */
        if (is_array($name)) {
            $caches = $name;
            foreach ($caches as $name => $cache) {
                $cache = $this->create(
                    $name,
                    $cache["driver"],
                    $cache["dataType"],
                    array_get($cache, "lifetime"),
                    array_get($cache, "param", [])
                );
                if ($callback) {
                    $callback($name, $cache);
                }
            }

        } else {
            if ($this->exists($name)) return;

            $this->caches[$name] = new Cache($driver, $dataType, $lifetime, $parameter);

            return $this->caches[$name];
        }

    }

    /**
     * @param $cache
     * @param $name
     *
     * @return CacheManagerInterface
     */
    public function add($cache, $name)
    {
        $this->caches[$name] = $cache;

        return $this;
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function exists($name)
    {
        return isset($this->caches[$name]);
    }

    /**
     * @param $name
     *
     * @return CacheInterface
     */
    public function get($name)
    {
        return $this->caches[$name];
    }

    /**
     * @param $name
     *
     * @return void
     */
    public function remove($name)
    {
        unset($this->caches[$name]);
    }

}