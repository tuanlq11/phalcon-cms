<?php
namespace CMS\Contract\Foundation\Session;

use Phalcon\Session\AdapterInterface;

abstract class SessionAbstract implements SessionInterface
{
    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @var boolean
     */
    protected $autostart;

    /**
     * @var boolean
     */
    protected $enabled;

    /**
     * Start handle session
     */
    public function start()
    {
        $this->adapter->start();
    }

    /**
     * @param $index
     * @param $defaultValue
     *
     * @return mixed
     */
    public function get($index, $defaultValue)
    {
        return $this->adapter->get($index, $defaultValue);
    }

    /**
     * @param $index
     * @param $value
     *
     * @return void
     */
    public function set($index, $value)
    {
        $this->adapter->set($index, $value);
    }

    /**
     * @param $index
     *
     * @return bool
     */
    public function has($index)
    {
        return $this->adapter->has($index);
    }

    /**
     * @param $index
     *
     * @return void
     */
    public function remove($index)
    {
        $this->adapter->remove($index);
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->adapter->getId();
    }

    /**
     * @param bool $deleteOldSession
     *
     * @return void
     */
    public function regenerateId($deleteOldSession = true)
    {
        session_save_path(".");
        $this->adapter->regenerateId($deleteOldSession);
    }

    /**
     * @param bool $removeData
     *
     * @return bool
     */
    public function destroy($removeData = false)
    {
        return $this->adapter->destroy($removeData);
    }

    /**
     * @param $name
     *
     * @return void
     */
    public function setName($name)
    {
        $this->adapter->setName($name);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->adapter->getName();
    }
}