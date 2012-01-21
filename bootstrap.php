<?php

define( "BASEPATH" ,                  dirname(__FILE__));
define('DEV_MODE' ,                                   1);
$error_reporting = error_reporting(DEV_MODE ? E_ALL : 0);
ini_set('error_reporting', $error_reporting);

function __autoload($class_name) 
{
    $file = BASEPATH . '/lib/'.str_replace('_', DIRECTORY_SEPARATOR, $class_name).'.php';
    if ( ! file_exists($file))
    {
        return FALSE;
    }
    include $file;

}

include 'config.php';

$db = new MysqliDB($db_server, $db_user, $db_pass, $db_name);
$payout = new Payout($db, $payout_table);

?>