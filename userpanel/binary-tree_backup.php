<?php
include("header.php");
if(isset($_REQUEST['id']) && $_REQUEST['id']!='')
{
$userids=$_REQUEST['id'];
$stre="select * from user_registration where user_id='$userids' || username='$userids'";
$rese=mysql_query($stre);
$xe=mysql_fetch_array($rese);
$userid=$xe['user_id'];
}
else
{
  $userid=$userid;
  $id=$userid;
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

    <link href="css/style.css" rel="stylesheet" type="text/css">

    <!-- Style CSS -->
    <!-- <link href="css/style.css" rel="stylesheet"> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body class="">
    <div class="animsition">  
    
    
      <!-- - - - - - - - - - - - - -->
      <!-- start of SIDEBAR        -->
      <!-- - - - - - - - - - - - - -->
         <?php include("sidebar.php");?>
      <!-- - - - - - - - - - - - - -->
      <!-- end of SIDEBAR          -->
      <!-- - - - - - - - - - - - - -->


      <main id="playground">

            
        <!-- - - - - - - - - - - - - -->
        <!-- start of TOP NAVIGATION -->
        <!-- - - - - - - - - - - - - -->
                 <?php include("top.php");?>

        <!-- - - - - - - - - - - - - -->
        <!-- end of TOP NAVIGATION   -->
        <!-- - - - - - - - - - - - - -->


        <!-- PAGE TITLE -->
        <section id="page-title" class="row">

          <div class="col-md-8">
            <h1>Downline Members</h1>
            <?php $count112=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='$userid'"));?>
            <p class="lead">You have <span class="label label-warning"><?php echo $count112;?></span> downline members</p>
          </div>

          <div class="col-md-4">

            <ol class="breadcrumb pull-right no-margin-bottom">
                        <li><a href="#">Genealogy</a></li>
              <li class="active">Downline</li>
            </ol>

          </div>
        </section> <!-- / PAGE TITLE -->

        <div class="container-fluid white-bg">

          <div class="row">

            
            
            
            
            
            
            	<div class="col-md-8 center-block">
                    
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
            
            
            
            
            
            
            
            

          </div> <!-- / row -->


        </div> <!-- / container-fluid -->


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

  <script src="js/includes.js"></script>
  <script src="js/sugarrush.js"></script>
  <script src="js/sugarrush.inbox.js"></script>
  </body>
</html>