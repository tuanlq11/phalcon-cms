<?php
namespace CMS\Contract\Foundation\Translation;

use CMS\Foundation\Application;

interface TranslationInterface
{
    const SOURCE_FILE     = 1;
    const SOURCE_DATABASE = 2;
    const SOURCE_HYBRID   = 3;

    const SESSION_LOCALE_NAME = "locale";
    const DEFAULT_LOCALE      = "en-US";

    /**
     * @param $app Application
     *
     * @return $this
     */
    public static function instance(&$app = null);

    /**
     * TranslationInterface constructor.
     *
     * @param $app Application
     */
    public function __construct(&$app = null);

    /**
     * @return string
     */
    public function locale();

    /**
     * @param $locale
     *
     * @return void
     */
    public function setLocale($locale);

    /**
     * @param $source int
     *
     * @return void
     */
    public function setSource($source);
}