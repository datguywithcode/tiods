<?php

ob_start();

session_start();

error_reporting(E_ALL & ~E_NOTICE);

error_reporting(E_ERROR | E_WARNING | E_PARSE);

// define connection constant



//define hostname

define('HOSTNAME','localhost');

//define database username name

define('DB_USERNAME','kamlesh_lfi');

//define database password

define('DB_PASSWORD','Password@!@#$%');

//define database name

define('DB_DATABASE','kamlesh_lfi');



// define site url for include style and js etc.

define('SITE_URL','http://198.154.192.169/~kamlesh/lfi/');



// table prefix

define('TABLE_PREFIX','');



// define directory constant

define('PATH','');


// define directory constant
define('FRONTEND_PATH','admin/action_control/');
// include autoload file
define('ADMIN_PATH','action_control/');


include('autoload.inc.php');


?>