<?php
include_once("../lib/config.php");

if(isset($_REQUEST["userId"]) && !empty($_REQUEST["userId"]) && isset($_REQUEST["users"]) && !empty($_REQUEST["users"]))
{
  $username=$_REQUEST['userId'];
  $userss=$_REQUEST['users'];
}
 $select_data = mysql_query("select * from user_registration where username='".$username."' and ref_id='".$userss."'");
 $count_record = mysql_num_rows($select_data);
 
 if($count_record == 0)
 {
   echo "yes";
 }
 else
 {
   echo "no";
 }
