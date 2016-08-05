<?php
namespace CMS\Foundation\Session;

use CMS\Contract\Foundation\Session\SessionAbstract;

class Session extends SessionAbstract
{
    /**
     * Session constructor.
     *
     * @param bool  $adapter
     * @param bool  $name
     * @param array $option
     * @param bool  $autostart
     * @param bool  $enabled
     */
    public function __construct($adapter, $name, $option, $autostart = true, $enabled = true)
    {
        $this->adapter = new $adapter($option);
        $this->adapter->setName($name);
        $this->enabled   = $enabled;
        $this->autostart = $autostart;
    }

    /**
     * Handling session manager
     */
    public function handle()
    {
        if (!$this->enabled || !$this->autostart) return;

        $this->start();
    }


}