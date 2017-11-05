<?php 
include('lib/config.php'); 

$sqlUser = mysql_query("select * from user_registration");

while ($getUser = mysql_fetch_assoc($sqlUser)) 
{
	
    $obj_func->marketerMoneyBox($getUser['user_id'],$getUser['mem_type']);
}


?>
