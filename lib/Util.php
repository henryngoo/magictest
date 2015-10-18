<?php
/**
 * Magic Test is a smaple test project, it used to check the code style and quality in PHP programming.
 *
 * @author Phuong Ngo <fuongit@gmail.com>
 * @copyright 2015 Magic Test
 * @version 1.0
 */

class Util
{
    /**
     * quickRandom Generate a "random" alpha-numeric string.
     *
     * @param  int     $length
     * @return string
     */
    public static function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    /**
     * generateConfirmCode Generate a random code
     * 
     * @return string
     */
    public static function generateConfirmCode() {
        $randomHash = substr(md5(uniqid(rand(), true)), 16, 16);
        return $randomHash;
    }

    /**
     * random Generate a more truly "random" alpha-numeric string.
     *
     * @param  int     $length
     * @return string
     *
     * @throws RuntimeException
     */
    public static function random($length = 16)
    {
        if (function_exists('openssl_random_pseudo_bytes'))
        {
            $bytes = openssl_random_pseudo_bytes($length * 2);

            if ($bytes === false)
            {
                throw new RuntimeException('Cannot generate random string.');
            }

            return substr(str_replace(array('/', '+', '='), '', base64_encode($bytes)), 0, $length);
        }

        return static::quickRandom($length);
    }
}