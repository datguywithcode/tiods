<?php
ob_start();
session_start();
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
@ini_set('display_errors','Off');
@ini_set('error_reporting',0);

if($_SERVER['HTTP_HOST']=='localhost')
{
define('HOSTNAME','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_DATABASE','tiods');
define('SITE_URL','localhost/tiods');
}
else
{
define('HOSTNAME','localhost');
define('DB_USERNAME','sandeep_tiods');
define('DB_PASSWORD','tiods@123');
define('DB_DATABASE','sandeep_tiods');
define('SITE_URL','http://198.154.241.136/~sandeep/tiods');
}
define('EMAIL','sandeep@maxtratechnologies.com');
define('TABLE_PREFIX','');
define('FRONTEND_PATH','admin/action_control/');
define('ADMIN_PATH','action_control/');
define('CURRENCY','USD');
define("Currency",'$');
include('autoload.inc.php');
?>