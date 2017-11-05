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
header("Content-Disposition: attachment; filename=exportPurchaseReport.csv");
header("Pragma: no-cache");
header("Expires: 0");

if($_REQUEST['userid'])
{
	$userid = $_REQUEST['userid'];
}
		
$totc_unpaid = 0;
$total = 0;
$content = '';
	  
$title = '';
$i=1;



$sqlpur=" SELECT *, sum(price*quantity) as oto,PUR.status FROM purchase_detail PUR inner join product_category PRO where  PRO.p_cat_id=PUR.p_id  and user_id='$userid' group by invoice_no order by PUR.pd_id desc";
						$sql_query=mysql_query($sqlpur);
					
					

if(mysql_num_rows($sql_query)>0)
{

		$i=1;
		while($fetData = mysql_fetch_array($sql_query)){
		$arr_status=array('Pending','Paid','Shipped','Cancaeled');
		
		$content .= escape_csv_value($i).",";
		$content .= escape_csv_value($fetData['invoice_no']).",";
		$content .= escape_csv_value($fetData['date']).",";
		$content .= escape_csv_value($fetData['product_volume']).",";
		$content .= escape_csv_value($fetData['product_name']).",";
		$content .= escape_csv_value($fetData['pay_mode']).",";
		$content .= escape_csv_value($fetData['cost_price']).",";
		$content .= escape_csv_value($arr_status[$fetData['status']]).",";
		$content .= "\n";
		$i++;
	}
}						
$title .= "Sr No., Invoice No., Invoice Date, Prodcut Points, product,Payment Mode ,Net Amount (".CURRENCY."),Paid /Unpaid"."\n";
echo $title;
echo $content;

?>