<?php 
ob_start();
include("../lib/config.php");
/*   CSV Export*/
			  function escape_csv_value($value) {
    $value = str_replace('"', '""', $value); // First off escape all " and make them ""
    if(preg_match('/,/', $value) or preg_match("/\n/", $value) or preg_match('/"/', $value)) { // Check if I have any commas or new lines
        return '"'.$value.'"'; // If I have new lines or commas escape them
    } else {
        return $value; // If no new lines or commas just return the value
    }
}

function redirectURL($url) {
	    echo '<script> window.location.href="'.$url.'"
		</script>"';

}

header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=Withdrawal-Request.csv");
header("Pragma: no-cache");
header("Expires: 0");
		   if(isset($_POST['Show']))
		   {
			   $date=date("Y-m-d");
			   $id=$_POST['list'];
			   
			  	   $description=$_POST['description'];
			  $title = '';$title .= "Beneficiary Name,Beneficiary Country,Beneficiary Mobile no ,Request Amount,Transaction Charge,Amount to pay "."\n";
echo $title;
			if(!empty($id)) {
    foreach($id as $check)   {
    	// echo "select * from withdraw_request where id='$check'";
    	// exit();
			  
			$select=mysql_fetch_array(mysql_query("select * from withdraw_request where id='$check'"));
			$selectuser_id=$select['user_id'];
			$request_amount=$select['request_amount'];
			   
			
			   
			

$sql = "SELECT * FROM withdraw_request where id='$check' and status='0'";
$res = mysql_query($sql);

					
						$totc_unpaid = 0;
						$total = 0;
						$content = '';

						while($row=mysql_fetch_assoc($res))
						{
						    
    $content .= escape_csv_value($row['first_name']).",";
    $content .= escape_csv_value($row['country']).",";
	 $content .= escape_csv_value($row['mobile_no']).",";
	  // $content .= escape_csv_value($row['acc_number']).",";
	  //   $content .= escape_csv_value($row['bank_nm']).",";
	  //   $content .= escape_csv_value($row['branch_nm']).",";
		 // $content .= escape_csv_value($row['swift_code']).",";
		  $content .= escape_csv_value($row['request_amount']).",";
		   $content .= escape_csv_value($row['transaction_charge']).",";
		    $content .= escape_csv_value($row['total_paid_amount']).",";
	
    $content .= "\n";
}
					

echo $content;
mysql_query("update withdraw_request set status='1', admin_remark='$description', admin_response_date='$date' where id='$check'");

}	   }	}   
		 
			
			
			
			 //header("location:withdrwal-request-manage.php");
		
		   
		   
		   ?>
		   