<?php
namespace CMS\Contract\Foundation\Translation;

use CMS\Foundation\Application;
use Phalcon\Config;
use Phalcon\Translate\Adapter\NativeArray;

abstract class TranslationAbstract implements TranslationInterface
{
    protected $default_config = [
        "source"   => TranslationInterface::SOURCE_FILE,
        "prefix"   => "message_",
        "location" => "resource/message",
        "lifetime" => 300,
    ];

    /** @var bool */
    protected $loaded = false;

    /** @var  Application */
    protected $app;

    /** @var  string */
    protected $locale;

    /** @var array */
    protected $supported_language = [];

    /** @var int */
    protected $source = TranslationInterface::SOURCE_FILE;

    /** @var  Config */
    protected $config;

    /**
     * @var NativeArray[]
     */
    protected $message;

    /**
     * Get from cache
     *
     * @return NativeArray[]
     */
    protected function fromCache()
    {
    }

    /**
     * Store to cache
     *
     * @return void
     */
    protected function toCache()
    {
    }
}