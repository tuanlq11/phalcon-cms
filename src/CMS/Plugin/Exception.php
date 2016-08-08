<?php
namespace CMS\Plugin;

use CMS\Foundation\Mvc\Dispatcher;
use CMS\Skeleton\Controller\ErrorController;
use Phalcon\Events\Event;

class Exception
{
    public function beforeException(Event $event, Dispatcher $dispatcher, $exception)
    {
        $dispatcher->forward([
            "namespace"  => "CMS\Skeleton\Controller",
            "controller" => "error",
            "action"     => "default",
        ]);

        return false;
    }
}