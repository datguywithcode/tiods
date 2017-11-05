<?php
   include("header.php");
   
   $id=$_SESSION['userpanel_user_id'];
   
  $m="represent.png";
  $fmale="female.jpg";
  $disp="none";
  $pop="";
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
	  
	  <script>
	 
	function usercheck(id,val)
     {
	var urldata = "userId=" + id + "&users=" + val;
   	  $.ajax({
   		  type:'post',
   		  url:'../ajax/user_check.php',
   		  data:urldata,
   		  success:function(html)
   		  {
   			  if (html == "yes")
                               {
   
                                   $('#usermsg').html("This Member isn't in your network");
                                   $('#user_id').focus();
                                   $("#usermsg").addClass("ajaxdiv");
                               }
							   else if (html == "no")
                               {
   
                                   $("#usermsg").removeClass("ajaxdiv");
                                   $('#usermsg').html('');
                               }
                               
   		  }
   		  
   		  
   		  
   	  });
	  
     }
	  
	  </script>
	  
	  
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
				  
                  <?php $count112=mysql_num_rows(mysql_query("select * from level_income_binary where income_id='$id'"));?>
                  <p class="lead">You have <span class="label label-warning"><?php echo $count112;?></span> downline members</p>
               </div>
               <div class="col-md-4">
                  <ol class="breadcrumb pull-right no-margin-bottom">
                     <li><a href="#">Genealogy</a></li>
                     <li class="active">Downline</li>
                  </ol>
               </div>
            </section>
            <!-- / PAGE TITLE -->
            <div class="container-fluid white-bg">
               <div class="row">
			   
			   
			   <div class="panel-body">
                            <!--<form class="form-horizontal" action="binary-tree.php?id=<?php /*?><?php echo $_POST[id]; ?><?php */?>" role="form" method="get">
							    <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-9 col-sm-4 control-label">Search User ID</label>
                                    <div class="col-lg-3">
                                        <input type="text" name="id" class="form-control" placeholder="Enter User ID" required>
									</div>
                                </div>
                               <div class="form-group">
                                    <div class="col-lg-offset-9 col-lg-8">
                                        <input type="submit" class="btn btn-primary" name="Search" value="Submit">
                                    </div>
                                </div>
                            </form>-->
                            
                            
                            <form class="form-inline" action="binary-tree.php?id=<?php echo $_POST[id]; ?>" role="form" method="get">
                              <div class="form-group">
                                <label>Search User ID</label> &nbsp;&nbsp;&nbsp;
                                <input type="text" name="id" class="form-control" id="user_id" onblur=usercheck(this.value,<?php echo $id; ?>); placeholder="Search User ID" required style="margin-top:-5px;">
								
                              </div>
							  
                              
                              <input type="submit" class="btn btn-primary" name="Search" value="Submit"><br>
							  
							  <div style="color:red; margin-left:150px;" id="usermsg"></div>
							  
							  
                            </form>
                        </div>
						
			   
                  <div class="col-md-8 center-block">
                     <div class="table-responsive">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tree-table table-responsive">
                           <tr>
                              <td width="10%">&nbsp;</td>
                              <td width="10%">&nbsp;</td>
                              <td width="10%">
                                 <a href="binary-tree.php?id=<?php echo $userid?>" class="<?php echo $pop; ?>">
                                    <div class="margint10">
									<?php if($f['sex']=="Male"){ $imgs=$m; } if($f['sex']=="Female"){ $imgs=$fmale; } ?>
									
									
                                       <img src="images/<?php echo $imgs; ?>" height="50" class="round-border" id="menu_link2"/><br/><br/><?php echo userName($userid);?><br/><?php echo $f['username'];?> <br><?php echo matchingPoint($userid,'left')."/".matchingPoint($userid,'right'); ?>
                                       <p  style="width:40px; margin:1em 0 0 0; padding:0"></p>
                                    </div>
                                    <span>
                                       <img class="callout" src="images/callout.gif" />
                                       <div class="flyout" style="display:<?php echo $disp; ?>;">
                                          <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                             <tr>
                                                <td align="left">User ID</td>
                                                <td align="left"><?php echo $f['username'];?></td>
                                             </tr>
                                             <tr>
                                                <td align="left">Full  Name</td>
                                                <td align="left"><?php echo $f['first_name'];?> <?php echo $f['last_name'];?></td>
                                             </tr>
											 
											 <tr>
                                                <td align="left">Gender</td>
                                                <td align="left"><?php echo $f['sex'];?></td>
                                             </tr>
											 
                                             <tr>
                                                <td align="left">Country</td>
                                                <td align="left"><?php echo getCountry($f['country']);?></td>
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
                                 </a>
                              </td>
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
                              
                              
                              
                              
                              $info1101 = mysql_num_rows(mysql_query("select * from $table where nom_id='$userid' and binary_pos='left' limit 1"));
                              $info81  = mysql_num_rows(mysql_query("select * from $table where nom_id='$userid' and binary_pos='right' limit 1"));
                              
                              $info21  = mysql_num_rows(mysql_query("select * from $table where nom_id='$info1' and binary_pos='left' limit 1"));
                              $info51  = mysql_num_rows(mysql_query("select * from $table where nom_id='$info1' and binary_pos='right' limit 1"));
                              
                              $info91  = mysql_num_rows(mysql_query("select * from $table where nom_id='$info8' and binary_pos='left' limit 1"));
                              $info121 = mysql_num_rows(mysql_query("select * from $table where nom_id='$info8' and binary_pos='right' limit 1"));
                              
                              $info31  = mysql_num_rows(mysql_query("select * from $table where nom_id='$info2' and binary_pos='left' limit 1"));
                              $info41  = mysql_num_rows(mysql_query("select * from $table where nom_id='$info2' and binary_pos='right' limit 1"));
                              
                              $info61  = mysql_num_rows(mysql_query("select * from $table where nom_id='$info5' and binary_pos='left' limit 1"));
                              $info71  = mysql_num_rows(mysql_query("select * from $table where nom_id='$info5' and binary_pos='right' limit 1"));
                              
                              $info101 = mysql_num_rows(mysql_query("select * from $table where nom_id='$info9' and binary_pos='left' limit 1"));
                              $info111 = mysql_num_rows(mysql_query("select * from $table where nom_id='$info9' and binary_pos='right' limit 1"));
                              
                              $info131 = mysql_num_rows(mysql_query("select * from $table where nom_id='$info12' and binary_pos='left' limit 1"));
                              $info141 = mysql_num_rows(mysql_query("select * from $table where nom_id='$info12' and binary_pos='right' limit 1"));
                                
                              /*third level eight user ends here */
                              
                              
                              
                              
                              
                              if ($info1101 != 0 && $info1101 != '') {
								  
								  if($user1['sex']=="Male")
								  {
									  $img1 = "images/".$m;    
								  }
								  if($user1['sex']=="Female")
								  {
									 $img1 = "images/".$fmale;
									 
								  }
								  
								  
                                 
                              } 
                              else {
                                  $img1 = "images/white-user.gif";
                              }
                              
                              
                              if($info1=='')
                              {
                               $img2 = "images/empty.png";
                               
                               }
                                elseif(empty($user2['user_id']) && $info1!='') 
                                {
                                $img2 = "images/white-user.gif";
                                
                                }
                                else 
                                {
                                if($user2['sex']=="Male")
								  {
									  $img2 = "images/".$m;    
								  }
								  if($user2['sex']=="Female")
								  {
									 $img2 = "images/".$fmale;
									 
								  }
                                }
                              
                              
                              
                              
                              if($info2=='')
                              {
                              
                               $img3 = "images/empty.png";
                               
                               }
                                elseif(empty($user3['user_id']) && $info2!='') 
                                {
                              
                                $img3 = "images/white-user.gif";
                                
                                }
                                else 
                                {
                               
                                if($user3['sex']=="Male")
								  {
									  $img3 = "images/".$m;    
								  }
								  if($user3['sex']=="Female")
								  {
									 $img3 = "images/".$fmale;
									 
								  }
                                }
                              
                              
                              
                              if($info2=='')
                              {
                               $img4 = "images/empty.png";
                               
                               }
                                elseif(empty($user4['user_id']) && $info2!='') 
                                {
                                $img4 = "images/white-user.gif";
                                
                                }
                                else 
                                {
                               if($user4['sex']=="Male")
								  {
									  $img4 = "images/".$m;    
								  }
								  if($user4['sex']=="Female")
								  {
									 $img4 = "images/".$fmale;
									 
								  }
                                }
                              
                              
                              
                              if($info1=='')
                              {
                               $img5 = "images/empty.png";
                               
                               }
                                elseif(empty($user5['user_id']) && $info1!='') 
                                {
                                $img5 = "images/white-user.gif";
                                
                                }
                                else 
                                {
                               if($user5['sex']=="Male")
								  {
									  $img5 = "images/".$m;    
								  }
								  if($user5['sex']=="Female")
								  {
									 $img5 = "images/".$fmale;
									 
								  }
                                }
                              
                              
                              
                              
                              if($info5=='')
                              {
                               $img6 = "images/empty.png";
                               
                               }
                                elseif(empty($user6['user_id']) && $info5!='') 
                                {
                                $img6 = "images/white-user.gif";
                                
                                }
                                else 
                                {
                               if($user6['sex']=="Male")
								  {
									  $img6 = "images/".$m;    
								  }
								  if($user6['sex']=="Female")
								  {
									 $img6 = "images/".$fmale;
									 
								  }
                                }
                                
                                
                                
                               if($info5=='')
                              {
                               $img7 = "images/empty.png";
                               
                               }
                                elseif(empty($user7['user_id']) && $info5!='') 
                                {
                                $img7 = "images/white-user.gif";
                                
                                }
                                else 
                                {
                                 if($user7['sex']=="Male")
								  {
									  $img7 = "images/".$m;    
								  }
								  if($user7['sex']=="Female")
								  {
									 $img7 = "images/".$fmale;
									 
								  }
                                } 
                                
                                
                                
                               if($userid=='')
                              {
                               $img8 = "tree_new.php_files/empty.png";
                               
                               }
                               
                                elseif(empty($user8['user_id']) && $userid!='') 
                                {
                              
                                $img8 = "images/white-user.gif";
                                
                                }
                                else 
                                {
                                if($user8['sex']=="Male")
								  {
									  $img8 = "images/".$m;    
								  }
								  if($user8['sex']=="Female")
								  {
									 $img8 = "images/".$fmale;
									 
								  }
                                } 
                                
                                
                                
                                if($info8=='')
                              {
                               $img9 = "images/empty.png";
                               
                               }
                                elseif(empty($user9['user_id']) && $info8!='') 
                                {
                                $img9 = "images/white-user.gif";
                                
                                }
                                else 
                                {
                                if($user9['sex']=="Male")
								  {
									  $img9 = "images/".$m;    
								  }
								  if($user9['sex']=="Female")
								  {
									 $img9 = "images/".$fmale;
									 
								  }
                                }
                                
                                
                                if($info9=='')
                              {
                               $img10 = "images/empty.png";
                               
                               }
                                elseif(empty($user10['user_id']) && $info9!='') 
                                {
                                $img10 = "images/white-user.gif";
                                
                                }
                                else 
                                {
                                if($user10['sex']=="Male")
								  {
									  $img10 = "images/".$m;    
								  }
								  if($user10['sex']=="Female")
								  {
									 $img10 = "images/".$fmale;
									 
								  }
                                }
                                
                                
                                if($info9=='')
                              {
                               $img11 = "images/empty.png";
                               
                               }
                                elseif(empty($user11['user_id']) && $info9!='') 
                                {
                                $img11 = "images/white-user.gif";
                                
                                }
                                else 
                                {
                                 if($user11['sex']=="Male")
								  {
									  $img11 = "images/".$m;    
								  }
								  if($user11['sex']=="Female")
								  {
									 $img11 = "images/".$fmale;
									 
								  }
                                }
                                
                                
                                
                                if($info8=='')
                              {
                               $img12 = "images/empty.png";
                               
                               }
                                elseif(empty($user12['user_id']) && $info8!='') 
                                {
                                $img12 = "images/white-user.gif";
                                
                                }
                                else 
                                {
                                 if($user12['sex']=="Male")
								  {
									  $img12 = "images/".$m;    
								  }
								  if($user12['sex']=="Female")
								  {
									 $img12 = "images/".$fmale;
									 
								  }
                                }
                                
                                
                                if($info12=='')
                              {
                               $img13 = "images/empty.png";
                               
                               }
                                elseif(empty($user13['user_id']) && $info12!='') 
                                {
                                $img13 = "images/white-user.gif";
                                
                                }
                                else 
                                {
                                if($user13['sex']=="Male")
								  {
									  $img13 = "images/".$m;    
								  }
								  if($user13['sex']=="Female")
								  {
									 $img13 = "images/".$fmale;
									 
								  }
                                }
                                
                                
                                if($info12=='')
                              {
                               $img14 = "images/empty.png";
                               
                               }
                                elseif(empty($user14['user_id']) && $info12!='') 
                                {
                                $img14 = "images/white-user.gif";
                                
                                }
                                else 
                                {
                                 if($user14['sex']=="Male")
								  {
									  $img14 = "images/".$m;    
								  }
								  if($user14['sex']=="Female")
								  {
									 $img14 = "images/".$fmale;
									 
								  }
                                }
                              
                              
                              ?>
                           <tr>
                              <td colspan="2">
                                 <a  <?php if(empty($user1['user_id']) && $userid!='') 
                                    { ?> href="register.php?pl_id=<?php echo $userid;?>&&pos=<?php echo 'left';?>&&sponsor_id=<?php echo $id;?>" target="_blank" <?php } else { ?>href="binary-tree.php?id=<?php echo $user1['user_id']; ?>&&binary=<?php echo 'left';?>" <?php } ?>  class="<?php if(!empty($user1['user_id'])){ echo $pop; } ?>">
                                    <div class="margint10"><img src="<?php echo $img1?>" height="50" class="round-border" style="margin-top:-60px;"  id="menu_link2"/><br/><?php echo userName($user1['user_id'])?><br/><?php echo $user1['username']?><br><?php if(!empty($user1['user_id'])){echo matchingPoint($user1['user_id'],'left')."/".matchingPoint($user1['user_id'],'right'); } ?>  
                                       <p class="border-green" style="width:40px; margin:1em 0 0 0; padding:0"></p>
                                    </div>
                                    <span>
                                       <img class="callout" src="images/callout.gif" />
                                       <div class="flyout" style="<?php if(!empty($user1['user_id'])){ ?>display:<?php echo $disp; } else { ?>display:none;<?php } ?>">
                                          <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                             <tr>
                                                <td align="left">User ID</td>
                                                <td align="left"><?php echo $user1['username'];?></td>
                                             </tr>
                                             <tr>
                                                <td align="left">Full  Name</td>
                                                <td align="left"><?php echo $user1['first_name']." ".$user1['last_name'] ?></td>
                                             </tr>
											 <tr>
                                                <td align="left">Gender</td>
                                                <td align="left"><?php echo $user1['sex'];?></td>
                                             </tr>
                                             <tr>
                                                <td align="left">Country</td>
                                               <td align="left"><?php echo getCountry($user1['country']);?></td>
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
                                       </div>
                                    </span>
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
                                       <td colspan="2">
                                          <?php if($info1!=''){ ?>
                                          <a  <?php if(empty($user2['user_id']) && $info1!='') 
                                             { ?> href="register.php?pl_id=<?php echo $info1;?>&&pos=<?php echo 'left';?>&&sponsor_id=<?php echo $id;?>" target="_blank" <?php } else { ?>href="binary-tree.php?id=<?php echo $user2['user_id']; ?>&&binary=<?php echo 'left';?>" <?php } ?>  class="<?php if(!empty($user2['user_id'])){ echo $pop; } ?>">
                                             <div class="margint10">
                                                <img src="<?php echo $img2; ?>" height="50" class="round-border" id="menu_link2"/>
												<br/><?php echo userName($user2['user_id'])?><br/><?php echo $user2['username']?><br><?php if(!empty($user2['user_id'])){echo matchingPoint($user2['user_id'],'left')."/".matchingPoint($user2['user_id'],'right'); } ?>  
												<p class="border-green" style="width:40px; margin:1em 0 0 0; padding:0"></p>
                                             </div>
                                             <?php } else { ?>
                                             <img src="<?php echo $img2; ?>" height="50" class="round-border" id="menu_link2"/>
                                             <p class="border-green" style="width:40px; margin:1em 0 0 0; padding:0"></p>
                     </div>
                     <?php } ?>
                     <span>
                     <img class="callout" src="images/callout.gif" />
                     <div class="flyout" style="<?php if(!empty($user2['user_id'])){ ?>display:<?php echo $disp; } else { ?>display:none;<?php } ?>">
                     <table width="100%" border="0" cellspacing="1" cellpadding="1">
                     <tr>
                     <td align="left">User ID</td>
                     <td align="left"><?php echo $user2['username'];?></td>
                     </tr>
                     <tr>
                     <td align="left">Full  Name</td>
                     <td align="left"><?php echo $user2['first_name']." ".$user2['last_name'] ?></td>
                     </tr>
					 <tr>
                                                <td align="left">Gender</td>
                                                <td align="left"><?php echo $user2['sex'];?></td>
                                             </tr>
                     <tr>
                     <td align="left">Country</td>
                    <td align="left"><?php echo getCountry($user2['country']);?></td>
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
                     <td colspan="2">
                     <?php if($info2!=''){ ?>
                     <a  <?php if(empty($user3['user_id']) && $info2!='') 
                        { ?> href="register.php?pl_id=<?php echo $info2;?>&&pos=<?php echo 'left';?>&&sponsor_id=<?php echo $id;?>" target="_blank" <?php } else { ?>href="binary-tree.php?id=<?php echo $user3['user_id']; ?>&&binary=<?php echo 'left';?>" <?php } ?>  class="<?php if(!empty($user3['user_id'])){ echo $pop; } ?>"> <div class="margint10"> 
                     <img src="<?php echo $img3; ?>" height="50" class="round-border" id="menu_link2"/><br/><?php echo userName($user3['user_id'])?><br/><?php echo $user3['username']?><br><?php if(!empty($user3['user_id'])){echo matchingPoint($user3['user_id'],'left')."/".matchingPoint($user3['user_id'],'right'); } ?>      <p class="border-green" style="width:40px; margin:1em 0 0 0; padding:0"></p></div>
                     <?php } else { ?>
                     <img src="<?php echo $img3; ?>" height="50" class="round-border" id="menu_link2"/><br/><?php echo $user3['user_id']?><p class="border-green" style="width:40px; margin:1em 0 0 0; padding:0"></p>
                  </div>
                  <?php } ?>
                  <span>
                  <img class="callout" src="images/callout.gif" />
                  <div class="flyout" style="<?php if(!empty($user3['user_id'])){ ?>display:<?php echo $disp; } else { ?>display:none;<?php } ?>">
                  <table width="100%" border="0" cellspacing="1" cellpadding="1">
                  <tr>
                  <td align="left">User ID</td>
                  <td align="left"><?php echo $user3['user_id'] ?></td>
                  </tr>
                  <tr>
                  <td align="left">Full  Name</td>
                  <td align="left"><?php echo $user3['first_name']." ".$user3['last_name'] ?></td>
                  </tr>
				  <tr>
                                                <td align="left">Gender</td>
                                                <td align="left"><?php echo $user3['sex'];?></td>
                                             </tr>
                  <tr>
                  <td align="left">Country</td>
                  <td align="left"><?php echo getCountry($user3['country']);?></td>
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
                  <td colspan="2">
                  <?php if($info2!=''){ ?>
                  <a  <?php if(empty($user4['user_id']) && $info2!='') 
                     { ?> href="register.php?pl_id=<?php echo $info2;?>&&pos=<?php echo 'right';?>&&sponsor_id=<?php echo $id;?>" target="_blank" <?php } else { ?>href="binary-tree.php?id=<?php echo $user4['user_id']; ?>&&binary=<?php echo 'right';?>" <?php } ?>  class="<?php if(!empty($user4['user_id'])){ echo $pop; }  ?>"> <div class="margint10">  
                  <img src="<?php echo $img4; ?>" class="round-border" height="50" id="menu_link2"/><br/><?php echo userName($user4['user_id'])?><br/><?php echo $user4['username']?><br><?php if(!empty($user4['user_id'])){echo matchingPoint($user4['user_id'],'left')."/".matchingPoint($user4['user_id'],'right'); } ?>  <p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div> 
                  <?php } else { ?>
                  <img src="<?php echo $img4; ?>" class="round-border" height="50" id="menu_link2"/><p style="width:40px; margin:1em 0 0 0; padding:0"></p>
               </div>
               <?php } ?>
               <span>
               <img class="callout" src="images/callout.gif" />
               <div class="flyout" style="<?php if(!empty($user4['user_id'])){ ?>display:<?php echo $disp; } else { ?>display:none;<?php } ?>">
               <table width="100%" border="0" cellspacing="1" cellpadding="1">
               <tr>
               <td align="left">User ID</td>
               <td align="left"><?php echo $user4['username'] ?></td>
               </tr>
               <tr>
               <td align="left">Full  Name</td>
               <td align="left"><?php echo $user4['first_name']." ".$user4['last_name'] ?></td>
               </tr>
			   <tr>
                                                <td align="left">Gender</td>
                                                <td align="left"><?php echo $user4['sex'];?></td>
                                             </tr>
               <tr>
               <td align="left">Country</td>
               <td align="left"><?php echo getCountry($user4['country']);?></td>
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
               <td colspan="2"><?php if($info1!=''){ ?>
               <a  <?php if(empty($user5['user_id']) && $info1!='') 
                  { ?> href="register.php?pl_id=<?php echo $info1;?>&&pos=<?php echo 'right';?>&&sponsor_id=<?php echo $id;?>" target="_blank" <?php } else { ?>href="binary-tree.php?id=<?php echo $user5['user_id']; ?>&&binary=<?php echo 'right';?>" <?php } ?>  class="<?php if(!empty($user5['user_id'])){ echo $pop; }  ?>"> <div class="margint10">  
               <img src="<?php echo $img5; ?>" class="round-border" height="50" id="menu_link2"/><br/><?php echo userName($user5['user_id'])?><br/><?php echo $user5['username']?><br><?php if(!empty($user5['user_id'])){echo matchingPoint($user5['user_id'],'left')."/".matchingPoint($user5['user_id'],'right'); } ?>  <p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div> 
               <?php } else { ?>
               <img src="<?php echo $img5; ?>" class="round-border" height="50" id="menu_link2"/><p  style="width:40px; margin:1em 0 0 0; padding:0"></p>
            </div>
            <?php } ?>
            <span>
            <img class="callout" src="images/callout.gif" />
            <div class="flyout" style="<?php if(!empty($user5['user_id'])){ ?>display:<?php echo $disp; } else { ?>display:none;<?php } ?>">
            <table width="100%" border="0" cellspacing="1" cellpadding="1">
            <tr>
            <td align="left">User ID</td>
            <td align="left"><?php echo $user5['username'] ?></td>
            </tr>
            <tr>
            <td align="left">Full  Name</td>
            <td align="left"><?php echo $user5['first_name']." ".$user5['last_name'] ?></td>
            </tr>
			<tr>
                                                <td align="left">Gender</td>
                                                <td align="left"><?php echo $user5['sex'];?></td>
                                             </tr>
            <tr>
            <td align="left">Country</td>
            <td align="left"><?php echo getCountry($user5['country']);?></td>
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
            <td colspan="2"><?php if($info5!=''){ ?>
            <a  <?php if(empty($user6['user_id']) && $info5!='') 
               { ?> href="register.php?pl_id=<?php echo $info5;?>&&pos=<?php echo 'left';?>&&sponsor_id=<?php echo $id;?>" target="_blank" <?php } else { ?>href="binary-tree.php?id=<?php echo $user6['user_id']; ?>&&binary=<?php echo 'left';?>" <?php } ?>  class="<?php if(!empty($user6['user_id'])){ echo $pop; } ?>"> <div class="margint10">  
            <img src="<?php echo $img6; ?>" class="round-border" height="50" id="menu_link2"/><br/><?php echo userName($user6['user_id'])?><br/><?php echo $user6['username']?><br><?php if(!empty($user6['user_id'])){echo matchingPoint($user6['user_id'],'left')."/".matchingPoint($user6['user_id'],'right'); } ?><p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div> 
            <?php } else { ?>
            <img src="<?php echo $img6; ?>" class="round-border" height="50" id="menu_link2"/><p  style="width:40px; margin:1em 0 0 0; padding:0"></p>
      </div>
      <?php } ?>
      <span>
      <img class="callout" src="images/callout.gif" />
      <div class="flyout" style="<?php if(!empty($user6['user_id'])){ ?>display:<?php echo $disp; } else { ?>display:none;<?php } ?>">
      <table width="100%" border="0" cellspacing="1" cellpadding="1">
      <tr>
      <td align="left">User ID</td>
      <td align="left"><?php echo $user6['username'] ?></td>
      </tr>
      <tr>
      <td align="left">Full  Name</td>
      <td align="left"><?php echo $user6['first_name']." ".$user6['last_name'] ?></td>
      </tr>
	  <tr>
                                                <td align="left">Gender</td>
                                                <td align="left"><?php echo $user6['sex'];?></td>
                                             </tr>
      <tr>
      <td align="left">Country</td>
      <td align="left"><?php echo getCountry($user6['country']);?></td>
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
      <td colspan="2"><?php if($info5!=''){ ?>
      <a  <?php if(empty($user7['user_id']) && $info5!='') 
         { ?> href="register.php?pl_id=<?php echo $info5;?>&&pos=<?php echo 'right';?>&&sponsor_id=<?php echo $id;?>" target="_blank" <?php } else { ?>href="binary-tree.php?id=<?php echo $user7['user_id']; ?>&&binary=<?php echo 'right';?>" <?php } ?>  class="<?php if(!empty($user7['user_id'])){ echo $pop; }  ?>"> <div class="margint10">  
      <img src="<?php echo $img7; ?>" class="round-border" height="50" id="menu_link2"/><br/><?php echo userName($user7['user_id'])?><br/><?php echo $user7['username']?><br><?php if(!empty($user7['user_id'])){echo matchingPoint($user7['user_id'],'left')."/".matchingPoint($user7['user_id'],'right'); } ?><p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div> 
      <?php } else { ?>
      <img src="<?php echo $img7; ?>" class="round-border" height="50" id="menu_link2"/><p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div> 
      <?php } ?>
      <span>
      <img class="callout" src="images/callout.gif" />
      <div class="flyout" style="<?php if(!empty($user7['user_id'])){ ?>display:<?php echo $disp; } else { ?>display:none;<?php } ?>">
      <table width="100%" border="0" cellspacing="1" cellpadding="1">
      <tr>
      <td align="left">User ID</td>
      <td align="left"><?php echo $user7['username'] ?></td>
      </tr>
      <tr>
      <td align="left">Full  Name</td>
      <td align="left"><?php echo $user7['first_name']." ".$user7['last_name'] ?></td>
      </tr>
	  <tr>
                                                <td align="left">Gender</td>
                                                <td align="left"><?php echo $user7['sex'];?></td>
                                             </tr>
      <tr>
      <td align="left">Country</td>
      <td align="left"><?php echo getCountry($user7['country']);?></td>
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
      <td colspan="2">
      <a  <?php if(empty($user8['user_id']) && $userid!='') 
         { ?> href="register.php?pl_id=<?php echo $userid;?>&&pos=<?php echo 'right';?>&&sponsor_id=<?php echo $id;?>" target="_blank" <?php } else { ?>href="binary-tree.php?id=<?php echo $user8['user_id']; ?>&&binary=<?php echo 'right';?>" <?php } ?>  class="<?php if(!empty($user8['user_id'])){ echo $pop; }  ?>"> <div class="margint10"> <br/><br/><br/> 
      <img src="<?php echo $img8?>" height="50" class="round-border" style="margin-top:-60px;"  id="menu_link2"/><br/><?php echo userName($user8['user_id'])?><br/><?php echo $user8['username']?><br><?php if(!empty($user8['user_id'])){echo matchingPoint($user8['user_id'],'left')."/".matchingPoint($user8['user_id'],'right'); } ?>  <p class="border-green" style="width:40px; margin:1em 0 0 0; padding:0"></p></div>
      <span>
      <img class="callout" src="images/callout.gif" />
      <div class="flyout" style="<?php if(!empty($user8['user_id'])){ ?>display:<?php echo $disp; } else { ?>display:none;<?php } ?>">
      <table width="100%" border="0" cellspacing="1" cellpadding="1">
      <tr>
      <td align="left">User ID</td>
      <td align="left"><?php echo $user8['username'] ?></td>
      </tr>
      <tr>
      <td align="left">Full  Name</td>
      <td align="left"><?php echo $user8['first_name']." ".$user8['last_name'] ?></td>
      </tr>
	  <tr>
                                                <td align="left">Gender</td>
                                                <td align="left"><?php echo $user8['sex'];?></td>
                                             </tr>
      <tr>
      <td align="left">Country</td>
      <td align="left"><?php echo getCountry($user8['country']);?></td>
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
      <td colspan="2"><?php if($info8!=''){ ?>
      <a  <?php if(empty($user9['user_id']) && $info8!='') 
         { ?> href="register.php?pl_id=<?php echo $info8;?>&&pos=<?php echo 'left';?>&&sponsor_id=<?php echo $id;?>" target="_blank" <?php } else { ?>href="binary-tree.php?id=<?php echo $user9['user_id']; ?>&&binary=<?php echo 'left';?>" <?php } ?>  class="<?php if(!empty($user9['user_id'])){ echo $pop; }  ?>"> <div class="margint10">  
      <img src="<?php echo $img9; ?>" class="round-border" height="50" id="menu_link2"/><br/><?php echo userName($user9['user_id'])?><br/><?php echo $user9['username']?><br><?php if(!empty($user9['user_id'])){echo matchingPoint($user9['user_id'],'left')."/".matchingPoint($user9['user_id'],'right'); } ?>
      <p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div> 
      <?php } else { ?>
      <img src="<?php echo $img9; ?>" class="round-border" height="50" id="menu_link2"/><p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div> 
      <?php } ?>
      <span>
      <img class="callout" src="images/callout.gif" />
      <div class="flyout" style="<?php if(!empty($user9['user_id'])){ ?>display:<?php echo $disp; } else { ?>display:none;<?php } ?>">
      <table width="100%" border="0" cellspacing="1" cellpadding="1">
      <tr>
      <td align="left">User ID</td>
      <td align="left"><?php echo $user9['username'] ?></td>
      </tr>
      <tr>
      <td align="left">Full  Name</td>
      <td align="left"><?php echo $user9['first_name']." ".$user9['last_name'] ?></td>
      </tr>
	  <tr>
                                                <td align="left">Gender</td>
                                                <td align="left"><?php echo $user9['sex'];?></td>
                                             </tr>
      <tr>
      <td align="left">Country</td>
      <td align="left"><?php echo getCountry($user9['country']);?></td>
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
      <td colspan="2"><?php if($info9!=''){ ?>
      <a  <?php if(empty($user10['user_id']) && $info9!='') 
         { ?> href="register.php?pl_id=<?php echo $info9;?>&&pos=<?php echo 'left';?>&&sponsor_id=<?php echo $id;?>" target="_blank" <?php } else { ?>href="binary-tree.php?id=<?php echo $user10['user_id']; ?>&&binary=<?php echo 'left';?>" <?php } ?>  class="<?php if(!empty($user10['user_id'])){ echo $pop; }  ?>"> <div class="margint10">  
      <img src="<?php echo $img10; ?>" class="round-border" height="50" id="menu_link2"/><br/><?php echo userName($user10['user_id'])?><br/><?php echo $user10['username']?><br><?php if(!empty($user10['user_id'])){echo matchingPoint($user10['user_id'],'left')."/".matchingPoint($user10['user_id'],'right'); } ?><p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div> 
      <?php } else { ?>
      <img src="<?php echo $img10; ?>" class="round-border" height="50" id="menu_link2"/><p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div> 
      <?php } ?>
      <span>
      <img class="callout" src="images/callout.gif" />
      <div class="flyout" style="<?php if(!empty($user10['user_id'])){ ?>display:<?php echo $disp; } else { ?>display:none;<?php } ?>">
      <table width="100%" border="0" cellspacing="1" cellpadding="1">
      <tr>
      <td align="left">User ID</td>
      <td align="left"><?php echo $user10['username'] ?></td>
      </tr>
      <tr>
      <td align="left">Full  Name</td>
      <td align="left"><?php echo $user10['first_name']." ".$user10['last_name'] ?></td>
      </tr>
	   <tr>
                                                <td align="left">Gender</td>
                                                <td align="left"><?php echo $user10['sex'];?></td>
                                             </tr>
      <tr>
      <td align="left">Country</td>
      <td align="left"><?php echo getCountry($user10['country']);?></td>
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
      <td colspan="2"><?php if($info9!=''){ ?>
      <a  <?php if(empty($user11['user_id']) && $info9!='') 
         { ?> href="register.php?pl_id=<?php echo $info9;?>&&pos=<?php echo 'right';?>&&sponsor_id=<?php echo $id;?>" target="_blank" <?php } else { ?>href="binary-tree.php?id=<?php echo $user11['user_id']; ?>&&binary=<?php echo 'right';?>" <?php } ?>  class="<?php if(!empty($user11['user_id'])){ echo $pop; }  ?>"> <div class="margint10">  
      <img src="<?php echo $img11; ?>" class="round-border" height="50" id="menu_link2"/><br><?php echo userName($user11['user_id'])?><br/><?php echo $user11['username']?><br><?php if(!empty($user11['user_id'])){echo matchingPoint($user11['user_id'],'left')."/".matchingPoint($user11['user_id'],'right'); } ?><p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div> 
      <?php } else { ?>
      <img src="<?php echo $img11; ?>" class="round-border" height="50" id="menu_link2"/><p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div> 
      <?php } ?>
      <span>
      <img class="callout" src="images/callout.gif" />
      <div class="flyout" style="<?php if(!empty($user11['user_id'])){ ?>display:<?php echo $disp; } else { ?>display:none;<?php } ?>">
      <table width="100%" border="0" cellspacing="1" cellpadding="1">
      <tr>
      <td align="left">User ID</td>
      <td align="left"><?php echo $user11['username'] ?></td>
      </tr>
      <tr>
      <td align="left">Full  Name</td>
      <td align="left"><?php echo $user11['first_name']." ".$user11['last_name'] ?></td>
      </tr>
	   <tr>
                                                <td align="left">Gender</td>
                                                <td align="left"><?php echo $user11['sex'];?></td>
                                             </tr>
      <tr>
      <td align="left">Country</td>
     <td align="left"><?php echo getCountry($user11['country']);?></td>
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
      <td colspan="2"><?php if($info8!=''){ ?>
      <a  <?php if(empty($user12['user_id']) && $info8!='') 
         { ?> href="register.php?pl_id=<?php echo $info8;?>&&pos=<?php echo 'right';?>&&sponsor_id=<?php echo $id;?>" target="_blank" <?php } else { ?>href="binary-tree.php?id=<?php echo $user12['user_id']; ?>&&binary=<?php echo 'right';?>" <?php } ?>  class="<?php if(!empty($user12['user_id'])){ echo $pop; }  ?>"> <div class="margint10">  
      <img src="<?php echo $img12; ?>" class="round-border" height="50" id="menu_link2"/><br><?php echo userName($user12['user_id'])?><br/><?php echo $user12['username']?><br><?php if(!empty($user12['user_id'])){echo matchingPoint($user12['user_id'],'left')."/".matchingPoint($user12['user_id'],'right'); } ?> 
      <p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div> 
      <?php } else { ?>
      <img src="<?php echo $img12; ?>" class="round-border" height="50" id="menu_link2"/><p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div> 
      <?php } ?>
      <span>
      <img class="callout" src="images/callout.gif" />
      <div class="flyout" style="<?php if(!empty($user12['user_id'])){ ?>display:<?php echo $disp; } else { ?>display:none;<?php } ?>">
      <table width="100%" border="0" cellspacing="1" cellpadding="1">
      <tr>
      <td align="left">User ID</td>
      <td align="left"><?php echo $user12['username'] ?></td>
      </tr>
      <tr>
      <td align="left">Full  Name</td>
      <td align="left"><?php echo $user12['first_name']." ".$user12['last_name'] ?></td>
      </tr>
	  <tr>
                                                <td align="left">Gender</td>
                                                <td align="left"><?php echo $user12['sex'];?></td>
                                             </tr>
      <tr>
      <td align="left">Country</td>
     <td align="left"><?php echo getCountry($user12['country']);?></td>
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
      <td colspan="2"><?php if($info12!=''){ ?>
      <a  <?php if(empty($user13['user_id']) && $info12!='') 
         { ?> href="register.php?pl_id=<?php echo $info12;?>&&pos=<?php echo 'right';?>&&sponsor_id=<?php echo $id;?>" target="_blank" <?php } else { ?>href="binary-tree.php?id=<?php echo $user13['user_id']; ?>&&binary=<?php echo 'right';?>" <?php } ?>  class="<?php if(!empty($user13['user_id'])){ echo $pop; } ?>"> <div class="margint10">  
      <img src="<?php echo $img13; ?>" class="round-border" height="50" id="menu_link2"/><br><?php echo userName($user13['user_id'])?><br/><?php echo $user13['username']?><br><?php if(!empty($user13['user_id'])){echo matchingPoint($user13['user_id'],'left')."/".matchingPoint($user13['user_id'],'right'); } ?>
      <p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div> 
      <?php } else { ?>
      <img src="<?php echo $img13; ?>" class="round-border" height="50" id="menu_link2"/><p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div> 
      <?php } ?>
      <span>
      <img class="callout" src="images/callout.gif" />
      <div class="flyout" style="<?php if(!empty($user13['user_id'])){ ?>display:<?php echo $disp; } else { ?>display:none;<?php } ?>">
      <table width="100%" border="0" cellspacing="1" cellpadding="1">
      <tr>
      <td align="left">User ID</td>
      <td align="left"><?php echo $user13['username'] ?></td>
      </tr>
      <tr>
      <td align="left">Full  Name</td>
      <td align="left"><?php echo $user13['first_name']." ".$user13['last_name'] ?></td>
      </tr>
	   <tr>
                                                <td align="left">Gender</td>
                                                <td align="left"><?php echo $user13['sex'];?></td>
                                             </tr>
      <tr>
      <td align="left">Country</td>
      <td align="left"><?php echo getCountry($user13['country']);?></td>
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
      <td colspan="2"><?php if($info12!=''){ ?>
      <a  <?php if(empty($user14['user_id']) && $info12!='') 
         { ?> href="register.php?pl_id=<?php echo $info12;?>&&pos=<?php echo 'right';?>&&sponsor_id=<?php echo $id;?>" target="_blank" <?php } else { ?>href="binary-tree.php?id=<?php echo $user14['user_id']; ?>&&binary=<?php echo 'right';?>" <?php } ?>  class="<?php if(!empty($user14['user_id'])){ echo $pop; }  ?>"> <div class="margint10">  
      <img src="<?php echo $img14; ?>" class="round-border" height="50" id="menu_link2"/><br><?php echo userName($user14['user_id'])?><br/><?php echo $user14['username']?><br><?php if(!empty($user14['user_id'])){echo matchingPoint($user14['user_id'],'left')."/".matchingPoint($user14['user_id'],'right'); } ?><p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div> 
      <?php } else { ?>
      <img src="<?php echo $img14; ?>" class="round-border" height="50" id="menu_link2"/><br/><br/><br/><br/><p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div> 
      <?php } ?>
      <span>
      <img class="callout" src="images/callout.gif" />
      <div class="flyout" style="<?php if(!empty($user14['user_id'])){ ?>display:<?php echo $disp; } else { ?>display:none;<?php } ?>">
      <table width="100%" border="0" cellspacing="1" cellpadding="1">
      <tr>
      <td align="left">User ID</td>
      <td align="left"><?php echo $user14['username'] ?></td>
      </tr>
      <tr>
      <td align="left">Full  Name</td>
      <td align="left"><?php echo $user14['first_name']." ".$user14['last_name'] ?></td>
      </tr>
	   <tr>
                                                <td align="left">Gender</td>
                                                <td align="left"><?php echo $user14['sex'];?></td>
                                             </tr>
      <tr>
      <td align="left">Country</td>
      <td align="left"><?php echo getCountry($user14['country']);?></td>
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

