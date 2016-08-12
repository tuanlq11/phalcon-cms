<?php
namespace CMS\Helper;

class Str
{
    /**
     * @param $value
     *
     * @return mixed
     */
    public static function studly($value)
    {
        $value = ucwords(str_replace(['-', '_'], ' ', $value));

        return str_replace(' ', '', $value);
    }

    /**
     * @param int $length
     *
     * @return string
     */
    public static function random($length = 16)
    {
        $string = '';

        while (($len = strlen($string)) < $length) {
            $size = $length - $len;

            $bytes = static::randomBytes($size);

            $string .= substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
        }

        return $string;
    }

    /**
     * @param int $length
     *
     * @return string
     */
    public static function randomBytes($length = 16)
    {
        if (PHP_MAJOR_VERSION >= 7 || defined('RANDOM_COMPAT_READ_BUFFER')) {
            $bytes = random_bytes($length);
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $bytes = openssl_random_pseudo_bytes($length, $strong);

            if ($bytes === false || $strong === false) {
                throw new \RuntimeException('Unable to generate random string.');
            }
        } else {
            throw new \RuntimeException('OpenSSL extension or paragonie/random_compat is required for PHP 5 users.');
        }

        return $bytes;
    }
}