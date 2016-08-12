<?php
namespace CMS\Foundation\Session\Adapter;

class Redis extends \Phalcon\Session\Adapter\Redis
{
    /**
     * @param bool $deleteOldSession
     *
     * @return $this
     */
    public function regenerateId($deleteOldSession = true)
    {
        $this->_redis->delete($this->getId());
        setcookie($this->getName(), "", time() - 86400, "/");

        return $this;
    }

}