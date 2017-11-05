<?php
session_start();
include_once("../lib/config.php");
 
if(isset($_REQUEST["email_id"]))
{
  $email_id=$_REQUEST['email_id'];
}

 $select_data = mysql_query("select * from user_registration where email='".$email_id."'");
 $count_record = mysql_num_rows($select_data);
 
 if($count_record > 0)
 {
   echo 3;
 }
 else
 {
   echo 4;
 }
