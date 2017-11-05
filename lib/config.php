<?php
ob_start();
error_reporting(0);
session_start();

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
define('DB_USERNAME','tiods_tiods');
define('DB_PASSWORD','tiods@123');
define('DB_DATABASE','tiods_tiods');
define('SITE_URL','http://198.154.241.136/tiods');
}

define('EMAIL','sandeep@maxtratechnologies.com');
define('TABLE_PREFIX','');
define('FRONTEND_PATH','admin/action_control/');
define('ADMIN_PATH','cmsadmin/');
define('CURRENCY','USD');
define("Currency",'$');

include('autoload.inc.php');
?>