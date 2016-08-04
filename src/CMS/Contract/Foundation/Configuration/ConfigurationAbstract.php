<?php
namespace CMS\Contract\Foundation\Configuration;

use Phalcon\Config;

abstract class ConfigurationAbstract implements ConfigurationInterface
{
    /**
     * @var string
     */
    protected $basePath;

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
     * Get path to file config
     * @return string
     */
    public function getPath()
    {
        return $this->basePath . DIRECTORY_SEPARATOR . $this->file;
    }

    /**
     * Get name of me
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name for me
     * @param $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }


}