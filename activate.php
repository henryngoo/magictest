<?php
/**
 * Magic Test is a smaple test project, it used to check the code style and quality in PHP programming.
 *
 * @author Phuong Ngo <fuongit@gmail.com>
 * @copyright 2015 Magic Test
 * @version 1.0
 */

require(dirname(__FILE__) . '/include.php');
$app = new AppController();
$app->getActivate($_GET['token']);
?>