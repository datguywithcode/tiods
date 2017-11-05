<?php 
ob_start();
session_start();
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
header("Content-Disposition: attachment; filename=exportEpin.csv");
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
$select = mysql_query("select * from pin_request where user_id='$userid' and status='0' order by id desc");

if(mysql_num_rows($select)>0)
{

	while($row=mysql_fetch_assoc($select))
	{

		$ststuss = "Pending";
		$content .= escape_csv_value($i).",";
		$content .= escape_csv_value($row['amount']).",";
		$content .= escape_csv_value($ststuss).",";
		$content .= escape_csv_value($row['date']).",";
		$content .= escape_csv_value($row['no_of_pin']).",";
		$content .= "\n";
		$i++;
	}
}						
$title .= "Sr No.,Amount, Status, Create Date, No. of Pins"."\n";
echo $title;
echo $content;

?>