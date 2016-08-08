<?php
namespace CMS\Foundation\Router;

use CMS\Foundation\Module\ModuleManager;
use CMS\Helper\Str;

class Router extends \Phalcon\Mvc\Router
{
    /** @var  bool */
    protected $handled = false;
    /** @var  ModuleManager */
    protected $module;

    /**
     * Router constructor.
     *
     * @param bool           $defaultRoutes
     * @param  ModuleManager $module
     */
    public function __construct(&$module, $defaultRoutes = true)
    {
        $this->module = &$module;
        parent::__construct($defaultRoutes);
    }


    /**
     * @param null $uri
     */
    public function handle($uri = null)
    {
        if (!$this->handled) {
            $realUri = empty($uri) ? $this->getRewriteUri() : $uri;

            if ($this->_removeExtraSlashes && $realUri != "/") {
                $handledUri = rtrim($realUri, "/");
            } else {
                $handledUri = $realUri;
            }

            $separated = explode("/", $handledUri);

            /** Dynamic load module by uri */
            if (count($separated) > 2) {
                $moduleName = Str::studly($separated[1]);
                if (isset($this->module[$moduleName])) {
                    $module       = $this->module[$moduleName];
                    $routerConfig = $module->configuration()->get("router", []);

                    foreach ($routerConfig->toArray() as $route) {
                        $this->add($route["pattern"], [
                            "module"     => $module->name(),
                            "namespace"  => array_get($route, "namespace", $module->nsController()),
                            "action"     => $route["action"],
                            "controller" => $route["controller"],
                        ], (array)$route["method"]);
                    }
                }
            }

            $this->handled = true;
            $this->handle($uri);
        } else {
            parent::handle($uri);
        }
    }

}