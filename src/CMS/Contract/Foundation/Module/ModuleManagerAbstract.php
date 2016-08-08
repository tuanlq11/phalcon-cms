<?php
namespace CMS\Contract\Foundation\Module;

use CMS\Foundation\Configuration\Configuration;
use CMS\Foundation\Module\Module;

abstract class ModuleManagerAbstract implements ModuleManagerInterface
{
    /** @var  string */
    protected $appPath;

    /** @var  Module[] */
    protected $module = [];

    /** @var array */
    protected $schema = [];

    /** @var  Configuration */
    protected $config;
}