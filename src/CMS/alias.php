<?php

use CMS\Helper\Arr;

/**
 * @param $key
 * @param $default
 *
 * @return string|mixed
 */
function env($key, $default)
{
    $value = getenv($key);

    if ($value === false) {
        return value($default);
    }

    switch (strtolower($value)) {
        case 'true':
        case '(true)':
            return true;

        case 'false':
        case '(false)':
            return false;

        case 'empty':
        case '(empty)':
            return '';

        case 'null':
        case '(null)':
            return null;
    }

    return $value;
}

/**
 * @return \CMS\Foundation\Application
 */
function &app()
{
    return \CMS\Foundation\Application::getInstance();
}

/**
 * @return \CMS\Foundation\Session\Session
 */
function session()
{
    return app()->session();
}

/**
 * @param      $array
 * @param      $key
 * @param null $default
 *
 * @return mixed
 */
function array_get($array, $key, $default = null)
{
    return Arr::get($array, $key, $default);
}

/**
 * @param      $key
 * @param null $placeholders
 * @param null $locale
 *
 * @return null|string
 */
function tran($key, $placeholders = null, $locale = null)
{
    return app()->translation()->_($key, $placeholders, $locale);
}

/**
 * @param $value
 *
 * @return mixed
 */
function value($value)
{
    return $value instanceof Closure ? $value() : $value;
}