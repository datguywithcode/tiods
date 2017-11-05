<!--// Footer //-->

<footer>
  <div class="container">
    <div class="row">
      <!--<aside class="widget text-widget col-md-4">
              <div class="widget-title"><h2>About Us</h2></div>
              
              <img src="images/logo.jpg" /><br /><br />
              
            </aside>
            <aside class="widget recentpost-widget col-md-4">
              <div class="widget-title"><h2>Quick Links</h2></div>
              <ul>
                <li>
                	<div class="posttext"><h5 class="white-text"><a href="#">About Us</a></h5></div>
                </li>
                <li>
                	<div class="posttext"><h5 class="white-text"><a href="#">Terms</a></h5></div>
                </li>
                <li>
                	<div class="posttext"><h5 class="white-text"><a href="#">Regulations</a></h5></div>
                </li>
              </ul>
            </aside>-->
      <aside class="widget twitter-widget col-md-4">
        <div class="widget-title">
          <h2><a href="contact-us.php">Contact Us</a></h2>
        </div>
        <div class="socialnetwork">
          <!--<ul>
                  <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                  <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                  <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                  <li><a href="#"><i class="fa fa-vimeo-square"></i></a></li>
                  <li><a href="#"><i class="fa fa-rss"></i></a></li>
                  <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                </ul>-->
        </div>
      </aside>
    </div>
  </div>
</footer>
<!--// Footer //-->
<div class="kdcopyright">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <p>&copy; Copyrights 2014-15, All rights reserved</p>
      </div>
      <a href="#" class="backtop"><i class="fa fa-angle-up"></i></a> </div>
  </div>
</div>
<div class="clear"></div>
</div>
<!--// Wrapper //-->
<!-- jQuery (necessary for JavaScript plugins) -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.bxslider.min.js"></script>
<script src="js/jquery.prettyphoto.js"></script>
<script src="js/jquery.countdown.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/filterable.js"></script>
<script src="js/jquery.accordion.js"></script>
<script src="js/functions.js"></script>

<?php 
error_reporting(0);
$reg="register.php?pl_id=".$_GET['pl_id']."&&pos=".$_GET['pos']."&&sponsor_id=".$_GET['sponsor_id'];
if(basename($_SERVER['REQUEST_URI'])==$reg){ ?>
<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom.min.js">
</script>
<link rel="stylesheet" type="text/css" 
              href="css/jquery-ui-1.10.4.custom.css" />
<link rel="stylesheet" type="text/css" 
              href="css/jquery-ui-1.10.4.custom.min.css"/>
       
  <script type="text/javascript">
       $(document).ready(function(){
        $("#bdate").datepicker({
            changeMonth:true,
        changeYear:true,
		yearRange: '1901:2013'
        });
  });

</script>
<?php  } ?>


</body>
</html>