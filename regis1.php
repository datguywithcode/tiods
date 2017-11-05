<?php
ini_set("memory_limit",-1);
ini_set('max_execution_time', 300);
include("lib/config.php");
$_SESSION['placementid']=$_POST['placementid'];

//check we have username post var
if(isset($_POST["placementid"]))
{
    //check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        die();
    }   

        //try connect to db
       //trim and lowercase username
    $placementid =  strtolower(trim($_POST["placementid"])); 
    $refid =  strtolower(trim($_POST["placementid"]));
	
	$select2 = mysql_fetch_array(mysql_query("SELECT * FROM user_registration WHERE (username='$placementid' OR user_id= '$placementid' and user_rank_name='Ambassador')"));
	 $placementid =  $select2['user_id'];
    if($placementid!='')
	{
    $refid =  strtolower(trim($_POST["refid"])); 

	$refid = strtoupper($refid);
    $placementid = strtoupper($placementid);
	
	if($refid==$placementid)
	{
		$nom=$placementid;	
	}
	else
	{
    //sanitize username
    //$placementid = filter_var($placementid, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
	//$refid = filter_var($refid, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);

	$arrays = array();
	//echo "SELECT nom_id FROM user_registration WHERE user_id= '$placementid'";
	$select = mysql_query("SELECT nom_id FROM user_registration WHERE (username='$placementid' OR user_id= '$placementid')");
	$qrySelect = mysql_fetch_array($select);
	$nom_id = $qrySelect['nom_id'];
	$arrays[] = $nom_id;

	if($nom_id =='cmp')
	{
		$arrays[] = $refid;
	
	}
	else
	{
		while($nom_id != 'cmp')
		{
			$select = mysql_query("SELECT nom_id FROM user_registration WHERE user_id= '$nom_id'");
			$qrySelect = mysql_fetch_array($select);
			$nom_id = $qrySelect['nom_id'];
			
			$arrays[] = array_push($arrays, $nom_id);
			if($nom_id =='cmp')
			{
				break;	
			}
	
		}
	}
	}
	//$arrays[]=countNomTotal($placementid);
	 
		$nom=$placementid;

    	//check username in db
		$results = mysql_query("SELECT * FROM user_registration WHERE ((user_id='$nom' or username='$nom') and  user_status='0')");
		
		//return total count
		$username_exist = mysql_num_rows($results); //total records
		$row_ref=mysql_fetch_assoc($results);

		$yesd = mysql_num_rows(mysql_query("SELECT * FROM level_income_binary WHERE (income_id='$refid' and down_id='$nom')"));
		
		//return total count
		
	
    //if value is more than 0, username is not available
    if(!$username_exist && !$yesd) {
          echo "<font color='#FF0000'><strong>"."Placement User Not Available or not in the downline of sponsor!"."<strong</font>";
    }else{
        echo "<font color='#009999'><strong>".ucfirst($row_ref['username'])." is your Placement Sponsor!<strong</font>";
    }
    
    //close db connection
   
}
else
{
	  echo "<font color='#FF0000'><strong>"."Placement User Not Available or not in the downline of sponsor!"."<strong</font>";
}
}






?>