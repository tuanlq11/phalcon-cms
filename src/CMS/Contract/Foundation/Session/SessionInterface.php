<?php
namespace CMS\Contract\Foundation\Session;

use Phalcon\Session\Adapter;

interface SessionInterface
{

    const ADAPTER_REDIS        = Adapter\Redis::class;
    const ADAPTER_FILE         = Adapter\Files::class;
    const ADAPTER_MEMCACHE     = Adapter\Memcache::class;
    const ADAPTER_LIBMEMCACHED = Adapter\Libmemcached::class;

    /**
     * Session Interface constructor.
     *
     * @param $adapter   boolean
     * @param $name      boolean
     * @param $autostart boolean
     * @param $enabled   boolean
     * @param $option    array
     */
    public function __construct($adapter, $name, $option, $autostart = true, $enabled = true);

    /**
     * @return mixed
     */
    public function start();

    /**
     * @param $index
     * @param $defaultValue
     *
     * @return mixed
     */
    public function get($index, $defaultValue);

    /**
     * @param $index
     * @param $value
     *
     * @return mixed
     */
    public function set($index, $value);

    /**
     * @param $index
     *
     * @return mixed
     */
    public function has($index);

    /**
     * @param $index
     *
     * @return mixed
     */
    public function remove($index);

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @param bool $deleteOldSession
     *
     * @return mixed
     */
    public function regenerateId($deleteOldSession = true);

    /**
     * Set session name
     */
    public function setName($name);

    /**
     * Get session name
     */
    public function getName();

    /**
     * @return mixed
     */
    public function handle();
}