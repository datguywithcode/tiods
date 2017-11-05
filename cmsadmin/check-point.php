<?php
// define path constant for include file
session_start();
// include main file
include('../lib/config.php'); 

// check point for login user and logout user
if( isset($_POST['username']) && isset($_POST['password']) && isset($_POST['action']) && isset($_POST['token']) ){

	if( !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['action']) && !empty($_POST['token']) ){
		// check token no and hit url
		if( $_POST['token'] == $_SESSION['rand_no'] && $_SESSION['page_url'] == $_SERVER['HTTP_REFERER'] ){
			
			// check user credential
			$username = mysql_real_escape_string($_POST['username']);
			$password = mysql_real_escape_string($_POST['password']);
			
$password1= hash("sha256",$password);
//echo $username; print_r("<br/>");echo $password;print_r("<br/>");echo $password1;exit();
			$condition = " username ='".$username."' and password ='".$password1."'";
			 $sql= $obj_rep->query('*', 'admin', $condition);
			 
			 $args_user=$obj_rep->get_all_row($sql);
			 
			if($args_user['username']){
				
				// check password
				if( $password1 == $args_user['password']){
					
					unset($_SESSION['salt']);
					unset($_SESSION['rand_no']);
					
					// check admin account status
					if( $args_user['stutus'] == 0 ){
						// update login of user
						$condition = " username ='".$username."'";
						$update_array = array('last_login'=>date('Y-m-d H:i:s'),'login_status'=>1);
						if($obj_rep->update_tbl($update_array,'admin' , $condition)){
								
							$_SESSION['token_id'] = md5($args_user['user_id']);
							$_SESSION['user_id'] = $args_user['user_id'];								
							header("Location:index.php");
						
						}
						else{
							header("Location:login.php?msg=Login Failed. Please try again");
						}
					}
					else{
						header("Location:login.php?msg=Your account is suspent contact to Super admin");
					}
				}
				else{
					header("Location:login.php?msg=Your password is incorrect");
				}
				
			}
			else{
				header("Location:login.php?msg=Please enter correct username");
			}
		}
		else{
			header("Location:login.php?msg=Please enter correct username and password");
		}
	}
	else
		header("Location:".$_SERVER['HTTP_REFERER']);
}


// logout user 
if(isset($_REQUEST['logout'])){
	
	$condition = " user_id ='".$_SESSION['user_id']."'";
	$update_array = array('last_logout'=>date('Y-m-d H:i:s'),'login_status'=>0);
	if($obj_rep->update_tbl($update_array, 'admin', $condition))
			{
	
			// destroy login session
		unset($_SESSION['token_id']);
		unset($_SESSION['user_id']);
		header("Location:login.php?msg=Logout successfully!");
	}
	else{
		header("Location:".$_SERVER['HTTP_REFERER']);
	}
}
?>