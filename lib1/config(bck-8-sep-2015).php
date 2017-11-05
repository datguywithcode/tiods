<?php
ob_start();
session_start();
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
@ini_set('display_errors','Off');
@ini_set('error_reporting',0);
define('HOSTNAME','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_DATABASE','kamlesh_fluker');
define('SITE_URL','http://localhost/aaron/');
define('EMAIL','kamlesh@maxtratechnologies.net');
define('TABLE_PREFIX','');
define('FRONTEND_PATH','admin/action_control/');
define('ADMIN_PATH','action_control/');
define('CURRENCY','R');
include('autoload.inc.php');
?>