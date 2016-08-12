<?php
namespace CMS\Plugin;

use CMS\Helper\Role;
use Phalcon\Dispatcher;
use Phalcon\Events\Event;
use Phalcon\Exception as PhalconException;

class Authenticate
{
    /**
     * @param $event      Event
     * @param $dispatcher Dispatcher
     *
     * @return bool
     */
    public function beforeExecuteRoute($event, $dispatcher)
    {
        if ($dispatcher->wasForwarded()) return true;

        $route   = app()->router()->getMatchedRoute();
        $session = app()->session();

        $config = [];
        if (property_exists($route, "config")) {
            $config = $route->config;
        }

        $credential = array_get($config, "credential");

        if (is_null($credential) || $credential === false) return true;

        /** Check credential require */
        if ((bool)$session->get("auth", false) === true && Role::check($session->get("credential", []), $credential)) {
            return true;
        } else {
            $dispatcher->forward([
                "namespace"  => "CMS\\Skeleton\\Controller",
                "controller" => "error",
                "action"     => "default",
                "params"     => ["exception" => new PhalconException("auth.permission.denied")],
            ]);

            return true;
        }
    }
}