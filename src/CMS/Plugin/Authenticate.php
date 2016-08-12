<?php
namespace CMS\Plugin;

use Phalcon\Dispatcher;
use Phalcon\Events\Event;

class Authenticate
{
    /**
     * @param $event      Event
     * @param $dispatcher Dispatcher
     */
    public function beforeExecuteRoute($event, $dispatcher)
    {
        $moduleConfig = $dispatcher->getDI()->get("module");
    }
}