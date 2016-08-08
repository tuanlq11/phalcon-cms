<?php
namespace CMS\Skeleton\Controller;

use CMS\Foundation\Mvc\Controller;

class ErrorController extends Controller
{
    public function defaultAction($exception)
    {
        $this->view->setViewsDir(__DIR__ . "/../View");
        $this->view->exception = $exception;
    }
}