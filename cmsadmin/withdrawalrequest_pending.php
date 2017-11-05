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

?><!DOCTYPE html>
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

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
	<script>
	function mtcn(mtcn,userId,Id)
	{
		if(mtcn!='' && mtcn!=false)
		{
			$.ajax({
				url:'../ajax/ajax_awb.php',
				type:'post',
				data:{mtcn:mtcn,userId:userId,id:Id,funtion:'mtcn'},
				success:function(data)
				{
                    //alert(data);
					if(data==2)
					{
							alert("Successfully Updated mtcn");
                            location.reload();
					}
					else if(data==3)
					{
						alert("Due to some Error Occur");
					}
				}
				
				
				
			});
		}
		
	}
	
	</script>
	
	
</head>

<body class="sticky-header">

    <section>
        <!-- sidebar left start-->
               <?php include("sidebar.php");?>
        <!-- sidebar left end-->

        <!-- body content start-->
        <div class="body-content" >

            <!-- header section start-->
                    <?php include("top-menu.php");?>

            <!-- header section end-->

            <!-- page head start-->
            <div class="page-head">
                <h3>
                    Dashboard
                </h3>
                 <?php include("top-menu1.php");?>
            <!-- page head end-->

            <!--body wrapper start-->
            <div class="wrapper">

                <div class="row">
                    <div class="col-sm-12">
                        <section class="panel">
                            <header class="panel-heading ">
                                 Order Pending Report
                                <span class="tools pull-right">
                                    <a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                                    <a class="t-close fa fa-times" href="javascript:;"></a>
                                </span>
                            </header>
                            <div class="table-responsive">
                            <table class="table responsive-data-table table-responsive data-table">
                            <thead>
                            <tr style="text-align:center;">
                                <th style="text-align:center;">
                                    S.No
                                </th>
                                <th style="text-align:center;">
                                    Date of Request
                                </th>
                                <!--<th style="text-align:center;">
                                    Product Price (<?php //echo CURRENCY; ?>)
                                </th>-->
                                <th style="text-align:center;">
                                    UserId
                                </th style="text-align:center;">

                                <th style="text-align:center;">
                                    Beneficiary Name
                                </th>
                                <th style="text-align:center;">
                                    Beneficiary Country
                                </th>
								<th style="text-align:center;">
                                    Beneficiary Mobile no
                                </th>
								<th style="text-align:center;">
                                    Requested amount 
                                </th>
								
								<!-- <th style="text-align:center;">
                                   Date of Response
                                </th> -->
								
								<!-- <th style="text-align:center;">
                                   city
                                </th>
								<th style="text-align:center;">
                                    Address
                                </th> -->
								<th style="text-align:center;">
                                    MTCN
                                </th>
                                <!-- <th style="text-align:center;">
                                   Date
                                </th> -->
							 </tr>
                            </thead>
                            <tbody>
                            <?php 
                                  $i=1;
                                  $data=mysql_query("select * from withdraw_request where status=0");
								  
								 
                                  while($data1=mysql_fetch_array($data))
                                    { 
								
								$arr=array('Pending','Deliverd');

								 // $usersql=mysql_fetch_assoc(mysql_query("select * from user_registration where user_id='".$data1['user_id']."'"));
								 
								 // $shipAdd=mysql_fetch_assoc(mysql_query("select * from shipping_address where user_id='".$data1['user_id']."'"));
								?>
                            <tr style="text-align:center;">
                                <td>
                                    <?php echo $i;?>
                                </td>
                                <td>
                                    <?php echo $data1['posted_date'];?>
                                </td>
                                <!--<td>
                                  <?php //echo Currency.$data1['net_price'];?> 
                                </td>-->
                             <td>
                                    <?php echo $data1['user_id']; ?>
                                </td> 

                                <td>
                                    <?php echo $data1['first_name']; ?>&nbsp;<?php echo $data1['last_name']; ?>
                                </td>
                                
                                
                                <!-- <td>
                                  <?php echo $usersql['username'];?>
                                </td>
								
								 <td>
                                  <?php echo $obj_func->memType($usersql['mem_type']);?>
                                </td>
								
								
								 <td>
                                  <?php echo $shipAdd['std_code']." ".$shipAdd['mobile'];?>
                                </td> -->
									<td>
                                  <?php echo $data1['country'];?>
                                </td>
								
								<td>
                                  <?php echo $data1['mobile_no'];?>
                                </td>
								
								<td>
                                  <?php echo $data1['request_amount'];?>
                                </td>
                                <!-- <td>
                                  <?php echo $data1['admin_response_date'];?>
                                </td> -->
								<td>
								
                                  <input type="text" placeholder="Enter mtcn No.." onblur="return mtcn(this.value,'<?php echo $data1['user_id']; ?>','<?php echo $data1['id']; ?>');" value="<?php echo $data1['mtcn']; ?>" class="form-control" name="awb">
                                </td>
								
								<!-- <td>
                                     <?php echo $data1['ts'];?>
                                </td> -->
								
							</tr>
                            <?php $i++;} ?>
                            
                      
                            </tbody>
                            </table>
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