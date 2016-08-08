<?php
namespace CMS\Foundation\Mvc;

use CMS\Foundation\Module\Module;

class Controller extends \Phalcon\Mvc\Controller
{
    /**
     * @return Module
     */
    public function module()
    {
        return $this->module;
    }
}