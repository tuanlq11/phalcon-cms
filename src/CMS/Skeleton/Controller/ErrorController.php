<?php
namespace CMS\Skeleton\Controller;

use CMS\Foundation\Mvc\Controller;

class ErrorController extends Controller
{
    /**
     * @param $exception \Exception
     */
    public function defaultAction($exception)
    {
        $this->view->setViewsDir(__DIR__ . "/../View");
        $this->view->message = $exception->getMessage();
        $this->view->code    = $exception->getCode();
        $this->view->file    = $exception->getFile();
        $this->view->line    = $exception->getLine();
        $this->view->trace   = $exception->getTrace();
    }
}