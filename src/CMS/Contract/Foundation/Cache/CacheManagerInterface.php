<?php
namespace CMS\Contract\Foundation\Cache;

interface CacheManagerInterface
{
    /**
     * @param $name
     * @param $driver
     * @param $dataType
     * @param $lifetime
     * @param $parameter
     *
     * @return mixed
     */
    public function create($name, $driver, $dataType, $lifetime, $parameter);

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