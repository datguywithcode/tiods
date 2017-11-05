<?php 
include("lib/config.php");

$country=$_GET['platform'];
$query=mysql_query("SELECT * FROM cities WHERE countryid='".$country."'") or die(mysql_error());
?>
 <option value="">--select state--</option>
 <?php
 if(mysql_num_rows($query)>0)
 {
while($result=mysql_fetch_array($query))
{
?>
<option value="<?php echo $result['CityId'] ?>"><?php echo $result['City'] ?></option>
<?php
}
}
else
{
?>
<option value="">No Record Found</option>
<?php } ?>

   

                

               
                 

                    

              



				