<?php
namespace CMS\Foundation\Cache;

use CMS\Contract\Foundation\Cache\CacheAbstract;

class Cache extends CacheAbstract
{

    /**
     * Cache constructor.
     *
     * @param $driver    string
     * @param $dataType  string
     * @param $lifetime  int
     * @param $parameter array
     */
    public function __construct($driver, $dataType, $lifetime, $parameter)
    {
        $this->frontend = new $dataType([
            "lifetime" => $lifetime,
        ]);

        $this->backend = new $driver($this->frontend, $parameter);
    }

    /**
     * @param      $keyName
     * @param null $lifetime
     *
     * @return mixed|null
     */
    public function get($keyName, $lifetime = null)
    {
        return $this->driver()->get($keyName, $lifetime);
    }

    /**
     * @param $keyName
     *
     * @return void
     */
    public function delete($keyName)
    {
        $this->driver()->delete($keyName);
    }

    /**
     * @param      $keyName
     * @param      $content
     * @param null $lifetime
     * @param bool $stopBuffer
     *
     * @return bool
     */
    public function save($keyName, $content, $lifetime = null, $stopBuffer = true)
    {
        return $this->driver()->save($keyName, $content, $lifetime, $stopBuffer);
    }

    /**
     * @param      $keyName
     * @param null $lifetime
     *
     * @return bool
     */
    public function exists($keyName, $lifetime = null)
    {
        return $this->driver()->exists($keyName, $lifetime);
    }


}