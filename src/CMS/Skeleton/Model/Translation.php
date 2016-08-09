<?php
namespace CMS\Skeleton\Model;

use Phalcon\Mvc\Model;

class Translation extends Model
{
    public $id;
    public $key;
    public $message;
    public $locale;

    public function initialize()
    {
        $this->setSource("translation");
    }

    /**
     * @param null $lifetime
     *
     * @return array
     */
    public static function message($lifetime = null)
    {
        $params = [];

        if (!is_null($lifetime) && $lifetime > 0) {
            $params["cache"] = ["key" => "translation_query_cached", "lifetime" => $lifetime];
        }

        $language = self::find($params);

        return $language->toArray();
    }
}