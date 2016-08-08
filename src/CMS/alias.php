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
 * @param $value
 *
 * @return mixed
 */
function value($value)
{
    return $value instanceof Closure ? $value() : $value;
}