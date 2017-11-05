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


if(isset($_GET['id'])){
	$userID = $_GET['id'];
	$action = 'UpdateProduct';
	// get product detail 
	$sqlQury=mysql_query("select * from user_registration where user_id='".$userID."' or username='".$userID."'");
	$f=mysql_fetch_assoc($sqlQury);
	
	$userid=$f['user_id'];
	
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
			
			<div class="col-lg-12 center-block" style="float:none;">
                    <section class="panel">
                        <header class="panel-heading">
                            Direct Refferal
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal" action="direct-member-tree.php?id=<?php echo $_POST[id]; ?>" role="form" method="get">
							    <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">Enter User ID/User Name</label>
                                    <div class="col-lg-3">
                                        <input type="text" name="id" class="form-control" placeholder="Enter User ID/User Name" required>
									</div>
                                </div>
                               <div class="form-group">
                                    <div class="col-lg-offset-4 col-lg-8">
                                        <input type="submit" class="btn btn-primary" name="Search" value="Submit">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
			
			
			
			
			
			
			
			
			
			<?php if(isset($_GET['id']) && mysql_num_rows($sqlQury)>0){ ?>
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Direct Refferal
                        </header>
                        <div class="panel-body">
							<div class="table-responsive">
                        
                        	<div class="content">
                        	
                            <table cellspacing="0" cellpadding="0" border="0" align="center" class="tree-table">
                              <tbody><tr align="center">
                                <td width="5%">&nbsp;</td>
                                <td width="5%">&nbsp;</td>
                                <td width="5%">&nbsp;</td>
                                <td width="5%">&nbsp;</td>
                                <td width="5%">&nbsp;</td>
                                <td width="5%">&nbsp;</td>
                                <td width="5%" align="center"><a class="tooltip1" href="direct-member-tree.php?id=<?php echo $userid?>"> <div class="margint10">  
                                <img height="50" class="round-border" id="menu_link2" src="images/meb-6.png"><br><?php echo $userid?><br/><?php echo $f['username']?> <br/>
                                <p style="width:40px; margin:1em 0 0 0; padding:0"></p></div>
                                <span><img src="images/callout.gif" class="callout">
                                <div class="flyout">
                                  <table width="100%" cellspacing="1" cellpadding="1" border="0">
                                    <tbody>
                                    <tr>
                                      <td align="left">User ID</td>
                                      <td align="left"><?php echo $userid?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Full  Name</td>
                                      <td align="left"><?php echo $f['first_name'];?> <?php echo $f['last_name'];?></td>
                                    </tr>
                                   
                                    <tr>
                                   
                                      <td align="left">Country</td>
                                      <td align="left"><?php echo $f['country'];?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Email</td>
                                      <td align="left"><?php echo $f['email'];?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Sponsor  ID</td>
                                      <td align="left"><?php echo $f['ref_id'];?></td>
                                    </tr>

                                    <tr>
                                      <td align="left">D.O.J</td>
                                      <td align="left"><?php echo $f['registration_date'];?></td>
                                    </tr>

                                   

                                    
                                  </tbody></table>
                                </div></span></a></td>
                                    <td width="5%">&nbsp;</td>
                                    <td width="5%">&nbsp;</td>
                                    <td width="5%">&nbsp;</td>
                                    <td width="5%">&nbsp;</td>
                                    <td width="5%">&nbsp;</td>
                                    <td width="5%">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td align="center"><img width="2" height="25" alt="img" src="images/line.png"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td colspan="10" class="bd-btm"></td>
                                    <td></td>
                                
                                  </tr>
                                  <tr align="center">
                                  <?php $ds=1;
                                  while($ds<=$countsd)
                                    { ?>
                                    <td colspan="2"><img width="2" height="25" alt="img" src="images/line.png"></td>
                                  <?php $ds++; } ?>

                                    
                                  </tr>
 <tr align="center">
                                  <?php 
$que=mysql_query("select * from user_registration where ref_id='$userid'");
while($datas1=mysql_fetch_array($que)) { ?>
    


                                 
                                    <td colspan="2"><a class="tooltip1" href="direct-member-tree.php?id=<?php echo $datas1['user_id']?>"> 
                                    <div class="margint10">  
                                    <img height="50" class="round-border" id="menu_link2" src="images/meb-6.png"><br/><br/> <?php echo $datas1['user_id'];?><br/><?php echo $datas1['username'];?><br/> 
                                    <p style="width:40px; margin:1em 0 0 0; padding:0"></p></div>
                                    <span><img src="images/callout.gif" class="callout">
                                   
    								<div class="flyout "><table width="98%" cellspacing="1" cellpadding="1" border="0">
									  <tbody><tr>
										<td align="left">User ID</td><td>
<?php echo $datas1['user_id'];?></td></tr>
									
									 <tr>
                                      <td align="left">Full  Name</td>
                                      <td align="left"><?php echo $datas1['first_name'];?> <?php echo $datas1['last_name'];?></td>
                                    </tr>
									 
									  
	                                    <tr>
                                   
                                      <td align="left">Country</td>
                                      <td align="left"><?php echo $datas1['country'];?></td>
                                    </tr>

									 
									  <tr>
										<td align="left">Email</td>
										<td align="left"><?php echo $datas1['email'];?></td>
									  </tr>
									
									  <tr>
										<td align="left">Sponsor  ID</td>
										<td align="left"><?php echo $datas1['ref_id'];?></td>
									  </tr>
									  <tr>
										<td align="left">D.O.J</td>
										<td align="left"><?php echo $datas1['registration_date'];?></td>
									  </tr>

                                   
									</tbody></table>
									</div></span></a>
                                    
                                    
                                    
                                    </td>
                     
   
   
  <?php } ?>
   
   </tr>
  <tr><td>&nbsp;</td></tr>
</tbody></table>
                                        
                                        
                                        
						</div>
                        
                        </div>
							
							
							
							
							
                        </div>
                    </section>
                </div>
			<?php } ?>
           
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