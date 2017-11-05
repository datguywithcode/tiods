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


function mtcn()
{

date_default_timezone_set("Asia/Amman");
$time = date("Y-m-d H:i:s");

	 $mtcn= $_POST['mtcn']; 
	 $userId= $_POST['userId'];

	$sqlupdate=mysql_query("update withdraw_request set mtcn='".$mtcn."', status='1',admin_response_date='".$time."' where user_id='".$userId."' and id='".$_POST['id']."'");
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
