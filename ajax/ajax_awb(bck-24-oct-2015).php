<?php
include_once("../lib/config.php");

echo call_user_func($_POST['funtion']);

function awbNo()
{
	
	$awbNo= $_POST['awbNo'];
	$userId= $_POST['userId'];
	
	$sqlupdate=mysql_query("update purchase_detail set ship_traking='".$awbNo."', ship_status='1' where user_id='".$userId."'");
	if($sqlupdate)
	{
		return 2;
	}
	else 
	{
		return 3;
	}
	
	
}


?>
