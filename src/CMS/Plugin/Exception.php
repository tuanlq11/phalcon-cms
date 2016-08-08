<?php
namespace CMS\Plugin;

use CMS\Foundation\Mvc\Dispatcher;
use Phalcon\Events\Event;

class Exception
{
    public function beforeException(Event $event, Dispatcher $dispatcher, $exception)
    {
        $dispatcher->forward([
            "module"     => app()::KERNEL_SKELETON,
            "controller" => "error",
            "action"     => "default",
        ]);

        return false;
    }
}