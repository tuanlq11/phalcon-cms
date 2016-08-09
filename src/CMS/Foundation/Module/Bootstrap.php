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
        $reflectClass = new \ReflectionClass($this);

        /** @var View $view */
        $view = $di->get("view");
        $view->setViewsDir(rtrim(dirname($reflectClass->getFileName()), '\/') . DIRECTORY_SEPARATOR . "View");
    }

}