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
                            Binary Tree
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal" action="binary-tree.php?id=<?php echo $_POST[id]; ?>" role="form" method="get">
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
                            Binary Genealogy
                        </header>
						
				<div class="panel-body">
						<div class="table-responsive">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tree-table table-responsive">
                          <tr>
                          <td width="10%">&nbsp;</td>
                            <td width="10%">&nbsp;</td>
                            <td width="10%"><a href="binary-tree.php?id=<?=$userid?>" class="tooltip1"> <div class="margint10">  <img src="images/meb-1.png" height="50" class="round-border" id="menu_link2"/><br/><br/><?php echo $userid;?><br/><?php echo $f['username'];?> <p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div>
                                  <span><img class="callout" src="images/callout.gif" />
                                  <div class="flyout">
                                  <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                    <tr>
                                      <td align="left">User ID</td>
                                      <td align="left"><?php echo $userid;?></td>
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
                                    <tr>
                                      <td align="left">Total Left</td>
                                      <td align="left"><?php $regf=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='$userid' and leg='left'")); echo $regf; ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Total Right</td>
                                      <td align="left"><?php $regf1=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='$userid' and leg='right'")); echo $regf1; ?></td>
                                    </tr>

                                   

                                    
                                  </table>
                                </div>
                                </span>
                                                                
                                
                                </a></td>
                                    <td width="10%">&nbsp;</td>
                                    <td width="10%">&nbsp;</td>
                                  </tr>
                                  
                                    
                                    
                                  
                                  <tr>
                                    <td></td>
                                    <td></td>
                                    <td><img src="images/line.png" width="2" height="25" alt="img" /></td>
                                    <td></td>
                                    <td></td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td class="bd-btm" colspan="3"></td>
                                    <td></td>
                                
                                  </tr>
                                  <tr>
                                
                                    <td colspan="2"><img src="images/line.png" width="2" height="25" alt="img" style="margin-left:2px;" /></td>
                                    <td>&nbsp;</td>
                                    <td colspan="2"><img src="images/line.png" width="2" height="25" alt="img" style="margin-right:2px;" /></td>
                                
                                
                                  </tr>


<?php
$table='user_registration';
/*first level two user start here */
$fetch1=mysql_fetch_array(mysql_query("select * from $table where nom_id='$userid' and binary_pos='left' limit 1"));
$info1=$fetch1['user_id'];
$user1=mysql_fetch_array(mysql_query("select * from user_registration where user_id='$info1'"));
$fetch8=mysql_fetch_array(mysql_query("select * from $table where nom_id='$userid' and binary_pos='right' limit 1"));
$info8=$fetch8['user_id'];
$user8=mysql_fetch_array(mysql_query("select * from user_registration where user_id='$info8'"));
/*first level two user end here */
  
/*second level four user start here */
$fetch2=mysql_fetch_array(mysql_query("select * from $table where nom_id='$info1' and binary_pos='left' limit 1"));
$info2=$fetch2['user_id'];
$user2=mysql_fetch_array(mysql_query("select * from user_registration where user_id='$info2'"));
$fetch5=mysql_fetch_array(mysql_query("select * from $table where nom_id='$info1' and binary_pos='right' limit 1"));
$info5=$fetch5['user_id'];
$user5=mysql_fetch_array(mysql_query("select * from user_registration where user_id='$info5'"));

$fetch9=mysql_fetch_array(mysql_query("select * from $table where nom_id='$info8' and binary_pos='left' limit 1"));
$info9=$fetch9['user_id'];
$user9=mysql_fetch_array(mysql_query("select * from user_registration where user_id='$info9'"));
  
$fetch12=mysql_fetch_array(mysql_query("select * from $table where nom_id='$info8' and binary_pos='right' limit 1"));
$info12=$fetch12['user_id'];
$user12=mysql_fetch_array(mysql_query("select * from user_registration where user_id='$info12'"));
  
/*second level four user ends here */
  
/*third level eight user starts here */
  
$fetch3=mysql_fetch_array(mysql_query("select * from $table where nom_id='$info2' and binary_pos='left' limit 1"));
$info3=$fetch3['user_id'];
$user3=mysql_fetch_array(mysql_query("select * from user_registration where user_id='$info3'"));
  
$fetch4=mysql_fetch_array(mysql_query("select * from $table where nom_id='$info2' and binary_pos='right' limit 1"));
$info4=$fetch4['user_id'];
$user4=mysql_fetch_array(mysql_query("select * from user_registration where user_id='$info4'"));
 
$fetch6=mysql_fetch_array(mysql_query("select * from $table where nom_id='$info5' and binary_pos='left' limit 1"));
$info6=$fetch6['user_id'];
$user6=mysql_fetch_array(mysql_query("select * from user_registration where user_id='$info6'"));
  
$fetch7=mysql_fetch_array(mysql_query("select * from $table where nom_id='$info5' and binary_pos='right' limit 1"));
$info7=$fetch7['user_id'];
$user7=mysql_fetch_array(mysql_query("select * from user_registration where user_id='$info7'"));
  
$fetch10=mysql_fetch_array(mysql_query("select * from $table where nom_id='$info9' and binary_pos='left' limit 1"));
$info10=$fetch10['user_id'];
$user10=mysql_fetch_array(mysql_query("select * from user_registration where user_id='$info10'"));
  
$fetch11=mysql_fetch_array(mysql_query("select * from $table where nom_id='$info9' and binary_pos='right' limit 1"));
$info11=$fetch11['user_id'];
$user11=mysql_fetch_array(mysql_query("select * from user_registration where user_id='$info11'"));
  
$fetch13=mysql_fetch_array(mysql_query("select * from $table where nom_id='$info12' and binary_pos='left' limit 1"));
$info13=$fetch13['user_id'];
$user13=mysql_fetch_array(mysql_query("select * from user_registration where user_id='$info13'"));
  
$fetch14=mysql_fetch_array(mysql_query("select * from $table where nom_id='$info12' and binary_pos='right' limit 1"));
$info14=$fetch14['user_id'];
$user14=mysql_fetch_array(mysql_query("select * from user_registration where user_id='$info14'"));
/*third level eight user ends here */
?>
  
                                  <tr>
                                
                                    <td colspan="2"><a  href="binary-tree.php?id=<?=$user1['user_id'];?>"  class="tooltip1"> <div class="margint10">  
                                    <img src="images/meb-2.png" height="50" class="round-border" style="margin-top:-60px;"  id="menu_link2"/><br/><br/><?=$user1['user_id']?><br/><?=$user1['username']?>  <p class="border-green" style="width:40px; margin:1em 0 0 0; padding:0"></p></div>
                                  
                                  <span>
                                  <img class="callout" src="images/callout.gif" />
                                  <div class="flyout">
                                  <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                    <tr>
                                      <td align="left">User ID</td>
                                      <td align="left"><?=$user1['user_id'] ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Full  Name</td>
                                      <td align="left"><?=$user1['first_name']." ".$user1['last_name'] ?></td>
                                    </tr>
                                   
                                    <tr>
                                   
                                      <td align="left">Country</td>
                                      <td align="left"><?=$user1['country'];?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Email</td>
                                      <td align="left"><?php echo $user1['email']; ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Sponsor  ID</td>
                                      <td align="left"><?php echo $user1['ref_id']; ?></td>
                                    </tr>

                                    <tr>
                                      <td align="left">D.O.J</td>
                                      <td align="left"><?php echo $user1['registration_date']; ?></td>
                                    </tr>

                                     <tr>
                                      <td align="left">User status</td>
                                      <td align="left"><?php if($user1['user_status']==0 && ['user_status']!='') { echo "Activate"; } else { echo "Deactivate"; } ?></td>
                                    </tr>

                                     <tr>
                                      <td align="left">Total Left user</td>
                                      <td align="left"><?php $regf=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='".$user1['user_id']."' and leg='left'")); echo $regf; ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Total Right User</td>
                                      <td align="left"><?php $regf1=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='".$user1['user_id']."' and leg='right'")); echo $regf1; ?></td>
                                    </tr>

                                  </table>
                                  </div></span>
                                  </a>
                                  
                                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tree-table">
                                  <tr>
                                    <td width="10%"></td>
                                    <td width="10%"></td>
                                    <td width="10%"><img src="images/line.png" width="2" height="25" alt="img"></td>
                                    <td width="10%"></td>
                                    <td width="10%"></td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td class="bd-btm" colspan="3"></td>
                                    <td></td>
                                
                                  </tr>
                                  <tr>
                                
                                    <td colspan="2"><img src="images/line.png" width="2" height="25" alt="img" style="margin-left:2px;" /></td>
                                    <td>&nbsp;</td>
                                    <td colspan="2"><img src="images/line.png" width="2" height="25" alt="img" style="margin-right:2px;" /></td>
                                
                                  </tr>
                                  <tr>
                                   
                                        <td colspan="2"><a  href="binary-tree.php?id=<?=$user2['user_id']?>"  class="tooltip1"> <div class="margint10">  
                                        <img src="images/meb-3.png" height="50" class="round-border" id="menu_link2"/><br/><?=$user2['user_id']?><br/><?=$user2['username']?> <p class="border-green" style="width:40px; margin:1em 0 0 0; padding:0"></p></div>
       
                                  
                                  <span>
                                  <img class="callout" src="images/callout.gif" />
                                  <div class="flyout">
                                  <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                     <tr>
                                      <td align="left">User ID</td>
                                      <td align="left"><?=$user2['user_id'] ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Full  Name</td>
                                      <td align="left"><?=$user2['first_name']." ".$user2['last_name'] ?></td>
                                    </tr>
                                   
                                    <tr>
                                   
                                      <td align="left">Country</td>
                                      <td align="left"><?=$user2['country'];?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Email</td>
                                      <td align="left"><?php echo $user2['email']; ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Sponsor  ID</td>
                                      <td align="left"><?php echo $user2['ref_id']; ?></td>
                                    </tr>

                                    <tr>
                                      <td align="left">D.O.J</td>
                                      <td align="left"><?php echo $user2['registration_date']; ?></td>
                                    </tr>

                                     <tr>
                                      <td align="left">User status</td>
                                      <td align="left"><?php if($user2['user_status']==0 && ['user_status']!='') { echo "Activate"; } else { echo "Deactivate"; } ?></td>
                                    </tr>
<tr>
                                      <td align="left">Total Left User</td>
                                      <td align="left"><?php $regf=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='".$user2['user_id']."' and leg='left'")); echo $regf; ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Total Right User</td>
                                      <td align="left"><?php $regf1=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='".$user2['user_id']."' and leg='right'")); echo $regf1; ?></td>
                                    </tr>

                                  </table>
                                </div></span>
                                </a>
                                
                                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tree-table">
                                  <tr>
                                    <td width="10%"></td>
                                    <td width="10%"></td>
                                    <td width="10%"><img src="images/line.png" width="2" height="25" alt="img"></td>
                                    <td width="10%"></td>
                                    <td width="10%"></td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td class="bd-btm" colspan="3"></td>
                                    <td></td>
                                
                                  </tr>
                                  <tr>
                                
                                    <td colspan="2"><img src="images/line.png" width="2" height="25" alt="img" style="margin-left:2px;" /></td>
                                    <td>&nbsp;</td>
                                    <td colspan="2"><img src="images/line.png" width="2" height="25" alt="img" style="margin-right:2px;" /></td>
                                
                                
                                  </tr>
                                  <tr>
                            
                                <td colspan="2"><a  href="binary-tree.php?id=<?=$user3['user_id']?>"  class="tooltip1"> <div class="margint10">  
                                <img src="images/meb-4.png" height="50" class="round-border" id="menu_link2"/><br/><?=$user3['user_id']?><br/><?=$user3['username']?>  <p class="border-green" style="width:40px; margin:1em 0 0 0; padding:0"></p></div>
                                  
                                  <span>
                                  <img class="callout" src="images/callout.gif" />
                                  <div class="flyout">
                                  <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                    <tr>
                                      <td align="left">User ID</td>
                                      <td align="left"><?=$user3['user_id'] ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Full  Name</td>
                                      <td align="left"><?=$user3['first_name']." ".$user3['last_name'] ?></td>
                                    </tr>
                                   
                                    <tr>
                                   
                                      <td align="left">Country</td>
                                      <td align="left"><?=$user3['country'];?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Email</td>
                                      <td align="left"><?php echo $user3['email']; ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Sponsor  ID</td>
                                      <td align="left"><?php echo $user3['ref_id']; ?></td>
                                    </tr>

                                    <tr>
                                      <td align="left">D.O.J</td>
                                      <td align="left"><?php echo $user3['registration_date']; ?></td>
                                    </tr>

                                     <tr>
                                      <td align="left">User status</td>
                                      <td align="left"><?php if($user3['user_status']==0 && ['user_status']!='') { echo "Activate"; } else { echo "Deactivate"; } ?></td>
                                    </tr>
<tr>
                                      <td align="left">Total Left User</td>
                                      <td align="left"><?php $regf=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='".$user3['user_id']."' and leg='left'")); echo $regf; ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Total Right User</td>
                                      <td align="left"><?php $regf1=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='".$user3['user_id']."' and leg='right'")); echo $regf1; ?></td>
                                    </tr>
                                  </table>
                                </div></span>
                                </a></td>
                                
                                    <td>&nbsp;</td>
                                    <td colspan="2"><a  href="binary-tree.php?id=<?=$user4['user_id']?>" class="tooltip1"> <div class="margint10">  
                                    <img src="images/meb-5.png" class="round-border" height="50" id="menu_link2"/><br/><br/><br/><br/><p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div> <span>
                                  <img class="callout" src="images/callout.gif" />
                                  <div class="flyout">
                                  <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                   <tr>
                                      <td align="left">User ID</td>
                                      <td align="left"><?=$user4['user_id'] ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Full  Name</td>
                                      <td align="left"><?=$user4['first_name']." ".$user4['last_name'] ?></td>
                                    </tr>
                                   
                                    <tr>
                                   
                                      <td align="left">Country</td>
                                      <td align="left"><?=$user4['country'];?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Email</td>
                                      <td align="left"><?php echo $user4['email']; ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Sponsor  ID</td>
                                      <td align="left"><?php echo $user4['ref_id']; ?></td>
                                    </tr>

                                    <tr>
                                      <td align="left">D.O.J</td>
                                      <td align="left"><?php echo $user4['registration_date']; ?></td>
                                    </tr>

                                     <tr>
                                      <td align="left">User status</td>
                                      <td align="left"><?php if($user4['user_status']==0 && ['user_status']!='') { echo "Activate"; } else { echo "Deactivate"; } ?></td>
                                    </tr>
  <tr>
                                      <td align="left">Total Left User</td>
                                      <td align="left"><?php $regf=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='".$user4['user_id']."' and leg='left'")); echo $regf; ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Total Right User</td>
                                      <td align="left"><?php $regf1=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='".$user4['user_id']."' and leg='right'")); echo $regf1; ?></td>
                                    </tr>

                                  </table>
                                </div></span>
                                </a></td>
                                
                                  </tr>
                                </table>
    
                                </td>
                                <td>&nbsp;</td>
                                <td colspan="2"><a  href="binary-tree.php?id=<?=$user5['user_id']?>"  class="tooltip1"> <div class="margint10">  
                                <img src="images/meb-1.png" class="round-border" height="50" style="margin-top:-20px; margin-bottom:20px;" id="menu_link2"/><br/><?=$user5['user_id']?><br/><?=$user5['username']?>  <p class="border-green" style="width:40px; margin:1em 0 0 0; padding:0"></p></div>
                                                                    
                                  <span>
                                  <img class="callout" src="images/callout.gif" />
                                  <div class="flyout">
                                  <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                    <tr>
                                      <td align="left">User ID</td>
                                      <td align="left"><?=$user5['user_id'] ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Full  Name</td>
                                      <td align="left"><?=$user5['first_name']." ".$user5['last_name'] ?></td>
                                    </tr>
                                   
                                    <tr>
                                   
                                      <td align="left">Country</td>
                                      <td align="left"><?=$user5['country'];?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Email</td>
                                      <td align="left"><?php echo $user5['email']; ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Sponsor  ID</td>
                                      <td align="left"><?php echo $user5['ref_id']; ?></td>
                                    </tr>

                                    <tr>
                                      <td align="left">D.O.J</td>
                                      <td align="left"><?php echo $user5['registration_date']; ?></td>
                                    </tr>

                                     <tr>
                                      <td align="left">User status</td>
                                      <td align="left"><?php if($user5['user_status']==0 && ['user_status']!='') { echo "Activate"; } else { echo "Deactivate"; } ?></td>
                                    </tr>
 <tr>
                                      <td align="left">Total Left User</td>
                                      <td align="left"><?php $regf=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='".$user5['user_id']."' and leg='left'")); echo $regf; ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Total Right User</td>
                                      <td align="left"><?php $regf1=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='".$user5['user_id']."' and leg='right'")); echo $regf1; ?></td>
                                    </tr>

                                  </table>
                                </div></span>
                                </a>
                                
                                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tree-table">
                              
                                  <tr>
                                    <td width="10%"></td>
                                    <td width="10%"></td>
                                    <td width="10%"><img src="images/line.png" width="2" height="25" alt="img"></td>
                                    <td width="10%"></td>
                                    <td width="10%"></td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td class="bd-btm" colspan="3"></td>
                                    <td></td>
                                
                                  </tr>
                                  <tr>
                                
                                    <td colspan="2"><img src="images/line.png" width="2" height="25" alt="img" style="margin-left:2px;" /></td>
                                    <td>&nbsp;</td>
                                    <td colspan="2"><img src="images/line.png" width="2" height="25" alt="img" style="margin-right:2px;" /></td>
                                
                                
                                  </tr>
                                  <tr>
                                
                                    <td colspan="2"><a  href="binary-tree.php?id=<?=$user6['user_id']?>"  class="tooltip1"> 
                                    <div class="margint10">  
                                    <img src="images/meb-3.png" height="50" class="round-border" id="menu_link2"/><br/><?=$user6['user_id']?><br/><?=$user6['username']?><br/> <p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div>
                                                                                                 <span>
                                  <img class="callout" src="images/callout.gif" />
                                  <div class="flyout">
                                  <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                   <tr>
                                      <td align="left">User ID</td>
                                      <td align="left"><?=$user6['user_id'] ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Full  Name</td>
                                      <td align="left"><?=$user6['first_name']." ".$user6['last_name'] ?></td>
                                    </tr>
                                   
                                    <tr>
                                   
                                      <td align="left">Country</td>
                                      <td align="left"><?=$user6['country'];?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Email</td>
                                      <td align="left"><?php echo $user6['email']; ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Sponsor  ID</td>
                                      <td align="left"><?php echo $user6['ref_id']; ?></td>
                                    </tr>

                                    <tr>
                                      <td align="left">D.O.J</td>
                                      <td align="left"><?php echo $user6['registration_date']; ?></td>
                                    </tr>
  <tr>
                                      <td align="left">User status</td>
                                      <td align="left"><?php if($user6['user_status']==0 && ['user_status']!='') { echo "Activate"; } else { echo "Deactivate"; } ?></td>
                                    </tr>
                                   <tr>
                                      <td align="left">Total Left User</td>
                                      <td align="left"><?php $regf=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='".$user6['user_id']."' and leg='left'")); echo $regf; ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Total Right User</td>
                                      <td align="left"><?php $regf1=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='".$user6['user_id']."' and leg='right'")); echo $regf1; ?></td>
                                    </tr>

                                  </table>
                                </div></span>  </a></td>
                                    <td>&nbsp;</td>
                                    <td colspan="2"><a  href="binary-tree.php?id=<?=$user7['user_id']?>"  class="tooltip1"> 
                                    <div class="margint10">  <img src="images/meb-7.png" height="50" class="round-border" id="menu_link2"/><br/><?=$user7['user_id']?><br/><?=$user7['username']?><br/> <p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div> <span>
                                  <img class="callout" src="images/callout.gif" />
                                  <div class="flyout">
                                  <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                     <tr>
                                      <td align="left">User ID</td>
                                      <td align="left"><?=$user7['user_id'] ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Full  Name</td>
                                      <td align="left"><?=$user7['first_name']." ".$user7['last_name'] ?></td>
                                    </tr>
                                   
                                    <tr>
                                   
                                      <td align="left">Country</td>
                                      <td align="left"><?=$user7['country'];?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Email</td>
                                      <td align="left"><?php echo $user7['email']; ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Sponsor  ID</td>
                                      <td align="left"><?php echo $user7['ref_id']; ?></td>
                                    </tr>

                                    <tr>
                                      <td align="left">D.O.J</td>
                                      <td align="left"><?php echo $user7['registration_date']; ?></td>
                                    </tr>

                                     <tr>
                                      <td align="left">User status</td>
                                      <td align="left"><?php if($user7['user_status']==0 && ['user_status']!='') { echo "Activate"; } else { echo "Deactivate"; } ?></td>
                                    </tr>
   <tr>
                                      <td align="left">Total Left User</td>
                                      <td align="left"><?php $regf=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='".$user7['user_id']."' and leg='left'")); echo $regf; ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Total Right User</td>
                                      <td align="left"><?php $regf1=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='".$user7['user_id']."' and leg='right'")); echo $regf1; ?></td>
                                    </tr>

                                  </table>
                                </div></span>
                                                                                                  </a></td>
                                
                                  </tr>
                                </table>
                                    </td>
                                
                                  </tr>
                                </table>
                                
                                    </td>
                                    <td>&nbsp;</td>
                                    <td colspan="2"><a  href="binary-tree.php?id=<?=$user8['user_id']?>"  class="tooltip1"> <div class="margint10">  <br/><br/><br/>
                                    <img src="images/meb-6.png" style="margin-top:-63px;" height="50" class="round-border" id="menu_link2"/><br/><br/><?=$user8['user_id']?><br/><?=$user8['username']?><br/> <p class="border-green" style="width:40px; margin:1em 0 0 0; padding:0"></p></div>
    
                                 <span>
                                 <img class="callout" src="images/callout.gif" />
                                 <div class="flyout">
                                  <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                    <tr>
                                      <td align="left">User ID</td>
                                      <td align="left"><?=$user8['user_id'] ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Full  Name</td>
                                      <td align="left"><?=$user8['first_name']." ".$user8['last_name'] ?></td>
                                    </tr>
                                   
                                    <tr>
                                   
                                      <td align="left">Country</td>
                                      <td align="left"><?=$user8['country'];?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Email</td>
                                      <td align="left"><?php echo $user8['email']; ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Sponsor  ID</td>
                                      <td align="left"><?php echo $user8['ref_id']; ?></td>
                                    </tr>

                                    <tr>
                                      <td align="left">D.O.J</td>
                                      <td align="left"><?php echo $user8['registration_date']; ?></td>
                                    </tr>

                                     <tr>
                                      <td align="left">User status</td>
                                      <td align="left"><?php if($user8['user_status']==0 && ['user_status']!='') { echo "Activate"; } else { echo "Deactivate"; } ?></td>
                                    </tr>
   <tr>
                                      <td align="left">Total Left User</td>
                                      <td align="left"><?php $regf=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='".$user8['user_id']."' and leg='left'")); echo $regf; ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Total Right User</td>
                                      <td align="left"><?php $regf1=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='".$user8['user_id']."' and leg='right'")); echo $regf1; ?></td>
                                    </tr>

                                   

                                    
                                  </table>
                                </div></span>
                                </a>
                                
                                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tree-table">
                              
                                  <tr>
                                    <td width="10%"></td>
                                    <td width="10%"></td>
                                    <td width="10%"><img src="images/line.png" width="2" height="25" alt="img"></td>
                                    <td width="10%"></td>
                                    <td width="10%"></td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td class="bd-btm" colspan="3"></td>
                                    <td></td>
                                
                                  </tr>
                                  <tr>
                                
                                    <td colspan="2"><img src="images/line.png" width="2" height="25" alt="img" style="margin-left:2px;" /></td>
                                    <td>&nbsp;</td>
                                    <td colspan="2"><img src="images/line.png" width="2" height="25" alt="img" style="margin-right:2px;" /></td>
                                
                                
                                  </tr>
                                  <tr>
                                
                                    <td colspan="2"><a  href="binary-tree.php?id=<?=$user9['user_id']?>"  class="tooltip1"> 
                                    <div class="margint10"> 
                                    <img src="images/meb-4.png" height="50" class="round-border" id="menu_link2"/><br/><br/><?=$user9['user_id']?><br/><?=$user9['username']?>  <br/><p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div>
                                     <span>
                                 <img class="callout" src="images/callout.gif" />
                                 <div class="flyout">
                                  <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                   <tr>
                                      <td align="left">User ID</td>
                                      <td align="left"><?=$user9['user_id'] ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Full  Name</td>
                                      <td align="left"><?=$user9['first_name']." ".$user9['last_name'] ?></td>
                                    </tr>
                                   
                                    <tr>
                                   
                                      <td align="left">Country</td>
                                      <td align="left"><?=$user9['country'];?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Email</td>
                                      <td align="left"><?php echo $user9['email']; ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Sponsor  ID</td>
                                      <td align="left"><?php echo $user9['ref_id']; ?></td>
                                    </tr>

                                    <tr>
                                      <td align="left">D.O.J</td>
                                      <td align="left"><?php echo $user9['registration_date']; ?></td>
                                    </tr>
  <tr>
                                      <td align="left">User status</td>
                                      <td align="left"><?php if($user9['user_status']==0 && ['user_status']!='') { echo "Activate"; } else { echo "Deactivate"; } ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Total Left User</td>
                                      <td align="left"><?php $regf=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='".$user9['user_id']."' and leg='left'")); echo $regf; ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Total Right User</td>
                                      <td align="left"><?php $regf1=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='".$user9['user_id']."' and leg='right'")); echo $regf1; ?></td>
                                    </tr>

                                   

                                    
                                  </table>
                                </div></span>
                                                                                                  </a>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tree-table">
                                  
                                  <tr>
                                    <td width="10%"></td>
                                    <td width="10%"></td>
                                    <td width="10%"><img src="images/line.png" width="2" height="25" alt="img"></td>
                                    <td width="10%"></td>
                                    <td width="10%"></td>
                                  </tr>
                                
                                  <tr>
                                    <td></td>
                                    <td class="bd-btm" colspan="3"></td>
                                    <td></td>
                                
                                  </tr>
                                  <tr>
                                
                                    <td colspan="2"><img src="images/line.png" width="2" height="25" alt="img" style="margin-left:2px;" /></td>
                                    <td>&nbsp;</td>
                                    <td colspan="2"><img src="images/line.png" width="2" height="25" alt="img" style="margin-right:2px;" /></td>
                                
                                
                                  </tr>
                                  <tr>
                                
                                    <td colspan="2"><a  href="binary-tree.php?id=<?=$user10['user_id']?>" class="tooltip1"> <div class="margint10">  
                                    <img src="images/meb-8.png" height="50" class="round-border" id="menu_link2"/><br/><br/><?=$user10['user_id']?><br/><?=$user10['username']?> <br/> <p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div>
<span>
                                 <img class="callout" src="images/callout.gif" />
                                 <div class="flyout">
                                  <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                   <tr>
                                      <td align="left">User ID</td>
                                      <td align="left"><?=$user10['user_id'] ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Full  Name</td>
                                      <td align="left"><?=$user10['first_name']." ".$user10['last_name'] ?></td>
                                    </tr>
                                   
                                    <tr>
                                   
                                      <td align="left">Country</td>
                                      <td align="left"><?=$user10['country'];?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Email</td>
                                      <td align="left"><?php echo $user10['email']; ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Sponsor  ID</td>
                                      <td align="left"><?php echo $user10['ref_id']; ?></td>
                                    </tr>

                                    <tr>
                                      <td align="left">D.O.J</td>
                                      <td align="left"><?php echo $user10['registration_date']; ?></td>
                                    </tr>

                                     <tr>
                                      <td align="left">User status</td>
                                      <td align="left"><?php if($user10['user_status']==0 && ['user_status']!='') { echo "Activate"; } else { echo "Deactivate"; } ?></td>
                                    </tr>

                                       <tr>
                                      <td align="left">Total Left User</td>
                                      <td align="left"><?php $regf=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='".$user10['user_id']."' and leg='left'")); echo $regf; ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Total Right User</td>
                                      <td align="left"><?php $regf1=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='".$user10['user_id']."' and leg='right'")); echo $regf1; ?></td>
                                    </tr>

                                   

                                    
                                  </table>
                                </div></span>
                                    </a></td>
                                    
                                    <td>&nbsp;</td>
                                    <td colspan="2"><a  href="binary-tree.php?id=<?=$user11['user_id']?>" class="tooltip1"> <div class="margint10">  
                                    <img src="images/meb-2.png" height="50" class="round-border" id="menu_link2"/><br/><br/><br/><?=$user11['user_id']?><br/><?=$user11['username']?>  <br/> <p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div>
                                                                                                 <span>
                                 <img class="callout" src="images/callout.gif" />
                                 <div class="flyout">
                                  <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                   <tr>
                                      <td align="left">User ID</td>
                                      <td align="left"><?=$user11['user_id'] ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Full  Name</td>
                                      <td align="left"><?=$user11['first_name']." ".$user11['last_name'] ?></td>
                                    </tr>
                                   
                                    <tr>
                                   
                                      <td align="left">Country</td>
                                      <td align="left"><?=$user11['country'];?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Email</td>
                                      <td align="left"><?php echo $user11['email']; ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Sponsor  ID</td>
                                      <td align="left"><?php echo $user11['ref_id']; ?></td>
                                    </tr>

                                    <tr>
                                      <td align="left">D.O.J</td>
                                      <td align="left"><?php echo $user11['registration_date']; ?></td>
                                    </tr>
  <tr>
                                      <td align="left">User status</td>
                                      <td align="left"><?php if($user11['user_status']==0 && $user11['user_status']!='') { echo "Activate"; } else { echo "Deactivate"; } ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Total Left User</td>
                                      <td align="left"><?php $regf=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='".$user11['user_id']."' and leg='left'")); echo $regf; ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Total Right User</td>
                                      <td align="left"><?php $regf1=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='".$user11['user_id']."' and leg='right'")); echo $regf1; ?></td>
                                    </tr>

                                   

                                    
                                  </table>
                                </div></span> </a></td>
                                
                                  </tr>
                                </table>
                                </td>
                                <td>&nbsp;</td>
                                <td colspan="2"><a  href="binary-tree.php?id=<?=$user12['user_id']?>" class="tooltip1"> 
                                <div class="margint10">  
                                <img src="images/meb-5.png" height="50" class="round-border" id="menu_link2"/><br/><br/><?=$user12['user_id']?><br/><?=$user12['username']?> <br/><br/> <p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div>
                                                                   <span>
                                 <img class="callout" src="images/callout.gif" />
                                 <div class="flyout">
                                  <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                   <tr>
                                      <td align="left">User ID</td>
                                      <td align="left"><?=$user12['user_id'] ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Full  Name</td>
                                      <td align="left"><?=$user12['first_name']." ".$user12['last_name'] ?></td>
                                    </tr>
                                   
                                    <tr>
                                   
                                      <td align="left">Country</td>
                                      <td align="left"><?=$user12['country'];?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Email</td>
                                      <td align="left"><?php echo $user12['email']; ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Sponsor  ID</td>
                                      <td align="left"><?php echo $user12['ref_id']; ?></td>
                                    </tr>

                                    <tr>
                                      <td align="left">D.O.J</td>
                                      <td align="left"><?php echo $user12['registration_date']; ?></td>
                                    </tr>
  <tr>
                                      <td align="left">User status</td>
                                      <td align="left"><?php if($user12['user_status']==0 && ['user_status']!='') { echo "Activate"; } else { echo "Deactivate"; } ?></td>
                                    </tr>
                                   
 <tr>
                                      <td align="left">Total Left User</td>
                                      <td align="left"><?php $regf=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='".$user12['user_id']."' and leg='left'")); echo $regf; ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Total Right User</td>
                                      <td align="left"><?php $regf1=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='".$user12['user_id']."' and leg='right'")); echo $regf1; ?></td>
                                    </tr>

                                   

                                    
                                  </table>
                                </div></span>  </a>                            </a>
                                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tree-table">
                              
                              <tr>
                                <td width="10%"></td>
                                <td width="10%"></td>
                                <td width="10%"><img src="images/line.png" width="2" height="25" alt="img"></td>
                                <td width="10%"></td>
                                <td width="10%"></td>
                              </tr>
                              <tr>
                                <td></td>
                                <td class="bd-btm" colspan="3"></td>
                                <td></td>
                            
                              </tr>
                              <tr>
                            
                                <td colspan="2"><img src="images/line.png" width="2" height="25" alt="img" style="margin-left:2px;" /></td>
                                <td>&nbsp;</td>
                                <td colspan="2"><img src="images/line.png" width="2" height="25" alt="img" style="margin-right:2px;" /></td>
                            
                            
                              </tr>
                              <tr>
                            
                                <td colspan="2"><a  href="binary-tree.php?id=<?=$user13['user_id']?>" class="tooltip1"> <div class="margint10">  
                                <img src="images/meb-2.png" height="50" class="round-border" id="menu_link2"/><br/><br/><br/><?=$user13['user_id']?><br/><?=$user13['username']?> <br/> <p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div>
                                                                                            <span>
                                 <img class="callout" src="images/callout.gif" />
                                 <div class="flyout">
                                  <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                   <tr>
                                      <td align="left">User ID</td>
                                      <td align="left"><?=$user13['user_id'] ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Full  Name</td>
                                      <td align="left"><?=$user13['first_name']." ".$user13['last_name'] ?></td>
                                    </tr>
                                   
                                    <tr>
                                   
                                      <td align="left">Country</td>
                                      <td align="left"><?=$user13['country'];?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Email</td>
                                      <td align="left"><?php echo $user13['email']; ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Sponsor  ID</td>
                                      <td align="left"><?php echo $user13['ref_id']; ?></td>
                                    </tr>

                                    <tr>
                                      <td align="left">D.O.J</td>
                                      <td align="left"><?php echo $user13['registration_date']; ?></td>
                                    </tr>
  <tr>
                                      <td align="left">User status</td>
                                      <td align="left"><?php if($user13['user_status']==0 && $user13['user_status']!='') { echo "Activate"; } else { echo "Deactivate"; } ?></td>
                                    </tr>
                                   
 <tr>
                                      <td align="left">Total Left User</td>
                                      <td align="left"><?php $regf=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='".$user13['user_id']."' and leg='left'")); echo $regf; ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Total Right User</td>
                                      <td align="left"><?php $regf1=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='".$user13['user_id']."' and leg='right'")); echo $regf1; ?></td>
                                    </tr>

                                   

                                    
                                  </table>
                                </div></span>  </a></td>
                                <td>&nbsp;</td>
                                <td colspan="2"><a  href="binary-tree.php?id=<?=$user14['user_id']?>"  class="tooltip1"> <div class="margint10">  
                                <img src="images/meb-3.png" height="50" class="round-border" id="menu_link2"/><br/><br/><br/><?=$user14['user_id']?><br/><?=$user14['username']?>  <br/> <p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div>
                                                                                          <span>
                                 <img class="callout" src="images/callout.gif" />
                                 <div class="flyout">
                                  <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                  <tr>
                                      <td align="left">User ID</td>
                                      <td align="left"><?=$user14['user_id'] ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Full  Name</td>
                                      <td align="left"><?=$user14['first_name']." ".$user14['last_name'] ?></td>
                                    </tr>
                                   
                                    <tr>
                                   
                                      <td align="left">Country</td>
                                      <td align="left"><?=$user14['country'];?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Email</td>
                                      <td align="left"><?php echo $user14['email']; ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Sponsor  ID</td>
                                      <td align="left"><?php echo $user14['ref_id']; ?></td>
                                    </tr>

                                    <tr>
                                      <td align="left">D.O.J</td>
                                      <td align="left"><?php echo $user14['registration_date']; ?></td>
                                    </tr>

                                     <tr>
                                      <td align="left">User status</td>
                                      <td align="left"><?php if($user14['user_status']==0 && $user14['user_status']!='') { echo "Activate"; } else { echo "Deactivate"; } ?></td>
                                    </tr>
 <tr>
                                      <td align="left">Total Left User</td>
                                      <td align="left"><?php $regf=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='".$user14['user_id']."' and leg='left'")); echo $regf; ?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">Total Right User</td>
                                      <td align="left"><?php $regf1=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='".$user14['user_id']."' and leg='right'")); echo $regf1; ?></td>
                                    </tr>

                                   

                                    
                                  </table>
                                </div></span>    </a></td>
                            
                              </tr>
                            </table>
                        </td>
                    
                      </tr>
                    </table>
                </td>
            
              </tr>
            </table>
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