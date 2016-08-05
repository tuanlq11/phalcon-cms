<?php
namespace CMS\Contract\Foundation\Container;

use Closure;

abstract class ContainerAbstract
{
    /** @var  Closure */
    protected $content;

    /**
     * @var bool
     */
    protected $booted = false;

    /**
     * @var bool
     */
    protected $shared = false;

    /**
     * @var string
     */
    protected $name;

}