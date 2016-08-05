<?php
namespace CMS\Foundation\Container;

use Closure;
use CMS\Contract\Foundation\Container\ContainerAbstract;

class Container extends ContainerAbstract
{
    /**
     * ContainerAbstract constructor.
     *
     * @param string  $name
     * @param Closure $content
     * @param bool    $shared
     */
    public function __construct($name, &$content, $shared)
    {
        if ($content instanceof Closure) {
            $this->content = $content;
        } else {
            $this->content = function () use (&$content) {
                return $content;
            };
        }
        $this->shared = $shared;
        $this->name   = $name;
    }

    /**
     * @return Closure
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return boolean
     */
    public function isBooted()
    {
        return $this->booted;
    }

    /**
     * @param boolean $booted
     */
    public function setBooted($booted)
    {
        $this->booted = $booted;
    }

    /**
     * @return boolean
     */
    public function isShared()
    {
        return $this->shared;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


}