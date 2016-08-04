<?php
namespace CMS\Contract\Foundation\Cache;

use CMS\Foundation\Cache;

class CacheManager extends CacheManagerAbstract
{

    /**
     * @param $name
     * @param $driver
     * @param $dataType
     * @param $lifetime
     * @param $parameter
     *
     * @return void
     */
    public function create($name, $driver, $dataType, $lifetime, $parameter)
    {
        /** Create multiple configuration  */
        if (is_array($name)) {
            $caches = $name;
            /** Array two level */
            if (isset($caches[0]) && is_array($caches[0])) {
                foreach ($caches as $cache) {
                    $this->create(
                        $cache["name"],
                        $cache["driver"],
                        $cache["dataType"],
                        array_get($cache, "lifetime"),
                        array_get($cache, "param", [])
                    );
                }
            } else {
                $this->create(
                    $caches["name"],
                    $caches["driver"],
                    $caches["dataType"],
                    array_get($caches, "lifetime"),
                    array_get($caches, "param", [])
                );
            }

        } else {
            if ($this->exists($name)) return false;

            $this->caches[$name] = new Cache($driver, $dataType, $lifetime, $parameter);
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