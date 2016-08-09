<?php
namespace CMS\Foundation\Translation;

use CMS\Contract\Translation\TranslationAbstract;
use CMS\Contract\Translation\TranslationInterface;
use CMS\Foundation\Application;

class Translation extends TranslationAbstract
{
    /** @var  Translation */
    protected static $instance;

    /**
     * Translation constructor.
     *
     * @param $app Application
     */
    public function __construct(&$app = null)
    {
        self::$instance = &$this;

        if (is_null($app)) {
            $this->app = &app();
        } else {
            $this->app = &$app;
        }

        $this->config = (array)$this->app->getConfigurations()->get(Application::PREFIX_APP_CONFIG)
            ->get("translation", $this->default_config);

        
    }

    /**
     * @param $app Application
     *
     * @return $this
     */
    public static function instance(&$app = null)
    {
        if (is_null(self::$instance)) {
            self::$instance = new Translation($app);
        }

        return self::$instance;
    }

    /**
     * @return mixed|string
     */
    public function locale()
    {
        if (is_null($this->locale)) {
            $request      = app()->factoryDefault()->get("request");
            $this->locale = app()->session()->get(static::SESSION_LOCALE_NAME, $request->getBestLanguage());
        }

        return $this->locale;
    }

    /**
     * @param $locale
     *
     * @return $this
     */
    public function setLocale($locale)
    {
        app()->session()->set(static::SESSION_LOCALE_NAME, $locale);
        $this->locale = $locale;

        return $this;
    }

    /**
     * @param int $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }


}