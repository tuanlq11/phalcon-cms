<?php
namespace CMS\Foundation\Cache;

use CMS\Contract\Foundation\Cache\CacheAbstract;

class Cache extends CacheAbstract
{

    /**
     * Cache constructor.
     * @param $driver string
     * @param $dataType string
     * @param $lifetime int
     * @param $parameter array
     */
    public function __construct($driver, $dataType, $lifetime, $parameter)
    {
        $this->frontend = new $dataType([
            "lifetime" => $lifetime,
        ]);

        $this->backend = new $driver($this->frontend, $parameter);
    }
}