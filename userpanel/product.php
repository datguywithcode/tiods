<?php include("header.php");?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <?php include("title.php");?>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,700' rel='stylesheet' type='text/css'>

    <link href="css/epoch.min.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">

    <!-- SugarRush CSS -->
    <!-- <link href="css/sugarrush.css" rel="stylesheet"> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!-- product carousel start here -->
    <link rel="stylesheet" type="text/css" href="css/pc.css" />
    <!-- end here -->
  </head>

  <body class="">
    <div class="animsition">  
    
    <?php include("sidebar.php");?>


      <main id="playground">

            
      
         <?php include("top.php");?>
   


        <!-- PAGE TITLE -->
        <section id="page-title" class="row">

          <div class="col-md-8">
            <h1>All Product</h1>
            <!--<p><a href="#" target="_blank" class="btn btn-danger btn-sm">DataTables documentation</a></p>-->
          </div>

          <div class="col-md-4">

            <ol class="breadcrumb pull-right no-margin-bottom">
              <li><a href="#">Product</a></li>
              <li><a href="#">All Product</a></li>
             
            </ol>

          </div>
        </section> <!-- / PAGE TITLE -->

        <div class="container-fluid">
          <div class="row">

            <div class="col-md-12">

              <section class="panel panel-primary">
                <header class="panel-heading">
                  <h4 class="panel-title">Product Category</h4>
                </header>
                <div class="panel-body">

					
                    <div class="col-md-9">
                    
                    </div>
				
                    <!--<div class="col-md-3" style="margin-top:-15px;">
                        
                        <div class="controls pull-right">
                            <a class="left fa fa-chevron-left btn btn-primary" href="#carousel-example"
                                data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-primary" href="#carousel-example"
                                    data-slide="next"></a>
                        </div>
                    </div>-->
                </div>
                <div id="carousel-example" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                       

					   <div class="item active">
                            <div class="row">
							
							
							
							<?php	$sqlProdcut=mysql_query("select * from product_category");
								$num=mysql_num_rows($sqlProdcut);
								
								if($num>0)
								{
								while($fetchProd=mysql_fetch_assoc($sqlProdcut))
								{ 
							if(!empty($fetchProd['image']) && file_exists("../product_logos/".$fetchProd['image']))
							{
								$img=$fetchProd['image'];
							}
							else
							{
								$img="nv.jpg";
							}
							
							?>
							<div class="col-sm-3 margin-bottom-20">
                                    <div class="col-item">
                                        <div class="photo">
                                             <img src="../product_logos/<?php echo $img; ?>" class="img-responsive" alt="a" />
                                        </div>
                                        <div class="info">
                                            <div class="row">
                                                <div class="price col-md-12">
                                                     <h5>
                                                        <b><?php echo $fetchProd['product_name']; ?></b></h5>
                                                    <h3 class="price-text-color">
                                                       <?php echo Currency." ".$fetchProd['cost_price']; ?></h3>
                                                </div>
                                            </div>
                                            <div class="separator clear-left">
                                                 <p class="text-center">
                                                    <a href="product-details.php?p_id=<?php echo $fetchProd['p_cat_id']; ?>" class="btn btn-primary"><span class="fa fa-shopping-cart"></span> Details</a>
												</p>
                                            </div>
                                            <div class="clearfix">
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<?php } } ?>
								
							</div>
                        </div>
                    </div>
                </div>

           </section>
            

            </div> <!-- /col-md-6 -->

  

          </div>

      
        </div> <!-- / container-fluid -->
        
         <div class="col-md-12 text-center">

 <!--<a href="bh_export_binary_income.php?userid=<?=$userid;?>"><input type="submit" name="update" value="Export in CSV" class="btn btn-primary"></a> -->


          </div>


     <?php include("footer.php");?>


    </main> <!-- /playground -->


    <!-- - - - - - - - - - - - - -->
    <!-- start of NOTIFICATIONS  -->
    <!-- - - - - - - - - - - - - -->
     <?php include("rightside-panel.php");?>
    <!-- - - - - - - - - - - - - -->
    <!-- start of NOTIFICATIONS  -->
    <!-- - - - - - - - - - - - - -->

    <div class="scroll-top">
      <i class="ti-angle-up"></i>
    </div>
  </div> <!-- /animsition -->

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="js/raphael-min.js"></script>
  <script src="js/jquery-1.11.2.min.js"></script>
  <script src="js/jquery-ui.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/jquery.animsition.min.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>

  <script src="js/includes.js"></script>
  <script src="js/sugarrush.js"></script>
  <script src="js/sugarrush.tables.js"></script>
  </body>
</html>