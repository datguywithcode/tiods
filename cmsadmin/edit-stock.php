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
  
$condition = " user_id ='".$_SESSION['user_id']."'";
    $sql = $obj_rep->query('*', 'admin',$condition);
	
	$args_user=$obj_rep->get_all_row($sql);
  }
}
// store random no for security
$_SESSION['rand'] = mt_rand(1111111,9999999); 

if(isset($_GET['id']) && !empty($_GET['id']))
{
$id=$_GET['id'];
}
else
{
$id="";
}
  
					if(isset($_GET['product_id'])){
						$product_id = $_GET['product_id'];
						
						// get product detail 
						$res_product=$obj_rep->query("*","product_category","p_cat_id='$product_id'");
						$row_product=$obj_rep->get_all_row($res_product);
						
						$product_name=$row_product['product_name'];
						
						$p_qty=$row_product['p_qty'];
						
						
					}

					
if(isset($_POST['submit_stock']))
{
	$pid=$_POST['p_cat_id'];
	$qty=$_POST['p_qty'];
	$q=mysql_query("update product_category set p_qty='$qty' where p_cat_id='$pid'") or die(mysql_error());
	
		$add_date=date("Y-m-d");
		$remark=$qty." products added by admin";
			mysql_query("insert into stock_to_sell_history set product_id='$pid',quantity='$qty',add_by='admin',remark='$remark', add_date='$add_date'") or die(mysql_error());	
	?>
    
    <script>
	window.location.href='manage_stock.php';
	</script>
<?php	
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php include("header.php");?>


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
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

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
                           Edit Product Quantity<span style="float:right;color:red;"><?php echo @$_GET['msg'];?></span>
                        </header>
                        
                       
                        <div class="panel-body">
                           <form action="" class="validate" method="post" id='form1' enctype="multipart/form-data">
                  
                 <input type="hidden" name="p_cat_id" value="<?php echo $product_id; ?>"/>
                    <fieldset>
                       <div class="form-group">
                         <div class="left-box">
                          <label for="name"> Product Name</label>
                          <input type="text" class="validate[required] form-control placeholder" name="product_name" id="product_name" placeholder="Product name" data-bind="value: name" value="<?php if(isset($product_name)): echo $product_name; endif; ?>" />
                        </div>
                         <div class="left-box">
                          <label for="name"> Product Quantity </label>
                          <input type="text" class="validate[required] form-control placeholder" name="p_qty" id="p_qty" placeholder="Product Quantity" data-bind="value: name" value="<?php if(isset($p_qty)): echo $p_qty; endif; ?>" />
                        </div>
                      
                        
                      
                        
                        
                      </div>
                       <div class="clearfix"></div>
                       <div class="clearfix"></div>
                      <div class="form-group">
                      
                        <div class="left-box">
                          <button class="btn btn-danger side"  type="submit" id="button" name="submit_stock" >Submit</button>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                        </div>
                    </section>
                </div>
           
            </div>
            
            

            </div>
          
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
</body>
</html>