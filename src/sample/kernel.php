<?php
return [

    /** DATABASE CONFIG */
    "db"      => [
        "adapter"  => env("DB_ADAPTER", \Phalcon\Db\Adapter\Pdo\Postgresql::class),
        "host"     => env("DB_HOST", "127.0.0.1"),
        "port"     => env("DB_PORT", 5432),
        "user"     => env("DB_USER", "postgres"),
        "password" => env("DB_PASSWORD", ""),
        "name"     => env("DB_NAME", "postgres"),
    ],

    /** Cache Configuration */
    "cache"   => [
        "kernel" => [
            "driver"   => \CMS\Contract\Foundation\Cache\CacheInterface::DRIVER_REDIS,
            "dataType" => \CMS\Contract\Foundation\Cache\CacheInterface::DATA_TYPE_DATA,
            "lifetime" => 300,
            "param"    => [
                "host"   => "127.0.0.1",
                "port"   => 6379,
                "index"  => 0,
                "prefix" => "kernel",
            ],
        ],
    ],

    /** APP_DIR */
    "app_dir" => "app",

];