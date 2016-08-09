<?php
namespace CMS\Contract\Translation;

use CMS\Foundation\Application;
use CMS\Foundation\Configuration\ConfigurationManager;
use Phalcon\Config;

abstract class TranslationAbstract implements TranslationInterface
{
    protected $default_config = [
        "source"   => TranslationInterface::SOURCE_FILE,
        "prefix"   => "message_",
        "location" => "resource/message",
    ];

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
     * @var ConfigurationManager
     */
    protected $message;
}