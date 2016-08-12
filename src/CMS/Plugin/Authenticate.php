<?php
namespace CMS\Plugin;

use CMS\Helper\Role;
use Phalcon\Dispatcher;
use Phalcon\Events\Event;
use Phalcon\Mvc\Router\Route;

class Authenticate
{
    /**
     * @param $event
     * @param $dispatcher
     *
     * @return bool
     */
    public function beforeExecuteRoute($event, $dispatcher)
    {
        $route   = app()->router()->getMatchedRoute();
        $session = app()->session();

        $config = [];
        if (property_exists($route, "config")) {
            $config = $route->config;
        }

        $credential = array_get($config, "credential");

        /** Check credential require */
        if (is_null($credential)) return true;

        /** Check session login */
        if (!$session->get("auth", false)) return false;

        return !Role::check($session->get("credential", []), $credential);
    }
}