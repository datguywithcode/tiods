<?php
	$level_no=$_POST['level_no'];
	$msg="";
	for($i=1;$i<=$level_no;$i++)
	{
	$msg .='<label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Level'.$i.' :</label><div class="col-lg-10"><input type="text" name="level_percent[]" class="form-control" id="level_percent_'.$i.'" placeholder="Level Percentage" onblur="calPerValue(this.value,'.$i.')"></div>';	
		
	}
	echo $msg;

?>


