<?php
/**
 * PHP version 7.4
 * Autoload
 * Auto load all classes
 *
 * @category AutoLoad
 * @package  Initial
 * @author   Luis Roberto <lrs.juca@gmail.com>
 * @license  Open Source https://opensource.org/docs/osd
 * @link     https://github.com/Xeubaka/api_vinhos/
 */

/**
 * Define ini_set().
 *
 * @return
 */
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ERROR);

define("HOST", 'localhost');
define("DATA_BASE", 'soft');
define("USER", 'root');
define("PASSWORD", '');

define("DS", DIRECTORY_SEPARATOR);
define("DIR_APP", __DIR__);
define("DIR_PROJECT", 'api_vinhos');

if (file_exists('autoload.php')) {
    include 'autoload.php';
} else {
    die('Fail to autoload!');
}

?>
