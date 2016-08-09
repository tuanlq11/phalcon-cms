<?php
namespace CMS\Foundation\Translation;

use CMS\Contract\Foundation\Translation\TranslationAbstract;
use CMS\Contract\Foundation\Configuration\ConfigurationAbstract;
use CMS\Foundation\Application;
use CMS\Foundation\Configuration\Configuration;
use Phalcon\Translate\Adapter\NativeArray;

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

        $this->lifetime = array_get($this->config, "lifetime", null);
    }

    /**
     * @return void
     */
    public function load()
    {
        if ($this->loaded) return;

        if (is_null(($cached = $this->fromCache()))) {

            switch ($this->config["source"]) {
                case static::SOURCE_FILE:
                    $location = $this->app->basePath() . DIRECTORY_SEPARATOR . $this->config["location"];
                    if (!is_dir($location)) break;

                    foreach (scandir($location) as $file) {
                        if ($file == "." || $file == "..") continue;
                        $separate = explode(".", $file);
                        if (!isset(ConfigurationAbstract::$EXTENSION_DRIVER[$separate[1]])) continue;

                        $name   = $separate[0];
                        $file   = $location . DIRECTORY_SEPARATOR . $file;
                        $driver = ConfigurationAbstract::$EXTENSION_DRIVER[$separate[1]];

                        $config                 = (new Configuration($file, $name, $driver))->load();
                        $locale                 = substr($name, strlen($this->config["prefix"]));
                        $this->message[$locale] = new NativeArray(["content" => $config->toArray()]);
                    }

                    break;
                case static::SOURCE_DATABASE:
                    break;
                case static::SOURCE_HYBRID;
                    break;
            }

            /** Store to cache */
            $this->toCache();
        } else {
            $this->message = $cached;
        }

        $this->loaded = true;
    }

    /**
     * Get from cache
     *
     * @return NativeArray[]
     */
    protected function fromCache()
    {
        $key = "translation_{$this->source}";
        if (app()->environment() == Application::ENV_PROD && app()->cache_default()->exists($key)) {
            return app()->cache_default()->get($key);
        }

        return null;
    }

    /**
     * Store to cache
     *
     * @return void
     */
    protected function toCache()
    {
        $key = "translation_{$this->source}";

        if ($this->lifetime && $this->lifetime > 0)
            app()->cache_default()->save($key, $this->message, $this->lifetime);
    }

    /**
     * @param string $key
     * @param null   $locale
     * @param array  $placeholders
     *
     * @return string|null
     */
    public function _($key, $placeholders = null, $locale = null)
    {
        $this->load();
        $locale = is_null($locale) ? $this->locale() : $locale;

        if (isset($this->message[$locale])) {
            return $this->message[$locale]->_($key, $placeholders);
        }

        return null;
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