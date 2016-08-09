<?php
namespace CMS\Foundation\Mvc;

use CMS\Foundation\Module\Module;
use CMS\Foundation\Translation\Translation;

class Controller extends \Phalcon\Mvc\Controller
{
    /**
     * @return Module
     */
    public function module()
    {
        return $this->module;
    }

    /**
     * @return Translation
     */
    public function translation()
    {
        return $this->translation;
    }
}