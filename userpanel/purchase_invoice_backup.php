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
                  <h4 class="panel-title">Product List</h4>
                </header>
                <div class="panel-body">

                  <table class="table datatable">
                    <thead>
                      <tr>
                        <th>Action</th>
                        <th>Product Price</th>
                        <th>Product Volume</th>
                        <th>Product Image</th>
                        <th>Product Description</th>
                      </tr>
                    </thead>
                    <tbody>
					
					<?php
						$fetchProduct=mysql_fetch_assoc(mysql_query("select * from product_category where status='0' and p_cat_id='".$_GET['pid']."'")); ?>
                     <tr>
                        <td><?php echo $fetchProduct['product_name']; ?></td>
                        <td><?php echo $fetchProduct['cost_price']; ?></td>
                        <td><?php echo $fetchProduct['product_volume']; ?></td>
                        <td><img src="../product_logos/<?php echo $fetchProduct['image']; ?>" width="120" /></td>
                        <td><?php echo $fetchProduct['pro_desc']; ?></td>
                      </tr>
                      
					</tbody>
                  </table>


                </div>
              </section>
            

            </div> <!-- /col-md-6 -->
        
        
        
        
            <div class="col-md-12">

              <section class="panel panel-primary">
                <header class="panel-heading">
                	<div class="col-md-6">
                    <div class="checkbox">
                  	<h4 class="panel-title">Billing/Shipping Address</h4>
                    </div>
                    </div>
                    
                    <div class="col-md-6">
                  	<h4 class="panel-title"><div class="checkbox">
                        <label>
                        <input id="labelauty-892543" class="tiny checkbox-warning labelauty" type="checkbox" style="display: none;">
                        Same as Billing Address
                        
                        </label>
                        </div>
						 </h4>
                    </div>
                    <div class="clearfix"></div>
                </header>
                <div class="panel-body">

                  <div class="col-md-6">
                  
                  	<form class="form-horizontal">
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-5">Mobile No.</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-5">Email ID</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" />
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-5">Country</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" />
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-5">State</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" />
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-5">City</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" />
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-5">Address</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" />
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-5">Postal Code</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" />
                        </div>
                      </div>
                      
                      
                    </form>
                  
                  </div>
                  
                  
                  <div class="col-md-6">
                  
                  	<form class="form-horizontal">
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-5">Mobile No.</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-5">Email ID</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" />
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-5">Country</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" />
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-5">State</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" />
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-5">City</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" />
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="col-sm-5">Address</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" />
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-5">Postal Code</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" />
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="col-sm-offset-5 col-sm-7">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                    </form>
                  
                  </div>


                </div>
              </section>
            

            </div> <!-- /col-md-6 -->

        
        
        <div class="col-md-12">

              <section class="panel panel-primary">
                <header class="panel-heading">
                  <h4 class="panel-title">Orders</h4>
                </header>
                <div class="panel-body">

                  <table class="table">
                    <thead>
                      <tr>
                        <th>Action</th>
                        <th>Product Name</th>
                        <th>Product Code</th>
                        <th>Product Image</th>
                        <th>Product Price(NPR)</th>
                        <th>Product Volume</th>
                        <th>Quantity</th>
                        <th>Enter Quantity</th>
                        <th>Total Price(NPR)</th>
                      </tr>
                    </thead>
                    <tbody>
					
                     <tr>
                        <td><a href="#" class="btn btn-danger">Delete Cart</a> <a href="#" class="btn btn-success">Update Cart</a></td>
                        <td>aaaa</td>
                        <td>aaaa</td>
                        <td>aaaa</td>
                        <td>aaaa</td>
                        <td>aaaa</td>
                        <td>aaaa</td>
                        <td><input type="text" style="width:50px;" /></td>
                        <td>aaaa</td>
                      </tr>
                      
                      <tr style="border-top:none;">
                      	<td style="border-top:none;">&nbsp;</td>
                        <td style="border-top:none;">&nbsp;</td>
                        <td style="border-top:none;">&nbsp;</td>
                        <td style="border-top:none;">&nbsp;</td>
                        <td style="border-top:none;">&nbsp;</td>
                        <td style="border-top:none;">&nbsp;</td>
                        <td colspan="2" style="border-top:none;">Total PV</td>
                        <td style="border-top:none;" colspan="2">72</td>
                      </tr>
                      
                      <tr style="border-top:none;">
                        <td style="border-top:none;">&nbsp;</td>
                        <td style="border-top:none;">&nbsp;</td>
                        <td style="border-top:none;">&nbsp;</td>
                        <td style="border-top:none;">&nbsp;</td>
                        <td style="border-top:none;">&nbsp;</td>
                        <td style="border-top:none;">&nbsp;</td>
                        <td colspan="2" style="border-top:none;">Sub Total(NPR)</td>
                        <td style="border-top:none;" colspan="2">Rs. 405</td>
                      </tr>
                      
                      <tr style="border-top:none;">
                        <td style="border-top:none;">&nbsp;</td>
                        <td style="border-top:none;">&nbsp;</td>
                        <td style="border-top:none;">&nbsp;</td>
                        <td style="border-top:none;">&nbsp;</td>
                        <td style="border-top:none;">&nbsp;</td>
                        <td style="border-top:none;">&nbsp;</td>
                        <td colspan="2" style="border-top:none;">Grand Total</td>
                        <td style="border-top:none;" colspan="2">Rs. 405</td>
                      </tr>
                      
					</tbody>
                  </table>


                </div>
              </section>
            

            </div> <!-- /col-md-12 -->
        

  

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