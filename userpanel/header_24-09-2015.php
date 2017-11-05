<?php
error_reporting(0);
include("../lib/config.php");
include("../lib/my-funtion.php");
if(isset($_SESSION['userpanel_user_id']) && $_SESSION['userpanel_user_id'] != "")
{
	if(isset($_GET['id']))
	{
		$idd = $_GET['id'];
	}
	else
	{
	
	$idd = $_SESSION['userpanel_user_id'];
	}
	
	
	$sqlquer=mysql_query("select * from user_registration where (user_id='$idd' OR username='$idd')");
	if(mysql_num_rows($sqlquer)>0)
	{
		
	
	$f=mysql_fetch_array($sqlquer);
	$userid=$f['user_id'];
	}
	else
	{
		header("location:".$_SERVER['PHP_SELF']);
	}
	
	
	$ff=mysql_fetch_array(mysql_query("select * from user_registration where (user_id='$_SESSION[userpanel_user_id]' OR username='$idd')"));
	$userimage = $ff['image'];
	
	if($userimage !='' && file_exists('images/'.$userimage))
	{
		$userimage = 'images/'.$userimage;
	} 
	else
	{
		if($f['sex'] == 'male' || $f['sex'] == 'Male')
		{
			$userimage = "images/male.jpg";	
		}
		else if($f['sex'] == 'female' || $f['sex'] == 'Female')
		{
			$userimage = "images/female.jpg";		
		}
		else
		{
			$userimage = "images/male.jpg";	
		}
	}
	
	
	
	
}
else
{
	echo "<script language='javascript'>window.location.href='../logout.php';</script>";exit;
}
?>