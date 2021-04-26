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
 * Define autoload().
 *
 * @param string $class All files in classes
 *
 * @return "incluse $class " will include of all classes
 */
function autoload($class)
{
    $base_dir  = DIR_APP . DS;
    $class = $base_dir . 'Classes' . DS . str_replace('\\', DS, $class) . '.php';
    if (file_exists($class) && !is_dir($class) ) {
        include $class;
    }
}

spl_autoload_register('autoload');

?>
