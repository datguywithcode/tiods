<?php 
include("header.php");
$slqchecks=mysql_query("select * from shipping_address where user_id='".$userId."'");
						
						$fetchShiping=mysql_fetch_assoc($slqchecks);
						
						if(mysql_num_rows($slqchecks)>0)
						{
							
							
							$first_name=$fetchShiping['first_name'];
							$last_name=$fetchShiping['last_name'];
							$country=$fetchShiping['country'];
							$city=$fetchShiping['city'];
							$code=$fetchShiping['std_code'];
							$telephone=$fetchShiping['mobile'];
							$email=$fetchShiping['email'];
							$address=$fetchShiping['address2'];
							
						}
						else
						{
							
							
							$first_name=$result['first_name'];
							$last_name=$result['last_name'];
							$country=$result['country'];
							$city=$result['city'];
							$code=$result['std_code'];
							$telephone=$result['telephone'];
							$email=$result['email'];
							$address=$result['address'];
						}



if(isset($_POST['submit']) && $_POST['submit']=='Submit')
{
	
					
						$inserAddredd = array('user_id'=>$userId,'first_name'=>$_POST['first_name'],'last_name'=>$_POST['last_name'],'std_code'=>$_POST['std_code'],'mobile'=>$_POST['mobile'],'email'=>$_POST['email'],'address2'=>$_POST['address2'],'city'=>$_POST['city'],'country'=>$_POST['country']);
						
						
						
						$slqcheck=mysql_query("select * from shipping_address where user_id='".$userId."'");
						
						if(mysql_num_rows($slqcheck)>0)
						{
							
							$condtion=" user_id='".$userId."'";
							if($obj_rep->update_tbl($inserAddredd,'shipping_address',$condtion))
							{
								header("location:summary.php?p_id=".$_GET['p_id']);	
							}
							
							
							
						}
						else
						{
                                                    
                                                if($obj_rep->insert_tbl($inserAddredd,'shipping_address'))
						{
							
						header("location:summary.php?p_id=".$_GET['p_id']);	
						}
						
						}
						
}



?>
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
    
    <!-- product view -->
    <link rel="stylesheet" href="css/multizoom.css" type="text/css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>

<script type="text/javascript" src="js/multizoom.js">

// Featured Image Zoomer (w/ optional multizoom and adjustable power)- By Dynamic Drive DHTML code library (www.dynamicdrive.com)
// Multi-Zoom code (c)2012 John Davenport Scheuer
// as first seen in http://www.dynamicdrive.com/forums/
// username: jscheuer1 - This Notice Must Remain for Legal Use
// Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more

</script>

<script type="text/javascript">

jQuery(document).ready(function($){

	$('#image1').addimagezoom({ // single image zoom
		zoomrange: [3, 10],
		magnifiersize: [300,300],
		magnifierpos: 'right',
		cursorshade: true,
		largeimage: 'hayden.jpg' //<-- No comma after last option!
	})


	$('#image2').addimagezoom() // single image zoom with default options
	
	$('#multizoom1').addimagezoom({ // multi-zoom: options same as for previous Featured Image Zoomer's addimagezoom unless noted as '- new'
		descArea: '#description', // description selector (optional - but required if descriptions are used) - new
		speed: 1500, // duration of fade in for new zoomable images (in milliseconds, optional) - new
		descpos: true, // if set to true - description position follows image position at a set distance, defaults to false (optional) - new
		imagevertcenter: true, // zoomable image centers vertically in its container (optional) - new
		magvertcenter: true, // magnified area centers vertically in relation to the zoomable image (optional) - new
		zoomrange: [3, 10],
		magnifiersize: [250,250],
		magnifierpos: 'right',
		cursorshadecolor: '#fdffd5',
		cursorshade: true //<-- No comma after last option!
	});
	
	$('#multizoom2').addimagezoom({ // multi-zoom: options same as for previous Featured Image Zoomer's addimagezoom unless noted as '- new'
		descArea: '#description2', // description selector (optional - but required if descriptions are used) - new
		disablewheel: true // even without variable zoom, mousewheel will not shift image position while mouse is over image (optional) - new
				//^-- No comma after last option!	
	});
	
})

</script>
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
            <h1>Shipping Address</h1>
            <!--<p><a href="#" target="_blank" class="btn btn-danger btn-sm">DataTables documentation</a></p>-->
          </div>

          <div class="col-md-4">

            <ol class="breadcrumb pull-right no-margin-bottom">
              <li><a href="#">Product</a></li>
              <li><a href="#">Shipping Address</a></li>
             
            </ol>

          </div>
        </section> <!-- / PAGE TITLE -->

        <div class="container-fluid">
          <div class="row">

            <div class="col-md-12">

              <section class="panel panel-primary">
                <header class="panel-heading">
                  <h4 class="panel-title">Shipping Address</h4>
                </header>
                <div class="panel-body">
              
			  <form action="" method="post">
                	<div class="col-md-12">
                    
                    	<div class="col-md-6 margin-bottom-10">
                        	<label>First Name</label>
                            <input type="text" name="first_name" placeholder="Please Enter First Name.." value="<?php if(isset($_GET['p_id']) && !empty($_GET['p_id'])){ echo $first_name; } ?>" class="form-control" required/>
                        </div>
                        
                        <div class="col-md-6 margin-bottom-10">
                        	<label>Last Name</label>
                            <input type="text" name="last_name" placeholder="Please Enter Last Name.." value="<?php if(isset($_GET['p_id']) && !empty($_GET['p_id'])){ echo $last_name; } ?>" class="form-control" required/>
                        </div>
                        
                        <div class="col-md-6 margin-bottom-10">
                        	<label>Country</label>
                            <select class="form-control" name="country" id="country" required>
                                 <option value="">Select a Country</option>
                                 <?php $sql=mysql_query("select * from country");
                                    while($fetcCountry=mysql_fetch_assoc($sql))
                                    {
                                    ?>
                                 <option value="<?php echo $fetcCountry['countryid']; ?>" <?php if($country==$fetcCountry['countryid']){ echo "selected"; } ?>><?php echo $fetcCountry['country'] ?></option>
                                 <?php } ?>
                              </select>
                        </div>
                        
                        <div class="col-md-6 margin-bottom-10">
                        	<label>City/State</label>
                            <input type="text" name="city" placeholder="Please Enter City/State.." value="<?php if(isset($_GET['p_id']) && !empty($_GET['p_id'])){ echo $city; } ?>" class="form-control" required/>
                        </div>
                        
                        <div class="col-md-1 margin-bottom-10">
						
						<label for="simplecolor">Code :</label>
						<input type="text" placeholder="+ Code" maxlength="4" class="form-control" name="std_code" value="<?php if(isset($_GET['p_id']) && !empty($_GET['p_id'])){ echo $code; } ?>" class="form-control" required>
						
						</div>
						
						<div class="col-md-5 margin-bottom-10">
						
                        	<label>Mobile :</label>
                            <input type="text" name="mobile" maxlength="10" placeholder="Please Enter Mobile1.." value="<?php if(isset($_GET['p_id']) && !empty($_GET['p_id'])){ echo $telephone; } ?>" class="form-control" required/>
							
                        </div>
                        
                        <div class="col-md-6 margin-bottom-10">
                        	<label>Email</label>
                            <input type="email" name="email" placeholder="Please Enter Email.." value="<?php if(isset($_GET['p_id']) && !empty($_GET['p_id'])){ echo $email; } ?>" class="form-control" required />
                        </div>
                        
                        <div class="col-md-12 margin-bottom-10">
                        	<label>Full Address</label>
                            <textarea class="form-control" name="address2" placeholder="Please Enter Address.." rows="4" required><?php if(isset($_GET['p_id']) && !empty($_GET['p_id'])){ echo $address; } ?></textarea>
                        </div>
                        
                        <div class="col-md-6 margin-bottom-10">
                            <input type="submit" name="submit" class="btn btn-primary btn-lg" value="Submit" />
                        </div>
                        
                    </div>
					</form>


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