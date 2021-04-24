<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);

define("HOST", 'localhost');
define("BANCO", 'soft');
define("USUARIO", 'root');
define("SENHA", '');

define("DS", DIRECTORY_SEPARATOR);
define("DIR_APP", __DIR__);
define("DIR_PROJETO", 'api');

if (file_exists('autoload.php')){
    include 'autoload.php';
}else{ 
    die('falha ao carregar autoload!');
}

?>