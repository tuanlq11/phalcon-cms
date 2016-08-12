<?php

class Auth
{
    public static function login($userName, $credential)
    {
        app()->session()->set("auth", true);
        app()->session()->set("credential", $credential);
    }

    public static function logout()
    {
        app()->session()->remove("auth");
    }
}