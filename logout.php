<?php
ob_start();
include("lib/config.php");
//$user_id=$_SESSION['user_id'];
$user_id=$_SESSION['userpanel_user_id'];



date_default_timezone_set("Asia/Amman");
$time = date("Y-m-d H:i:s");



mysql_query("update user_registration set last_login_date='".$time."',current_login_status='Logout' where user_id='$user_id'");
unset($_SESSION['userpanel_user_id']);
unset($_SESSION['SD_User_Name']);
//session_destroy();
$msg1234="logout";
header("Location:login.php?msg=".$msg1234);
//header("location:index.php");
?>