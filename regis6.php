<?php
include("lib/config.php");
$_SESSION['sponsorid']=$_POST['sponsorid'];
//check we have username post var
if(isset($_POST["sponsorid"]))
{
//check if its an ajax request, exit if not
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
die();
}   

//try connect to db
//trim and lowercase username
$sponsorid =  strtolower(trim($_POST["sponsorid"])); 
//sanitize username
$sponsorid = filter_var($sponsorid, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
//check username in db
$results = mysql_query("SELECT * FROM user_registration WHERE ((user_id='$sponsorid' or username='$sponsorid') and  user_status='0')");
//return total count
 @$username_exist = mysql_num_rows($results); //total records
 $row_ref=mysql_fetch_assoc($results);
 //if value is more than 0, username is not available
 if(!$username_exist)
     {
     echo "<font color='#FF0000'>"."  Sponsor Not Available !"."</font>";
     }
    else
    {
    echo "<font color='#009999'>".  $row_ref['username']." is your sponsor !</font>";
    }
   //close db connection
    }




















?>