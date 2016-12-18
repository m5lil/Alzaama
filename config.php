<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


// setting output buffer
ob_start();
//
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);

ini_set('register_globals', 0);
ini_set('log_errors', 'on');


// Shortcuts
define("DS", DIRECTORY_SEPARATOR);
define("PS", PATH_SEPARATOR);

// Path
define('APP_PATH', realpath(dirname(__FILE__)) . DS );
define('HOST_NAME', 'http://' . $_SERVER['HTTP_HOST'] . '/');
define('CSS_PATH', HOST_NAME . 'css' . '/');
define('CSS_DIR', APP_PATH . 'css' . DS );
define('JS_PATH', HOST_NAME . 'js' . '/');
define('JS_DIR', APP_PATH . 'js' . DS );
define('TEMPLATE_PATH', APP_PATH . '_template' . DS);
define('ADMIN_TEMPLATE_PATH', APP_PATH . '_template' . DS . 'admin' . DS);
define('LIB_PATH', APP_PATH . '_lib' . DS);
define('MODEL_PATH', APP_PATH . '_model' . DS);
define('IMG_PATH', APP_PATH . 'img' . DS);
define('IMG_HOST', HOST_NAME . 'img' . '/');
define('VIEWS_PATH', APP_PATH . '_views' . DS);
define('ADMIN_VIEWS_PATH', APP_PATH . '_views' . DS . 'admin' . DS);
define('SAULT', 'mykey');

//DataBase
define('DB_HOST', 'localhost');
define('DB_NAME', 'alzama_db');
define('DB_USER', 'alzama_db');
define('DB_PASS', '123qweasdzxc');
date_default_timezone_set('UTC'); 
$path = get_include_path(). PS . MODEL_PATH . PS . LIB_PATH;
set_include_path($path);

function myautoload($class){ //or __autoload($class) without spl
    require_once strtolower($class). '.class.php';
}

spl_autoload_register('myautoload');  // don't use if __autoload($class)

$dbh = DB::getinstance();

session_start();

ob_flush();

