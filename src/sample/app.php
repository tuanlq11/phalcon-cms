<?php
return [

    "session" => [
        "name"      => "cms",
        "adapter"   => \CMS\Contract\Foundation\Session\SessionInterface::ADAPTER_REDIS,
        "option"    => [
            "host"  => "127.0.0.1",
            "port"  => 6379,
            "index" => 5,
        ],
        "autostart" => true,
        "enabled"   => true,
    ],

];