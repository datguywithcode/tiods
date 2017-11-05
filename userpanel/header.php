<?php
include("../lib/config.php");
if((isset($_SESSION['userpanel_user_id']) && !empty($_SESSION['userpanel_user_id'])) && (isset($_SESSION['SD_User_Name']) && !empty($_SESSION['SD_User_Name'])))
{



		$condtion=" (user_id='".$_SESSION['userpanel_user_id']."' OR username='".$_SESSION['SD_User_Name']."')";
		$sql=$obj_rep->query("*","user_registration",$condtion);
		
		$result=$obj_rep->get_all_row($sql);
		if($obj_rep->num_row($sql)>0)
		{
			$userimage = $result['image'];
			$userId = $result['user_id'];
				if(!empty($userimage) && file_exists('images/'.$userimage))
	{
		$userimage = 'images/'.$userimage;
	} 
	else
	{
		if($result['sex'] == 'male' || $result['sex'] == 'Male')
		{
			$userimage = "images/male.jpg";	
		}
		else if($result['sex'] == 'female' || $result['sex'] == 'Female')
		{
			$userimage = "images/female.jpg";		
		}
		else
		{
			$userimage = "images/male.jpg";	
		}
	}
			
			
		}

}
else
{
	echo "<script language='javascript'>window.location.href='../logout.php';</script>";exit;
}
?>