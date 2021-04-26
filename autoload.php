<?php
// @codingStandardsIgnoreStart PEAR.Commenting.FileComment
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
