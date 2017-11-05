<?php 
include("../lib/config.php");
   
/*   CSV Export*/
function escape_csv_value($value) 
{
	$value = str_replace('"', '""', $value); // First off escape all " and make them ""
	if(preg_match('/,/', $value) or preg_match("/\n/", $value) or preg_match('/"/', $value))
	{ // Check if I have any commas or new lines
		return '"'.$value.'"'; // If I have new lines or commas escape them
	} 
	else 
	{
		return $value; // If no new lines or commas just return the value
	}
}

function redirectURL($url) 
{
	$url=$_SERVER['HTTP_REFERER'];
    echo '<script> window.location.href="'.$url.'"</script>"';
}

header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=exportBinaryBv.csv");
header("Pragma: no-cache");
header("Expires: 0");

if($_REQUEST['userid'])
{
	$userid = $_REQUEST['userid'];
}
/*$sql="select * from registration where (user_name ='$id' or user_id='$id')";
$res=mysql_query($sql);
$rw=mysql_fetch_array($res);	*/				
$totc_unpaid = 0;
$total = 0;
$content = '';
	  
$title = '';
$i=1;


/*echo "select * from pin_request where user_id='$userid' and status='0' order by id desc";
exit;*/
$select = mysql_query("select * from manage_bv_history where income_id='$userid' order by id desc");

if(mysql_num_rows($select)>0)
{

	while($row=mysql_fetch_assoc($select))
	{
		$data11=mysql_fetch_array(mysql_query("select * from user_registration where user_id='".$row['downline_id']."'"));

		$ststuss = "Pending";

		if($row['status']==1) 
		{
			$ststuss="Paid";
		} 
		else 
		{
			$ststuss="Unpaid";
		}


		$content .= escape_csv_value($i).",";
		$content .= escape_csv_value($data11['first_name']." ".$data11['last_name']).",";
		$content .= escape_csv_value($row['downline_id']).",";
		$content .= escape_csv_value($row['bv']).",";
		$content .= escape_csv_value($row['position']).",";
		$content .= escape_csv_value($row['level']).",";
		$content .= escape_csv_value($row['description']).",";
		$content .= escape_csv_value($row['date']).",";
		$content .= escape_csv_value($ststuss).",";
		$content .= "\n";
		$i++;
	}
}						
$title .= "Sr No., Downline Name, Downline Id, BV, Position, Level, Remark, Date, Status"."\n";
echo $title;
echo $content;

?>