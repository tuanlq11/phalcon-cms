<?php
namespace CMS\Contract\Foundation\Module;

use CMS\Contract\Foundation\ApplicationInterface;
use CMS\Contract\Foundation\Configuration\ConfigurationManagerInterface;

abstract class ModuleAbstract implements ModuleInterface
{
    /** @var  ApplicationInterface */
    protected $application;

    /** @var  string */
    protected $appPath;

    /** @var  string */
    protected $modulePath;

    /** @var  string */
    protected $moduleConfigPath;

    /** @var  ConfigurationManagerInterface */
    protected $configuration;

    /** @var array */
    protected $controller = [];

    /** @var array [] */
    protected $model = [];

    /** @var  string */
    protected $name;

    /** @var  string */
    protected $alias;

    /** @var  string */
    protected $configurationPrefix;

    /** @var  string */
    protected $cachePrefix;

    /** @var int|null */
    protected $moduleConfigLifetime;

    /**
     * Module Attribute
     *
     * @var $attr array
     */
    protected $attr = [];

    /** @var array */
    protected $structure = [
        "Config", "Controller", "Model", "View",
    ];

}