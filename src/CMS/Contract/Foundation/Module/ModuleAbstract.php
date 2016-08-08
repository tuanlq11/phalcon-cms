<?php
namespace CMS\Contract\Foundation\Module;

use CMS\Contract\Foundation\Configuration\ConfigurationManagerInterface;
use CMS\Foundation\Application;

abstract class ModuleAbstract implements ModuleInterface
{
    /** @var  Application */
    protected $application;

    /** @var  string */
    protected $basePath;

    /** @var  string */
    protected $appDir;

    /** @var  string */
    protected $prefixNamespace;

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