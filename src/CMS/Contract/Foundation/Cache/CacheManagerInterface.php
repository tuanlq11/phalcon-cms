<?php
namespace CMS\Contract\Foundation\Cache;

interface CacheManagerInterface
{
    /**
     * @param  $name
     * @param  $driver
     * @param  $dataType
     * @param  $lifetime
     * @param  $parameter
     * @param  $callback \Closure
     *
     * @return mixed
     */
    public function create($name, $driver = null, $dataType = null, $lifetime = null, $parameter = null, $callback = null);

    /**
     * @param $cache
     * @param $name
     *
     * @return mixed
     */
    public function add($cache, $name);

    /**
     * @param $name
     *
     * @return boolean
     */
    public function exists($name);

    /**
     * @param $name
     *
     * @return mixed
     */
    public function get($name);

    /**
     * @param $name
     *
     * @return mixed
     */
    public function remove($name);
}