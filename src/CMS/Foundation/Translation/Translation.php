<?php
namespace CMS\Foundation\Translation;

use CMS\Contract\Translation\TranslationAbstract;

class Translation extends TranslationAbstract
{
    /**
     * @return mixed|string
     */
    public function locale()
    {
        if (is_null($this->locale)) {
            $request      = app()->factoryDefault()->get("request");
            $this->locale = app()->session()->get("locale", $request->getBestLanguage());
        }

        return $this->locale;
    }

}