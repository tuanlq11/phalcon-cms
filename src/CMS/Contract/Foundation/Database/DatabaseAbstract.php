<?php
namespace CMS\Contract\Foundation\Database;

use Phalcon\Db\AdapterInterface;

abstract class DatabaseAbstract implements DatabaseInterface
{
    /** @var  AdapterInterface */
    protected $adapter;

}