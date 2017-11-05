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

            
            
            
            
            
            
            	<div class="col-md-8 center-block">
                    
                        <div class="table-responsive">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tree-table table-responsive">
                          <tr>
                          <td width="10%">&nbsp;</td>
                            <td width="10%">&nbsp;</td>
                            <td width="10%"><a href="#" class="tooltip1"> <div class="margint10">  <img src="images/meb-1.png" height="50" class="round-border" id="menu_link2"/><br/><br/>123456<br/>tushar <p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div>
                                  <span><img class="callout" src="images/callout.gif" />
                                  <div class="flyout">
                                  <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                    <tr>
                                      <td align="left">User ID</td>
                                      <td align="left">123456</td>
                                    </tr>
                                    <tr>
                                      <td align="left">Full  Name</td>
                                      <td align="left">tushar srivastav (  )</td>
                                    </tr>
                                   
                                    <tr>
                                      <td align="left">Country</td>
                                      <td align="left">USA</td>
                                    </tr>
                                    <tr>
                                      <td align="left">Email</td>
                                      <td align="left">aditya.php4u@gmail.com</td>
                                    </tr>
                                    <tr>
                                      <td align="left">Sponsor  ID</td>
                                      <td align="left">cmp</td>
                                    </tr>

                                    <tr>
                                      <td align="left">D.O.J</td>
                                      <td align="left">2014-07-22</td>
                                    </tr>
                                    <tr>
                                      <td align="left">Total Left</td>
                                      <td align="left">25600 BV</td>
                                    </tr>
                                    <tr>
                                      <td align="left">Total Right</td>
                                      <td align="left">7500 BV</td>
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
                                  <tr>
                                
                                    <td colspan="2"><a  href="#"  class="tooltip1"> <div class="margint10">  
                                    <img src="images/meb-2.png" height="50" class="round-border"  id="menu_link2"/><br/><br/>1030121<br/>aditya <p class="border-green" style="width:40px; margin:1em 0 0 0; padding:0"></p></div>
                                  
                                  <span>
                                  <img class="callout" src="images/callout.gif" />
                                  <div class="flyout">
                                  <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                    <tr>
                                      <td align="left">User ID</td>
                                      <td align="left">1030121</td>
                                    </tr>
                                    <tr>
                                      <td align="left">Full  Name</td>
                                      <td align="left">aditya kumar ( 4200 )</td>
                                    </tr>
                                    <tr>
                                      <td align="left">Country</td>
                                      <td align="left"> Belize</td>
                                    </tr>
                                    <tr>
                                      <td align="left">Email</td>
                                      <td align="left">aditya@gmail.com</td>
                                    </tr>
                                    <tr>
                                      <td align="left">Sponsor  ID</td>
                                      <td align="left">123456</td>
                                    </tr>

                                    <tr>
                                      <td align="left">D.O.J</td>
                                      <td align="left">2015-08-11</td>
                                    </tr>
                                      <tr>
                                      <td align="left">Total Left</td>
                                      <td align="left">17200 BV</td>
                                    </tr>
                                    <tr>
                                      <td align="left">Total Right</td>
                                      <td align="left">4200 BV</td>
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
                           
                                        <td colspan="2"><a  href="#"  class="tooltip1"> <div class="margint10">  
                                        <img src="images/meb-3.png" height="50" class="round-border" id="menu_link2"/><br/><br/>1181631<br/>ajay <p class="border-green" style="width:40px; margin:1em 0 0 0; padding:0"></p></div>
       
                                  
                                  <span>
                                  <img class="callout" src="images/callout.gif" />
                                  <div class="flyout">
                                  <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                    <tr>
                                      <td align="left">User ID</td>
                                      <td align="left">1181631</td>
                                    </tr>
                                    <tr>
                                      <td align="left">Full  Name</td>
                                      <td align="left">ajay tomar ( 8600 )</td>
                                    </tr>

                                    <tr>
                                      <td align="left">Country</td>
                                      <td align="left"> Belgium</td>
                                    </tr>
                                    <tr>
                                      <td align="left">Email</td>
                                      <td align="left">ajay@gmail.com</td>
                                    </tr>
                                    <tr>
                                      <td align="left">Sponsor  ID</td>
                                      <td align="left">123456</td>
                                    </tr>

                                    <tr>
                                      <td align="left">D.O.J</td>
                                      <td align="left">2015-08-11</td>
                                    </tr>
 <tr>
                                      <td align="left">Total Left</td>
                                      <td align="left">8600 BV</td>
                                    </tr>
                                    <tr>
                                      <td align="left">Total Right</td>
                                      <td align="left"> BV</td>
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
                            
                                <td colspan="2"><a  href="#"  class="tooltip1"> <div class="margint10">  
                                <img src="images/meb-4.png" height="50" class="round-border" id="menu_link2"/><br/><br/>1101427<br/>ankit <p class="border-green" style="width:40px; margin:1em 0 0 0; padding:0"></p></div>
                                  
                                  <span>
                                  <img class="callout" src="images/callout.gif" />
                                  <div class="flyout">
                                  <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                    <tr>
                                      <td align="left">User ID</td>
                                      <td align="left">1101427</td>
                                    </tr>
                                    <tr>
                                      <td align="left">Full  Name</td>
                                      <td align="left">ankit rathi ( 8600 )</td>
                                    </tr>
                                   
                                    <tr>
                                   
                                      <td align="left">Country</td>
                                      <td align="left"> Belize</td>
                                    </tr>
                                    <tr>
                                      <td align="left">Email</td>
                                      <td align="left">ankit@gmail.com</td>
                                    </tr>
                                    <tr>
                                      <td align="left">Sponsor  ID</td>
                                      <td align="left">123456</td>
                                    </tr>

                                    <tr>
                                      <td align="left">D.O.J</td>
                                      <td align="left">2015-08-11</td>
                                    </tr>
 <tr>
                                      <td align="left">Total Left</td>
                                      <td align="left"> BV</td>
                                    </tr>
                                    <tr>
                                      <td align="left">Total Right</td>
                                      <td align="left"> BV</td>
                                    </tr>
                                  </table>
                                </div></span>
                                </a></td>
                                
                                    <td>&nbsp;</td>
                                    <td colspan="2"><a  href="#" class="tooltip1"> <div class="margint10">  
                                    <img src="images/meb-5.png" class="round-border" height="50" id="menu_link2"/><br/><br/><br/><br/><p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div></a></td>
                                
                                  </tr>
                                </table>
    
                                </td>
                                <td>&nbsp;</td>
                                <td colspan="2"><a  href="#"  class="tooltip1"> <div class="margint10">  
                                <img src="images/meb-1.png" class="round-border" height="50" style="margin-top:-20px; margin-bottom:20px;" id="menu_link2"/><br/>1208311<br/>ankur <p class="border-green" style="width:40px; margin:1em 0 0 0; padding:0"></p></div>
                                                                    
                                  <span>
                                  <img class="callout" src="images/callout.gif" />
                                  <div class="flyout">
                                  <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                    <tr>
                                      <td align="left">User ID</td>
                                      <td align="left">1208311</td>
                                    </tr>
                                    <tr>
                                      <td align="left">Full  Name</td>
                                      <td align="left">ankur siwach ( 4200 )</td>
                                    </tr>
                                   
                                    <tr>
                                   
                                      <td align="left">Country</td>
                                      <td align="left"> Antigua</td>
                                    </tr>
                                    <tr>
                                      <td align="left">Email</td>
                                      <td align="left">ankur@gmail.com</td>
                                    </tr>
                                    <tr>
                                      <td align="left">Sponsor  ID</td>
                                      <td align="left">123456</td>
                                    </tr>

                                    <tr>
                                      <td align="left">D.O.J</td>
                                      <td align="left">2015-08-11</td>
                                    </tr>

                                 <tr>
                                      <td align="left">Total Left</td>
                                      <td align="left"> BV</td>
                                    </tr>
                                    <tr>
                                      <td align="left">Total Right</td>
                                      <td align="left"> BV</td>
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
                                
                                    <td colspan="2"><a  href="#"  class="tooltip1"> 
                                    <div class="margint10">  
                                    <img src="images/meb-3.png" height="50" class="round-border" id="menu_link2"/><br/><br/><br/> <p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div>
                                                                                                  </a></td>
                                    <td>&nbsp;</td>
                                    <td colspan="2"><a  href="#"  class="tooltip1"> 
                                    <div class="margint10">  <img src="images/meb-7.png" height="50" class="round-border" id="menu_link2"/><br/><br/><br/> <p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div>
                                                                                                  </a></td>
                                
                                  </tr>
                                </table>
                                    </td>
                                
                                  </tr>
                                </table>
                                
                                    </td>
                                    <td>&nbsp;</td>
                                    <td colspan="2"><a  href="#"  class="tooltip1"> <div class="margint10">  
                                    <img src="images/meb-6.png" style="margin-top:-63px;" height="50" class="round-border" id="menu_link2"/><br/><br/>1342225<br/>amit <p class="border-green" style="width:40px; margin:1em 0 0 0; padding:0"></p></div>
    
                                 <span>
                                 <img class="callout" src="images/callout.gif" />
                                 <div class="flyout">
                                  <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                    <tr>
                                      <td align="left">User ID</td>
                                      <td align="left">1342225</td>
                                    </tr>
                                    <tr>
                                      <td align="left">Full  Name</td>
                                      <td align="left">amit kumar ( 7500 )</td>
                                    </tr>
                                   
                                    <tr>
                                   
                                      <td align="left">Country</td>
                                      <td align="left"> Belize</td>
                                    </tr>
                                    <tr>
                                      <td align="left">Email</td>
                                      <td align="left">amit@gmail.com</td>
                                    </tr>
                                    <tr>
                                      <td align="left">Sponsor  ID</td>
                                      <td align="left">123456</td>
                                    </tr>

                                    <tr>
                                      <td align="left">D.O.J</td>
                                      <td align="left">2015-08-11</td>
                                    </tr>

                                     <tr>
                                      <td align="left">Total Left</td>
                                      <td align="left"> BV</td>
                                    </tr>
                                    <tr>
                                      <td align="left">Total Right</td>
                                      <td align="left"> BV</td>
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
                                
                                    <td colspan="2"><a  href="#"  class="tooltip1"> 
                                    <div class="margint10"> 
                                    <img src="images/meb-4.png" height="50" class="round-border" id="menu_link2"/><br/><br/><p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div>
                                    
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
                                
                                    <td colspan="2"><a  href="#" class="tooltip1"> <div class="margint10">  
                                    <img src="images/meb-8.png" height="50" class="round-border" id="menu_link2"/><br/><br/><br/> <p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div></a></td>
                                    
                                    <td>&nbsp;</td>
                                    <td colspan="2"><a  href="#" class="tooltip1"> <div class="margint10">  
                                    <img src="images/meb-2.png" height="50" class="round-border" id="menu_link2"/><br/><br/><br/> <p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div>
                                                                                                  </a></td>
                                
                                  </tr>
                                </table>
                                </td>
                                <td>&nbsp;</td>
                                <td colspan="2"><a  href="#" class="tooltip1"> 
                                <div class="margint10">  
                                <img src="images/meb-5.png" height="50" class="round-border" id="menu_link2"/><br/><br/> <p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div>
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
                            
                                <td colspan="2"><a  href="#" class="tooltip1"> <div class="margint10">  
                                <img src="images/meb-2.png" height="50" class="round-border" id="menu_link2"/><br/><br/><br/> <p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div>
                                                                                              </a></td>
                                <td>&nbsp;</td>
                                <td colspan="2"><a  href="#"  class="tooltip1"> <div class="margint10">  
                                <img src="images/meb-3.png" height="50" class="round-border" id="menu_link2"/><br/><br/><br/> <p  style="width:40px; margin:1em 0 0 0; padding:0"></p></div>
                                                                                              </a></td>
                            
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