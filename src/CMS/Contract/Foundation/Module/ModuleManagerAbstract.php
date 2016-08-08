<?php
namespace CMS\Contract\Foundation\Module;

use CMS\Foundation\Configuration\Configuration;

abstract class ModuleManagerAbstract implements ModuleManagerInterface
{
    /** @var  string */
    protected $appPath;

    /** @var  array */
    protected $module;

    /** @var  Configuration */
    protected $config;
}