<?php
include("../lib/config.php");
// manage secure login of user account
if(!isset($_SESSION['token_id'])){
  header("Location:login.php");
}
else if(isset($_SESSION['token_id'])){
  if($_SESSION['token_id'] != md5($_SESSION['user_id'])){
    header("Location:login.php");
  }
  
  else{
  
    $condition = "user_id ='".$_SESSION['user_id']."'";
    $sql = $obj_rep->query('*', 'admin', $condition);
	$args_user=$obj_rep->get_all_row($sql);
  }
}
// store random no for security
$_SESSION['rand'] = mt_rand(1111111,9999999); 

	date_default_timezone_set("Africa/Lagos");
	$date = date ("Y-m-d H:i:s");
	
	
	


if(isset($_GET['edit_id'])){
	$comission_id = $_GET['edit_id'];
	// get product detail 
	$row_comission=mysql_fetch_array(mysql_query("select * from set_comission where id='".$comission_id."'"));
	$direct_cmossion=$row_comission['direct_comission'];
	$pntamount=$row_comission['pntamount'];
	$levels=$row_comission['level'];
	$level_percent=explode(",",$row_comission['level_comission']);

}


if(isset($_POST['submit']) && $_POST['submit']=='Submit')
{
	$level=implode(",",$_POST['level_percent']);
	

$insert_array = array('pntamount'=>$_POST['pntamount'],'direct_comission'=>$_POST['direct_comission'],'level'=>$_POST['level'],'level_comission'=>$level);

if($obj_rep->insert_tbl($insert_array,'set_comission'))
{
	
	$msg="Record Save Successfully";
	header('Refresh:2, url=comission_list.php');
}
	
}


if(isset($_POST['submit']) && $_POST['submit']=='Update')
{
	$level=implode(",",$_POST['level_percent']);
	

$update_array = array('pntamount'=>$_POST['pntamount'],'direct_comission'=>$_POST['direct_comission'],'level'=>$_POST['level'],'level_comission'=>$level);
$conditions=" id='".$_GET['edit_id']."'";

if($obj_rep->update_tbl($update_array,'set_comission',$conditions))
{
	
	$msg="Record Updated Successfully";
	header('Refresh:2, url=comission_list.php');
}
	
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php include("header.php");?>

<script type="text/javascript" src="<?php echo SITE_URL; ?>cmsadmin/ckeditor/ckeditor.js"></script>
    <!--easy pie chart-->
    <link href="css/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen" />

    <!--vector maps -->
    <link rel="stylesheet" href="css/jquery-jvectormap-1.1.1.css">

    <!--right slidebar-->
    <link href="css/slidebars.css" rel="stylesheet">

    <!--switchery-->
    <link href="css/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />

    <!--jquery-ui-->
    <link href="css/jquery-ui-1.10.1.custom.min.css" rel="stylesheet" />

    <!--iCheck-->
    <link href="css/all.css" rel="stylesheet">

    <link href="css/owl.carousel.css" rel="stylesheet">


    <!--common style-->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="sticky-header">

    <section>
        <!-- sidebar left start-->
     <?php include("sidebar.php");?>
        <!-- sidebar left end-->

        <!-- body content start-->
        <div class="body-content" style="min-height: 1000px;">

            <!-- header section start-->
    <?php include("top-menu.php");?>

            <!-- header section end-->

            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                   Dashboard
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                 <?php include("top-menu1.php");?>
           
            <!-- page head end-->

            <!--body wrapper start-->
            <div class="wrapper">

            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Set Commission<span style="float:right;color:red;"><?php if(isset($msg)){ echo $msg;};?></span>
                        </header>
                        
                       
                        <div class="panel-body">
                            <form class="form-horizontal" action="" role="form" method="post" enctype="multipart/form-data">
							
								<input type="hidden" name="action" value="<?php echo $action; ?>"/>
								<input type="hidden" name="rand" value="<?php echo $_SESSION['rand'];?>"/>
								<?php if($update):?>
								<input type="hidden" name="p_cat_id" value="<?php echo $product_id; ?>"/>
								<?php endif; ?>
								
								
								
								<div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">One Points :</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="pntamount" value="<?php if(isset($_GET['edit_id']) && !empty($_GET['edit_id'])){ echo $pntamount; } ?>" class="form-control" placeholder="Enter Point Amount" id="pntamount" required>
                                       
                                    </div>
                                </div>
								
								
							
                             <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Direct Comission :</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="direct_comission" value="<?php if(isset($_GET['edit_id']) && !empty($_GET['edit_id'])){ echo $direct_cmossion; } ?>" class="form-control" onblur="directComission(this.value)" placeholder="Enter Direct Commission" id="direct_comission" required>
                                       
                                    </div>
                                </div>
								
								
								<div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Level :</label>
                                    <div class="col-lg-10">
                                        <select  class="form-control" name="level" id="level" onChange="getLevelPer(this.value)" required>

                                                        <option value="">Select Level</option>
                                                        <?php
                                                        for ($i = 1; $i <= 20; $i++) {
                                                            ?>
                                                            <option value="<?php echo $i; ?>" <?php
                                                        if ($levels == $i) {
                                                            echo "selected";
                                                        }
                                                            ?>><?php echo $i; ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                    </select>
                                    </div>
                                </div>
								
							<div class="form-group" id="level_per">
							
							
							<?php
							if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
							{
								
							
						 for($i=1;$i<=$levels;$i++)
						 {
							 echo $row['level_comission'];
							 
						 ?>
                          
	<label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Level<?php echo $i;?> :</label><div class="col-lg-10"><input type="text" name="level_percent[]" class="form-control" value="<?php if(isset($level_percent[$i-1])): echo $level_percent[$i-1]; endif; ?>" id="level_percent_<?php echo $i;?>" placeholder="Level Percentage" onblur="calPerValue(this.value,<?php echo $i;?>)"></div>
                         
                         <?php
						 }
						 
							}
						 ?>
							</div>								
								 <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <input type="submit" name="submit" class="btn btn-primary" value="<?php if(isset($_GET['edit_id'])){?>Update<?php } else {?>Submit<?php } ?>">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
           
            </div>
            
            

            </div>
            <!--body wrapper end-->
            <!--footer section start-->
           <?php include("footer.php");?>
            <!--footer section end-->


        </div>
        <!-- body content end-->
        
    </section>



<!-- Placed js at the end of the document so the pages load faster -->
<script src="js/jquery-1.10.2.min.js"></script>

<!--jquery-ui-->
<script src="js/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>

<script src="js/jquery-migrate.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>

<!--Nice Scroll-->
<script src="js/jquery.nicescroll.js" type="text/javascript"></script>

<!--right slidebar-->
<script src="js/slidebars.min.js"></script>

<!--switchery-->
<script src="js/switchery.min.js"></script>
<script src="js/switchery-init.js"></script>

<!--flot chart -->
<script src="js/jquery.flot.js"></script>
<script src="js/flot-spline.js"></script>
<script src="js/jquery.flot.resize.js"></script>
<script src="js/jquery.flot.tooltip.min.js"></script>
<script src="js/jquery.flot.pie.js"></script>
<script src="js/jquery.flot.selection.js"></script>
<script src="js/jquery.flot.stack.js"></script>
<script src="js/jquery.flot.crosshair.js"></script>


<!--earning chart init-->
<script src="js/earning-chart-init.js"></script>


<!--Sparkline Chart-->
<script src="js/jquery.sparkline.js"></script>
<script src="js/sparkline-init.js"></script>

<!--easy pie chart-->
<script src="js/jquery.easy-pie-chart.js"></script>
<script src="js/easy-pie-chart.js"></script>


<!--vectormap-->
<script src="js/jquery-jvectormap-1.2.2.min.js"></script>
<script src="js/jquery-jvectormap-world-mill-en.js"></script>
<script src="js/dashboard-vmap-init.js"></script>

<!--Icheck-->
<script src="js/icheck.min.js"></script>
<script src="js/todo-init.js"></script>

<!--jquery countTo-->
<script src="js/jquery.countTo.js"  type="text/javascript"></script>

<!--owl carousel-->
<script src="js/owl.carousel.js"></script>

<!--Data Table-->
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.tableTools.min.js"></script>
<script src="js/bootstrap-dataTable.js"></script>
<script src="js/dataTables.colVis.min.js"></script>
<script src="js/dataTables.responsive.min.js"></script>
<script src="js/dataTables.scroller.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css" />
<!--data table init-->
<script src="js/data-table-init.js"></script>

<!--common scripts for all pages-->

<script src="js/scripts.js"></script>


<script type="text/javascript">

    function getLevelPer(num)
    {
	
        $.post("level_percent.php",
        {
            level_no:num,
        },
        function(data){
			if(data!='')
            {
				$("#level_per").html(data);
            }
	  
        });
	
	
    }


	
	function calPerValue(value,id)
    {
		
		var amount=100;
        var total_amount=0;
		
		var level=$("#level").val();
		
		
	
        for(var i=1;i<=level;i=i+1)
        {
			var level_percent =$("#level_percent_"+id).val();
			
			 if(level_percent>100)
            {
                $("#level_percent_"+id).val('');
                alert("Level percent is more than 100");
				return false;
            }
        }
	
    }
	
	
	function directComission(value)
	{
		if(!isNaN(value))
		{
			
		
			if(value>100)
            {
                $("#direct_comission").val('');
                alert("Level percent is more than 100");
				return false;
            }
			
		}
		else
		{
			$("#direct_comission").val('');
			$("#direct_comission").focus();
			alert("Only Numeric Allowed");
			return false;
		}
		
		
		
	}


</script>

</body>
</html>