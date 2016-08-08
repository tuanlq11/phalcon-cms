<?php
namespace CMS\Contract\Translation;

interface TranslationInterface
{
    const SOURCE_FILE     = 1;
    const SOURCE_DATABASE = 2;
    const SOURCE_HYBRID   = 3;

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
     * @return void
     */
    public function setSource();
}