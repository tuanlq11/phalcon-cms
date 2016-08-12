<?php
namespace CMS\Foundation\Session\Adapter;
use CMS\Helper\Str;

/**
 * Class Redis
 *
 * @package CMS\Foundation\Session\Adapter
 */
class Redis extends \Phalcon\Session\Adapter\Redis
{
    /** @var \Phalcon\Cache\Backend\Redis */
    protected $_redis = null;

    /**
     * Redis constructor.
     *
     * @param array $options
     *
     */
    public function __construct(array $options = [])
    {
        if (!isset($options["host"])) {
            $options["host"] = "127.0.0.1";
        }

        if (!isset($options["port"])) {
            $options["port"] = 6379;
        }

        if (!isset($options["persistent"])) {
            $options["persistent"] = false;
        }

        $this->_lifetime = array_get($options, "lifetime", $this->_lifetime);

        session_set_save_handler(
            [$this, "open"],
            [$this, "close"],
            [$this, "read"],
            [$this, "write"],
            [$this, "destroy"],
            [$this, "gc"],
            [$this, "createId"]
        );

        parent::__construct($options);
    }


    /**
     * @param bool $deleteOldSession
     *
     * @return $this
     */
    public function regenerateId($deleteOldSession = true)
    {
        $oldSession = $this->read($this->getId());
        $this->_redis->delete($this->getId());

        setcookie($this->getName(), "", time() - 86400, "/");

        return $this;
    }

    /**
     * @return string
     */
    public function createId()
    {
        return sha1(uniqid('', true) . Str::random(25) . microtime(true));
    }
}