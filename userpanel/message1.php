<?php 
include("header.php"); 
$res_reg=mysql_fetch_array(mysql_query("SELECT * FROM user_registration WHERE user_id='$userid'"));
$user_ids=$res_reg['user_id'];
$idd=$res_reg['username'];
$s="select user_id from user_registration where username='$idd'";
$r=mysql_query($s);
$f=mysql_fetch_array($r);
$id=$f['user_id'];
$send=mysql_query("select *from user_registration where user_id='$id'");
$res_send=mysql_fetch_array($send);
//exit;
$u_name=$_REQUEST['u_name'];
$subject=$_REQUEST['filed01'];
$msg=$_REQUEST['filed06']; 
$idd=$_REQUEST['user_id']; 
$date=date("Y-m-d");
$find=mysql_query("select *from user_registration where username='$u_name'");
$res=mysql_fetch_array($find);
$r_id=$res['user_id'];
if(mysql_num_rows($find)>0){
if($_FILES['attachfile']['name']!='')
{
	$arr_file=explode(".",$_FILES['attachfile']['name']);
	$ext=end($arr_file);
	$filename=$arr_file[0];
	$file_name=$filename."_".time().".".$ext;
	$main_file_name=$arr_file[0].".".$ext;
	move_uploaded_file($_FILES['attachfile']['tmp_name'],"attachfile/".$file_name); 
}
else 
{
	$file_name=$_POST['attachfile_name'];
}
$ins="insert into message(user_id,subject,message,reciever_id,sender_id,sender_name,reciever_name,msg_date,file_name) values ('$id','$subject','$msg','$r_id','$id','$res_send[username]','$u_name','$date','$file_name')";
$data=mysql_query($ins) or die("error");
$ins="insert into message_sender(user_id,subject,message,reciever_id,sender_id,sender_name,reciever_name,msg_date,file_name) values ('$id','$subject','$msg','$r_id','$id','$res_send[username]','$u_name','$date','$file_name')";
$data=mysql_query($ins) or die("error");
header("location:compose.php?msg=Message has been sent Successfully");
}
else
{
header("location:compose.php?msg=Username is not valid");
}
?>