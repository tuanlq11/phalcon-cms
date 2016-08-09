<?php
namespace CMS\Foundation\Module;

use CMS\Foundation\View\View;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Bootstrap implements ModuleDefinitionInterface
{
    public function registerAutoloaders(\Phalcon\DiInterface $di = null)
    {
        
    }

    public function registerServices(\Phalcon\DiInterface $di)
    {
        /** @var View $view */
        $view = $di->get("view");
        $view->setViewsDir(__DIR__ . DIRECTORY_SEPARATOR . "View");
    }

}