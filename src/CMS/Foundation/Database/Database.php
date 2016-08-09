<?php
namespace CMS\Foundation\Database;

use CMS\Contract\Foundation\Database\DatabaseAbstract;
use Phalcon\Db\AdapterInterface;

class Database extends DatabaseAbstract
{
    /**
     * Database constructor.
     *
     * @param $adapter
     * @param $host
     * @param $port
     * @param $user
     * @param $password
     * @param $dbname
     */
    public function __construct($adapter, $host, $port, $user, $password, $dbname)
    {
        $this->adapter = new $adapter([
            "host"     => $host,
            "port"     => $port,
            "username" => $user,
            "password" => $password,
            "dbname"   => $dbname,
        ]);
    }

    /**
     * @return AdapterInterface
     */
    public function adapter()
    {
        return $this->adapter;
    }
}