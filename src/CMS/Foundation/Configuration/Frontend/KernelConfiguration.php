<?php
namespace CMS\Foundation\Configuration\Frontend;

use CMS\Foundation\Configuration\Configuration;

class KernelConfiguration extends Configuration
{
    /**
     * @var string
     */
    public $db_adapter;

    /**
     * @var string
     */
    public $db_host;

    /**
     * @var string
     */
    public $db_port;

    /** @var
     * string
     */
    public $db_user;

    /** @var
     * string
     */
    public $db_password;

    /**
     * @var string
     */
    public $db_name;

    /**
     * @var string
     */
    public $app_dir;

    /**
     * @var string
     */
    public $cache;

    /**
     * Load config file
     */
    public function load()
    {
        parent::load();

        $db = $this->config->get("db", []);

        $this->db_adapter  = array_get($db, "adapter");
        $this->db_host     = array_get($db, "host");
        $this->db_port     = array_get($db, "port");
        $this->db_user     = array_get($db, "user");
        $this->db_password = array_get($db, "password");
        $this->db_name     = array_get($db, "name");

        $this->cache = $this->config->get("cache", []);

        $this->app_dir = $this->config->get("app_dir", "app");
    }

}
