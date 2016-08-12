<?php
namespace CMS\Foundation\View;

use Phalcon\Mvc\View\Engine\Php;
use Phalcon\Mvc\View\Engine\Volt;

class View extends \Phalcon\Mvc\View
{
    public function voltEngine()
    {
        $this->registerEngines([
            ".volt"  => "volt",
            ".phtml" => Php::class,
            ".php"   => Php::class,
        ]);
        /** Volt Service */
        $callback = function ($view, $di) {
            $volt = new Volt($view, $di);

            $volt->setOptions([
                "compiledPath"      => function ($templatePath, $option) {
                    $cachePath = app()->basePath() . DIRECTORY_SEPARATOR . "cache/View";
                    if (!is_dir($cachePath)) {
                        mkdir($cachePath, 0755, true);
                    }

                    return $cachePath . DIRECTORY_SEPARATOR . preg_replace('/(\/|\\\)/', "%", $templatePath) .
                    $option["compiledExtension"];
                },
                "compiledExtension" => ".compiled",
            ]);

            return $volt;
        };

        app()->bindService("volt", $callback, true);
    }
}