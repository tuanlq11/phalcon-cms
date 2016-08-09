<?php
namespace CMS\Contract\Foundation\Database;

use Phalcon\Db\Adapter\Pdo;
use Phalcon\Db\AdapterInterface;

interface DatabaseInterface
{
    const ADAPTER_POSTGRES = Pdo\Postgresql::class;
    const ADAPTER_MYSQL    = Pdo\Mysql::class;

    /**
     * DatabaseInterface constructor.
     *
     * @param $adapter
     * @param $host
     * @param $port
     * @param $user
     * @param $password
     * @param $dbname
     */
    public function __construct($adapter, $host, $port, $user, $password, $dbname);

    /**
     * @return AdapterInterface
     */
    public function adapter();
}