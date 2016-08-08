<?php
namespace CMS\Foundation\Configuration;

use CMS\Contract\Foundation\Configuration\ConfigurationInterface;
use CMS\Contract\Foundation\Configuration\ConfigurationManagerAbstract as ConfigurationManagerAbstract;
use CMS\Foundation\Mvc\Application;

class ConfigurationManager extends ConfigurationManagerAbstract
{
    /**
     * ConfigurationManager constructor.
     *
     */
    public function __construct()
    {
        $this->basePath = app()->basePath();
    }


    /**
     * Create and Add configuration entity
     *
     * @param string $name
     * @param string $file
     * @param string $driver
     * @param bool   $lifetime
     * @param string $class
     *
     * @return bool|Configuration|mixed|void
     */
    public function create($name, $file = null, $driver = null, $lifetime = null, $class = Configuration::class)
    {
        /** Create multiple configuration  */
        if (is_array($name)) {
            $configurations = $name;
            /** Array two level */
            if (isset($configurations[0]) && is_array($configurations[0])) {
                foreach ($configurations as $configuration) {
                    $this->create(
                        $configuration["name"],
                        $configuration["file"],
                        $configuration["driver"],
                        array_get($configuration, "lifetime"),
                        array_get($configuration, "class", Configuration::class)
                    );
                }
            } else {
                $this->create(
                    $configurations["name"],
                    $configurations["file"],
                    $configurations["driver"],
                    array_get($configurations, "lifetime"),
                    array_get($configurations, "class", Configuration::class)
                );
            }

            return true;

        } else {
            if ($this->exists($name)) return false;

            if ($lifetime && app()->environment() == app()::ENV_PROD) {
                if ($this->is_cached($name)) {
                    /** @var ConfigurationInterface $configuration */
                    $configuration = $this->get_cached($name, $lifetime);
                } else {
                    /** @var ConfigurationInterface $configuration */
                    $configuration = new $class($this->path($file), $name, $driver, $lifetime);
                    $configuration->load();

                    $this->save($name, $configuration, $lifetime);
                }
            } else {
                /** @var ConfigurationInterface $configuration */
                $configuration = new $class($this->path($file), $name, $driver, $lifetime);
                $configuration->load();
            }

            $this->configurations[$name] = $configuration;

            return $configuration;
        }
    }

    /**
     * Add configuration to collector
     *
     * @param      $configuration Configuration
     * @param null $name
     * @param      $lifetime      int|null
     *
     * @return void
     */
    public function add($configuration, $lifetime = null, $name = null)
    {
        if ($name) $configuration->setName($name);
        $name = $configuration->getName();

        if ($this->exists($name)) return;

        if ($lifetime) {
            $this->save($name, $configuration, $lifetime);
        }

        $this->configurations[$name] = $configuration;
    }

    /**
     * @param      $name
     * @param null $default
     *
     * @return Configuration
     */
    public function get($name, $default = null)
    {
        if (isset($this->configurations[$name])) return $this->configurations[$name];

        return $default;
    }
}
