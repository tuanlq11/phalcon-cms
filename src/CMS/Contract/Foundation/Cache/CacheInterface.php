<?php
namespace CMS\Contract\Foundation\Cache;

use Phalcon\Cache;
use Phalcon\Cache\Backend;

interface CacheInterface
{
    const DRIVER_REDIS        = Cache\Backend\Redis::class;
    const DRIVER_MEMCACHE     = Cache\Backend\Memcache::class;
    const DRIVER_MEMORY       = Cache\Backend\Memory::class;
    const DRIVER_LIBMEMCACHED = Cache\Backend\Libmemcached::class;
    const DRIVER_APC          = Cache\Backend\Apc::class;
    const DRIVER_FILE         = Cache\Backend\File::class;

    const DATA_TYPE_DATA     = Cache\Frontend\Data::class;
    const DATA_TYPE_JSON     = Cache\Frontend\Json::class;
    const DATA_TYPE_BASE64   = Cache\Frontend\Base64::class;
    const DATA_TYPE_IGBINARY = Cache\Frontend\Igbinary::class;
    const DATA_TYPE_MSGPACK  = Cache\Frontend\Msgpack::class;

    /**
     * CacheInterface constructor.
     *
     * @param $driver
     * @param $dataType
     * @param $parameter
     * @param $lifetime
     */
    public function __construct($driver, $dataType, $lifetime, $parameter);

    /**
     * @return Backend
     */
    public function driver();
}