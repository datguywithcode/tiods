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


					$action = 'AddProduct';
					$update = false;
					$category = '';
					
				  	if(isset($_GET['product_id'])){
						$product_id = $_GET['product_id'];
						$action = 'UpdateProduct';
						// get product detail 
						$res_product=$obj_rep->query("*","product_category","p_cat_id='$product_id'");
						$row_product=$obj_rep->get_all_row($res_product);
						$category=$row_product['cat_id'];
						$subcategory=$row_product['sub_id'];
						$product_name=$row_product['product_name'];
						$cost_price=$row_product['cost_price'];
						$dailydeal_discount=$row_product['dailydeal_discount'];
						$shipping=$row_product['shipping'];
						$product_volume=$row_product['product_volume'];
						$image=$row_product['image'];
						$p_qty=$row_product['p_qty'];
						$pro_desc=$row_product['pro_desc'];
						$product_pdf=$row_product['product_pdf'];
						$product_exe=$row_product['product_exe'];
						$product_zip=$row_product['product_zip'];
						$video_link=$row_product['video_link'];
						$download_link=$row_product['download_link'];
						$pre_written_add=$row_product['pre_written_add'];
						$update = true;
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
                            Add Product<span style="float:right;color:red;"><?php echo @$_GET['msg'];?></span>
                        </header>
                        
                       
                        <div class="panel-body">
                            <form class="form-horizontal" action="submit.php" role="form" method="post" enctype="multipart/form-data">
								<input type="hidden" name="action" value="AddMoreProductImage"/>
								<input type="hidden" name="rand" value="<?php echo $_SESSION['rand'];?>"/>
								<?php if($update):?>
								<input type="hidden" name="p_id" value="<?php echo $product_id; ?>"/>
								<?php endif; ?>
							
                             
								<div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Product Image :</label>
                                    <div class="col-lg-10">
                                        <input type="file" class="validate[required] form-control placeholder" name="files[]" id="image"  />
                                       
                                    </div>
                                </div>
								
								<?php if(isset($image) && $image!=''): ?>
								<div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Product Image :</label>
                                    <div class="col-lg-10">
                                        <img src="../product_logos/<?php echo $image; ?>" width="90" height="90" />
										
                        <input type="hidden" name="old_image" value="<?php if(isset($image)): echo $image; endif; ?>" />
                                       
                                    </div>
                                </div>
								<?php endif;?>
								 <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <input type="submit" class="btn btn-primary" value="Submit">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
           
            </div>
            
            

            </div>
            <!--body wrapper end-->
 <script type="text/javascript">
                         // Replace the <textarea id="editor1"> with a CKEditor
                        // instance, using default configuration.
                        CKEDITOR.replace( 'editor2',
                         {
                              filebrowserBrowseUrl : '<?php echo SITE_URL; ?>cmsadmin/ckeditor/ckfinder/ckfinder.html',
                              filebrowserImageBrowseUrl : '<?php echo SITE_URL; ?>cmsadmin/ckeditor/ckfinder/ckfinder.html?type=Images',
                              filebrowserFlashBrowseUrl : '<?php echo SITE_URL; ?>cmsadmin/ckeditor/ckfinder/ckfinder.html?type=Flash',
                              filebrowserUploadUrl : '<?php echo SITE_URL; ?>cmsadmin/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                              filebrowserImageUploadUrl : '<?php echo SITE_URL; ?>cmsadmin/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                              filebrowserFlashUploadUrl : '<?php echo SITE_URL; ?>cmsadmin/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                              filebrowserWindowWidth : '1000',
                              filebrowserWindowHeight : '700'
                         });
                         </script>
                         

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

    $(document).ready(function() {

        //countTo

        $('.timer').countTo();

        //owl carousel

        $("#news-feed").owlCarousel({
            navigation : true,
            slideSpeed : 300,
            paginationSpeed : 400,
            singleItem : true,
            autoPlay:true
        });
    });

    $(window).on("resize",function(){
        var owl = $("#news-feed").data("owlCarousel");
        owl.reinit();
    });

</script>

</body>
</html>