<?php
/**
 * Magic Test is a smaple test project, it used to check the code style and quality in PHP programming.
 *
 * @author Phuong Ngo <fuongit@gmail.com>
 * @copyright 2015 Magic Test
 * @version 1.0
 */

define ('DS', DIRECTORY_SEPARATOR);
define ('HOME', dirname(__FILE__));

// Create start session function if not existed
if (!function_exists('magic_start_session')) {
    function magic_start_session() {
        if (empty(session_id())) {
            session_start();
        }
    }
}

// Create csrf function if not existed
if (!function_exists('csrf_token')) {
    function csrf_token() {
        return Guard::csrf_token();
    }
}

// Create csrf function if not existed
if (!function_exists('redirect')) {
    function redirect($url) {
        header("Location: $url");
        die();
    }
}

// Start session
magic_start_session();

// Requires magic libraries
require(dirname(__FILE__) . '/config.php');
require(dirname(__FILE__) . '/lib/DatabaseConnect.php');
require(dirname(__FILE__) . '/lib/Util.php');
require(dirname(__FILE__) . '/lib/Validator.php');
require(dirname(__FILE__) . '/lib/Guard.php');
require(dirname(__FILE__) . '/lib/User.php');
require(dirname(__FILE__) . '/lib/AppController.php');
require(dirname(__FILE__) . '/lib/View.php');
require(dirname(__FILE__) . '/lib/Mail.php');

?>