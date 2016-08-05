<?php
namespace CMS\Foundation\Configuration\Frontend;

use CMS\Foundation\Configuration\Configuration;

class Kernel extends Configuration
{
    /**
     * @var string
     */
    public $db_host;

    /**
     * @var string
     */
    public $db_adapter;

    /**
     * @var string
     */
    public $db_port;

    /**
     * @var string
     */
    public $db_user;

    /**
     * @var string
     */
    public $db_password;

    /**
     * @var string
     */
    public $db_name;

    /**
     * @var array
     */
    public $cache;

    /**
     *
     */
    public function load()
    {
        parent::load();

        $db                = $this->config->get("db", []);
        $this->db_adapter  = array_get($db, "adapter");
        $this->db_host     = array_get($db, "host");
        $this->db_user     = array_get($db, "user");
        $this->db_password = array_get($db, "password");
        $this->db_name     = array_get($db, "name");
        $this->db_port     = array_get($db, "port");

        $this->cache = $this->config->get("cache");
    }


}