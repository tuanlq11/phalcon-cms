<?php

class Auth
{
    /**
     * @param $userName
     * @param $credential
     */
    public static function login($userName, $credential)
    {
        app()->session()->set("auth", true);
        app()->session()->set("credential", $credential);
    }

    /**
     * Remove session
     */
    public static function logout()
    {
        app()->session()->remove("auth");
        app()->session()->regenerateId();
    }
}