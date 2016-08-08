<?php
namespace CMS\Contract\Translation;

use Phalcon\Translate\Adapter\NativeArray;

abstract class TranslationAbstract implements TranslationInterface
{
    /** @var  string */
    protected $locale;
}