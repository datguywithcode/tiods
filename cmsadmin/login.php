<?php 
session_start();
include("../lib/config.php");
$_SESSION['rand_no'] = mt_rand(1111111,9999999);
$_SESSION['page_url'] = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
// create rand no for password salt
$_SESSION['salt'] = mt_rand(1111,9999);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Template">
    <meta name="keywords" content="admin dashboard, admin, flat, flat ui, ui kit, app, web app, responsive">
    <link rel="shortcut icon" href="img/ico/favicon.png">
    <title>Login</title>

    <!-- Base Styles -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->


</head>

  <body class="login-body">

      <div class="login-logo">
          <img src="images/logo.png" width="250" alt=""/>
      </div>

      <h2 class="form-heading">Admin Panel</h2>
        <?php if(isset($_GET['msg'])): ?>
                     <div style="padding:5px;text-align:center;font-size:18px; color:#fff; font-weight:bold;"><br/><?php echo strip_tags($_GET['msg']); ?></div>
                <?php endif; ?>
        
      <div class="container log-row">
             <form  action="check-point.php" class="form-signin" id="myform" method="post">
         <input type="hidden" name="action" value="login">
                  <input type="hidden" name="token" value="<?php echo $_SESSION['rand_no']; ?>" />
              <div class="login-wrap">
                  <input type="text" class="form-control" placeholder="Enter Username" required name="username">
                  <input type="password" class="form-control" placeholder="Enter Password" name="password" required>
                  <input type="submit" name="submit" value="Login" class="btn btn-lg btn-success btn-block" type="submit">
                
                 
              </div>

            
          </form>
      </div>


      <!--jquery-1.10.2.min-->
      <script src="js/jquery-1.11.1.min.js"></script>
      <!--Bootstrap Js-->
      <script src="js/bootstrap.min.js"></script>
      <script src="js/jrespond..min.js"></script>

  </body>
</html>
