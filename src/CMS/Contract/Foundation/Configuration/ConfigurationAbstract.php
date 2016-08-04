<?php
namespace CMS\Contract\Foundation\Configuration;

use Phalcon\Config;

abstract class ConfigurationAbstract implements ConfigurationInterface
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * @var string
     */
    protected $file;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $driver;

    /**
     * Get name of me
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name for me
     *
     * @param $name
     *
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }


}