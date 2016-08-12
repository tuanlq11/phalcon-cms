<?php

return [

    "session" => [
        "name"      => "cms",
        "adapter"   => CMS\Contract\Foundation\Session\SessionInterface::ADAPTER_REDIS,
        "option"    => [
            "host"  => "127.0.0.1",
            "port"  => 6379,
            "index" => 5,
        ],
        "autostart" => true,
        "enabled"   => true,
    ],

    "exception" => CMS\Plugin\Exception::class,

    "translation" => [
        "source"   => CMS\Contract\Foundation\Translation\TranslationInterface::SOURCE_FILE,
        "prefix"   => "message_",
        "location" => "resource/Message",
        "lifetime" => 300,
    ],

    "timezone" => "UTC",

    "dispatcher" => [
        "event" => [
            [
                "className" => CMS\Plugin\Exception::class,
                "eventType" => \CMS\Contract\Foundation\ApplicationInterface::EVENT_BEFORE_EXCEPTION,
                "priority"  => 1001,
            ],
            [
                "className" => CMS\Plugin\Authenticate::class,
                "eventType" => \CMS\Contract\Foundation\ApplicationInterface::EVENT_BEFORE_EXECUTE_ROUTE,
                "priority"  => 1000,
            ],
        ],
    ],
];