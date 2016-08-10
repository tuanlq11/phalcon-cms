<?php
namespace CMS\Plugin;

use CMS\Foundation\Mvc\Dispatcher;
use Phalcon\Events\Event;

class Exception
{
    public function beforeException(Event $event, Dispatcher $dispatcher, $exception)
    {
        $dispatcher->forward([
            "namespace"  => "CMS\\Skeleton\\Controller",
            "controller" => "error",
            "action"     => "default",
            "params"     => ["exception" => $exception],
        ]);

        return false;
    }
}