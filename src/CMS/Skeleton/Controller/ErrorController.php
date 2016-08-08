<?php
namespace CMS\Skeleton\Controller;

use CMS\Foundation\Mvc\Controller;

class ErrorController extends Controller
{
    public function defaultAction($exception)
    {
        print_r($exception); exit;
        $this->view->setViewsDir(__DIR__ . "/../View");

    }
}