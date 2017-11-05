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
  
    $condition = "user_id ='".$_SESSION['user_id']."'";
    $sql = $obj_rep->query('*', 'admin', $condition);
	$args_user=$obj_rep->get_all_row($sql);
  }
}
// store random no for security
$_SESSION['rand'] = mt_rand(1111111,9999999); 



                
if(isset($_POST['Add']))
{
global $mxDb;
$strSubject = "Newsletter From My Company";  
$from ='kamlesh@powerhouse.com';
if($_POST['list']!='' && $_POST['description']!='')
{
$email=$_POST['list'];
$arr=implode(",",$email);
$des=$_POST['description'];
$text = $des ;
if(isset($args_page['post_content']))
{
$text = stripslashes($args_page['post_content']);
$text = str_replace('src="','src="../',$text);
}

$strSid = md5 ( uniqid ( time () ) );
$strHeader = "";
$strHeader .= "From:<" . $from . ">\nReply-To: " . $from . "";                              
$strHeader .= "MIME-Version: 1.0\n";
$strHeader .= "Content-Type: multipart/mixed; boundary=\"" . $strSid . "\"\n\n";
$strHeader .= "This is a multi-part message in MIME format.\n";
$strHeader .= "--" . $strSid . "\n";
$strHeader .= "Content-type: text/html; charset=utf-8\n";
$strHeader .= "Content-Transfer-Encoding: 7bit\n\n";
$strHeader .= " \n\n";
$strHeader .= "  <br>";
$msg = '<html>

<body>

<fieldset style="border-color:#09F;background-color:#ebebeb;width:700px;"><table width="700" border="0" cellspacing="5" cellpadding="1">
<tr>
  <td colspan="2">&nbsp;<img src="http://198.154.241.136/~kamlesh/fluker/images/logo.png" width="300" height="80" /><br/></td>
  
</tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td colspan="2">'.$text.'</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td  colspan="3" align="justify"><strong>Thank You <br/><br/> My Company Team </strong></td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
</table></fieldset>
</body>
</html>';
mail ( $arr, $strSubject, $msg, $strHeader );
header("Location:email-section.php?msg=Newsletter sent successfully!");
}
else
{
header("Location:email-section.php?msg=Some technical error!");
}
}
?>

<!DOCTYPE html>
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
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>

<script type="text/javascript">
function ValidateData(form)
{
 var chks = document.getElementsByName('list[]');
 var hasChecked = false;
 for (var i = 0; i < chks.length; i++)
 {
  if(chks[i].checked)
  {
   hasChecked = true;
   break;
  }
 }
 if (hasChecked == false)
 {
  alert("Please select at least one Request.");
  return false;
 }
} 
function Check(chk)
{
 var chk = document.getElementsByName('list[]');
 if(document.myform.Check_All.value=="Check All")
 {
  for (i = 0; i < chk.length; i++)
  chk[i].checked = true ;
  document.myform.Check_All.value="UnCheck All";
 }
 else
 {
  for (i = 0; i < chk.length; i++)
  chk[i].checked = false ;
  document.myform.Check_All.value="Check All";
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
                                User Email Management
                                    <span class="tools pull-right">
                                    <a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                                    <a class="t-close fa fa-times" href="javascript:;"></a>
                                </span>
                            </header>
                            <div class="table-responsive">
                            <form name="myform" onSubmit="return ValidateData(this);" method="post" >

                     
                            <table class="table responsive-data-table table-responsive data-table">
                            <thead>
                            <tr style="text-align:center;">
                                <th style="text-align:center;">
                                    S.No
                                </th>
                                <th style="text-align:center;">
                                    <input type="button" name="Check_All" value="Check All" onclick="Check(document.myform.check_list)" />
                                </th>
                                <th style="text-align:center;">
                                    Userid
                                </th>
                                 <th style="text-align:center;">
                                    Username
                                </th>
                                  <th style="text-align:center;">
                                    Full Name
                                </th>
                                
                                
                               
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                                  $i=1;
                                  $data=mysql_query("select * from user_registration");
                                  while($data1=mysql_fetch_array($data))
                                    { ?>
                            <tr style="text-align:center;">
                                <td>
                                    <?php echo $i;?>
                                </td>
                                <td>
                                   <input type="checkbox" name="list[]" id="list[]" value="<?php echo $data1['email'] ?>">
                                </td>
                                <td>
                                    <?php echo $data1['user_id'];?>
                                </td>
                              
                                  <td>
                                    <?php echo $data1['username'];?>
                                </td>
                                  <td>
                                    <?php echo $data1['first_name']." ".$data1['last_name']; ?>
                                </td>
                               
                            </tr>
                            <?php $i++;} ?>
                            
                      
                            </tbody>
                            </table>
                             <div style="text-align:center;"><textarea id="editor1" name="description" required> </textarea></div><br/><br/>
                         <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <input type="submit" class="btn btn-primary" name="Add" value="Submit">
                                    </div>
                                </div></form>
                            </div>
                        </section>
                    </div>

                </div>

            </div>
            <!--body wrapper end-->

 <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace( 'editor1',
                                {
                                    filebrowserBrowseUrl : 'ckeditor/ckfinder/ckfinder.html',
                                    filebrowserImageBrowseUrl : 'ckeditor/ckfinder/ckfinder.html?type=Images',
                                    filebrowserFlashBrowseUrl : 'ckeditor/ckfinder/ckfinder.html?type=Flash',
                                    filebrowserUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                    filebrowserImageUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                    filebrowserFlashUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
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