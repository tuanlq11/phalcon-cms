<?php
namespace CMS\Contract\Foundation\Cache;

use Phalcon\Cache;
use Phalcon\Cache\Backend;

abstract class CacheAbstract implements CacheInterface
{

    /**
     * @var Cache\BackendInterface
     */
    protected $backend;

    /**
     * @var Cache\FrontendInterface
     */
    protected $frontend;


    public function driver()
    {
        return $this->backend;
    }
}