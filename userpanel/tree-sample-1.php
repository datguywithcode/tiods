<?php include("header.php");
$id=$userid;
$str_sent="select * from message_sender where sender_id='$id' and status=0 order by id desc";
$res_sent=mysql_query($str_sent);
$count_sent=mysql_num_rows($res_sent);
$str11="select * from message where reciever_id='$id' and status=0 order by id desc";
$res11=mysql_query($str11);
$count11=mysql_num_rows($res11);
$str_draft="select * from message_draft where sender_id='$id' and status=0 order by id desc";
$res_draft=mysql_query($str_draft);
$count_draft=mysql_num_rows($res_draft);
$str_trash="select *,'sender' as type from message_sender where sender_id='$id' and status=1 union all select *,'receiver' as type from message where reciever_id='$id' and status=1 union all select *,'draft' as type from message_draft where reciever_id='$id' and status=1 order by ts desc";
$res_trash=mysql_query($str_trash);
$count_trash=mysql_num_rows($res_trash);
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
            <h1>Inbox</h1>
            <p class="lead">You have <span class="label label-warning"><?php echo $count11;?></span> messages</p>
          </div>

          <div class="col-md-4">

            <ol class="breadcrumb pull-right no-margin-bottom">
                        <li><a href="#">Messages</a></li>
              <li class="active">Inbox</li>
            </ol>

          </div>
        </section> <!-- / PAGE TITLE -->

        <div class="container-fluid white-bg">

          <div class="row">

            
            
            
            
            
            
            	<div class="col-md-10 center-block">
                    
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
                                <td width="5%" align="center"><a class="tooltip1" href="my-direct-user-tree.php?id=123456"> <div class="margint10">  
                                <img height="50" class="round-border" id="menu_link2" src="images/meb-6.png"><br>123456<br>GTR 
                                <p style="width:40px; margin:1em 0 0 0; padding:0"></p></div>
                                <span><img src="images/callout.gif" class="callout">
                                <div class="flyout">
                                  <table width="100%" cellspacing="1" cellpadding="1" border="0">
                                    <tbody><tr>
                                      <td align="left">User ID</td>
                                      <td align="left">123456</td>
                                    </tr>
                                    <tr>
                                      <td align="left">Full  Name</td>
                                      <td align="left">GTR Company ( 10000 )</td>
                                    </tr>
                                   
                                    <tr>
                                   
                                      <td align="left">Country</td>
                                      <td align="left">USA</td>
                                    </tr>
                                    <tr>
                                      <td align="left">Email</td>
                                      <td align="left">info@gtr2u.net</td>
                                    </tr>
                                    <tr>
                                      <td align="left">Sponsor  ID</td>
                                      <td align="left">cmp</td>
                                    </tr>

                                    <tr>
                                      <td align="left">D.O.J</td>
                                      <td align="left">2014-07-22</td>
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
                                    <td colspan="2"><img width="2" height="25" alt="img" src="images/line.png"></td>

                                      <td colspan="2"><img width="2" height="25" alt="img" src="images/line.png"></td>

                                      <td colspan="2"><img width="2" height="25" alt="img" src="images/line.png"></td>

                                      <td colspan="2"><img width="2" height="25" alt="img" src="images/line.png"></td>

                                      <td colspan="2"><img width="2" height="25" alt="img" src="images/line.png"></td>

                                      <td colspan="2"><img width="2" height="25" alt="img" src="images/line.png"></td>
                                  
                                  </tr>
                                  <tr align="center">
                                    <td colspan="2"><a class="tooltip1" href="my-direct-user-tree.php?id=5544416"> 
                                    <div class="margint10">  
                                    <img height="50" class="round-border" id="menu_link2" src="images/meb-6.png"> <br>5544416<br>GTR2 
                                    <p style="width:40px; margin:1em 0 0 0; padding:0"></p></div>
                                    <span><img src="images/callout.gif" class="callout">
                                   
    								<div class="flyout "><table width="98%" cellspacing="1" cellpadding="1" border="0">
									  <tbody><tr>
										<td align="left">User ID</td>
										<td align="left">5544416</td>
									  </tr>
									
									 <tr>
                                      <td align="left">Full  Name</td>
                                      <td align="left">GTR Platform ( 100000 )</td>
                                    </tr>
									 
									  
	                                    <tr>
                                   
                                      <td align="left">Country</td>
                                      <td align="left">Malaysia</td>
                                    </tr>

									 
									  <tr>
										<td align="left">Email</td>
										<td align="left">benjaminalshariff@gmail.com</td>
									  </tr>
									
									  <tr>
										<td align="left">Sponsor  ID</td>
										<td align="left">123456</td>
									  </tr>
									  <tr>
										<td align="left">D.O.J</td>
										<td align="left">2015-08-08</td>
									  </tr>

                                   
									</tbody></table>
									</div></span></a>
                                    
                                    
                                    
                                    </td>
                                    
                                   
                                    <td colspan="2"><a class="tooltip1" href="my-direct-user-tree.php?id=2075479"> <div class="margint10">  <img height="50" class="round-border" id="menu_link2" src="images/meb-1.png"> <br>2075479<br>Platform2 <p style="width:40px; margin:1em 0 0 0; padding:0"></p></div><span><img src="images/callout.gif" class="callout">
   
    								<div class="flyout "><table width="98%" cellspacing="1" cellpadding="1" border="0">
									  <tbody><tr>
										<td align="left">User ID</td>
										<td align="left">2075479</td>
									  </tr>
									
									 <tr>
                                      <td align="left">Full  Name</td>
                                      <td align="left">GTR Platform ( 100000 )</td>
                                    </tr>
									 
									  
	                                    <tr>
                                   
                                      <td align="left">Country</td>
                                      <td align="left">Malaysia</td>
                                    </tr>

									 
									  <tr>
										<td align="left">Email</td>
										<td align="left">benjaminalshariff@gmail.com</td>
									  </tr>
									
									  <tr>
										<td align="left">Sponsor  ID</td>
										<td align="left">123456</td>
									  </tr>
									  <tr>
										<td align="left">D.O.J</td>
										<td align="left">2015-08-08</td>
									  </tr>

                                   
									</tbody></table>
									</div></span></a>
                                    
                                    
                                    
                                    </td>
    
   
    <td colspan="2"><a class="tooltip1" href="my-direct-user-tree.php?id=5466931"> <div class="margint10">  <img height="50" class="round-border" id="menu_link2" src="images/meb-8.png"> <br>5466931<br>Hidayah <p style="width:40px; margin:1em 0 0 0; padding:0"></p></div><span><img src="images/callout.gif" class="callout">
   
    <div class="flyout "><table width="98%" cellspacing="1" cellpadding="1" border="0">
									  <tbody><tr>
										<td align="left">User ID</td>
										<td align="left">5466931</td>
									  </tr>
									
									 <tr>
                                      <td align="left">Full  Name</td>
                                      <td align="left">Norhidayah Zakaria ( 10000 )</td>
                                    </tr>
									 
									  
	                                    <tr>
                                   
                                      <td align="left">Country</td>
                                      <td align="left">Malaysia</td>
                                    </tr>

									 
									  <tr>
										<td align="left">Email</td>
										<td align="left">benjaminalshariff@gmail.com</td>
									  </tr>
									
									  <tr>
										<td align="left">Sponsor  ID</td>
										<td align="left">123456</td>
									  </tr>
									  <tr>
										<td align="left">D.O.J</td>
										<td align="left">2015-08-11</td>
									  </tr>

                                   
									</tbody></table>
									</div></span></a>
                                    
                                    
                                    
                                    </td>
   
   
    <td colspan="2"><a class="tooltip1" href="my-direct-user-tree.php?id=6748786"> <div class="margint10">  <img height="50" class="round-border" id="menu_link2" src="images/meb-5.png"> <br>6748786<br>Benida <p style="width:40px; margin:1em 0 0 0; padding:0"></p></div><span><img src="images/callout.gif" class="callout">
   
    <div class="flyout "><table width="98%" cellspacing="1" cellpadding="1" border="0">
									  <tbody><tr>
										<td align="left">User ID</td>
										<td align="left">6748786</td>
									  </tr>
									
									 <tr>
                                      <td align="left">Full  Name</td>
                                      <td align="left">Benjamin Sharif ( 50000 )</td>
                                    </tr>
									 
									  
	                                    <tr>
                                   
                                      <td align="left">Country</td>
                                      <td align="left">Malaysia</td>
                                    </tr>

									 
									  <tr>
										<td align="left">Email</td>
										<td align="left">benjaminalshariff@gmail.com</td>
									  </tr>
									
									  <tr>
										<td align="left">Sponsor  ID</td>
										<td align="left">123456</td>
									  </tr>
									  <tr>
										<td align="left">D.O.J</td>
										<td align="left">2015-08-12</td>
									  </tr>

                                   
									</tbody></table>
									</div></span></a>
                                    
                                    
                                    
                                    </td>
    
   
    <td colspan="2"><a class="tooltip1" href="my-direct-user-tree.php?id=9178555"> <div class="margint10">  <img height="50" class="round-border" id="menu_link2" src="images/meb-7.png"> <br>9178555<br>rozy <p style="width:40px; margin:1em 0 0 0; padding:0"></p></div><span><img src="images/callout.gif" class="callout">
   
    <div class="flyout "><table width="98%" cellspacing="1" cellpadding="1" border="0">
									  <tbody><tr>
										<td align="left">User ID</td>
										<td align="left">9178555</td>
									  </tr>
									
									 <tr>
                                      <td align="left">Full  Name</td>
                                      <td align="left">rozziny Ramli ( 10000 )</td>
                                    </tr>
									 
									  
	                                    <tr>
                                   
                                      <td align="left">Country</td>
                                      <td align="left">Malaysia</td>
                                    </tr>

									 
									  <tr>
										<td align="left">Email</td>
										<td align="left">benjaminalshariff@gmail.com</td>
									  </tr>
									
									  <tr>
										<td align="left">Sponsor  ID</td>
										<td align="left">123456</td>
									  </tr>
									  <tr>
										<td align="left">D.O.J</td>
										<td align="left">2015-08-16</td>
									  </tr>

                                   
									</tbody></table>
									</div></span></a>
                                    
                                    
                                    
                                    </td>
   
   
    <td colspan="2"><a class="tooltip1" href="my-direct-user-tree.php?id=1123911"> <div class="margint10">  <img height="50" class="round-border" id="menu_link2" src="images/meb-1.png"> <br>1123911<br>Carlos <p style="width:40px; margin:1em 0 0 0; padding:0"></p></div><span><img src="images/callout.gif" class="callout">
   
    <div class="flyout "><table width="98%" cellspacing="1" cellpadding="1" border="0">
									  <tbody><tr>
										<td align="left">User ID</td>
										<td align="left">1123911</td>
									  </tr>
									
									 <tr>
                                      <td align="left">Full  Name</td>
                                      <td align="left">Hidayah zakaria ( 10000 )</td>
                                    </tr>
									 
									  
	                                    <tr>
                                   
                                      <td align="left">Country</td>
                                      <td align="left">Malaysia</td>
                                    </tr>

									 
									  <tr>
										<td align="left">Email</td>
										<td align="left">benjaminalshariff@gmail.com</td>
									  </tr>
									
									  <tr>
										<td align="left">Sponsor  ID</td>
										<td align="left">123456</td>
									  </tr>
									  <tr>
										<td align="left">D.O.J</td>
										<td align="left">2015-08-17</td>
									  </tr>

                                   
									</tbody></table>
									</div></span></a>
                                    
                                    
                                    
                                    </td>
   
  </tr>
  <tr><td>&nbsp;</td></tr>
</tbody></table>
                                        
                                        
                                        
						</div>
                        
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