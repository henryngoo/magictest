<?php
/**
 * Magic Test is a smaple test project, it used to check the code style and quality in PHP programming.
 *
 * @author Phuong Ngo <fuongit@gmail.com>
 * @copyright 2015 Magic Test
 * @version 1.0
 */

class Guard
{
    /**
     * __construct
     */
    public function __construct()
    {

    }

    /**
     * csrf_token Generate a csrf_token or get existing token from Session
     * 
     * @return string
     */
    public static function csrf_token()
    {
        if (isset($_SESSION['_token'])) {
            return $_SESSION['_token'];
        } else {
            $token = Util::random(40);
            $_SESSION['_token'] = $token;
            return $token;
        }
    }

    /**
     * getToken Get token from Session
     *
     * @return string
     * 
     * @throws RuntimeException
     */
    public static function getToken()
    {
        if (isset($_SESSION['_token'])) {
            return $_SESSION['_token'];
        } else {
            throw new RuntimeException('Session store not set');
        }
    }

    /**
     * csrfFilter Prevent CSRF data from post request
     *
     * @return string
     * 
     * @throws RuntimeException
     */
    public static function csrfFilter($method) {
        if (strtolower($_SERVER['REQUEST_METHOD']) === $method) {
            $post = $_POST;
            $get = $_GET;
            if (static::getToken() != ${$method}['csrf_token'] && static::getToken() != ${$method}['_token']) {
                throw new Exception("Error Processing Request", 1);
            }
        }
    }
}