<?php
namespace CMS\Contract\Foundation\Module;

abstract class ModuleManagerAbstract implements ModuleManagerInterface
{
    /** @var  string */
    protected $appPath;

    /** @var  array */
    protected $module;
}