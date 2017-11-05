<?php include("header.php");?>

<div class="full_page_photo" style="background-image: url(images/6.jpg);">
     <div class="container">
          <section class="call_to_action">
               <h4 class="animated bounceInDown">The promise of  <strong>healthy living!</strong></h4>
               <h4 class="animated bounceInUp">The promise of  <strong>financial freedom!!</strong></h4>
               <h4 class="animated bounceInUp skincolored">The promise of Support  <strong>Systems and Personal Development!!!</strong></h4>
          </section>
     </div>
</div>
<div class="main">
     <div class="container">
          <section class="hgroup">
               <h1><i class="fa fa-shopping-cart"></i> Shopping cart</h1>
               
               <ul class="breadcrumb pull-right">
                    <li><a href="index.php">Home</a> </li>
                    <li class="active"><span> Shopping cart </span></li>
               </ul>
          </section>
          <section class="article-text hero-feature">
               <div class="row">
                    <div class="col-sm-12 col-md-12">
<table class="table table-bordered tbl-cart">
						<thead>
                            <tr>
                                <td class="hidden-xs">Image</td>
                                <td>Product Name</td>
                                <td>Size</td>
                                <td>Color</td>
                                <td class="td-qty">Quantity</td>
                                <td>Unit Price</td>
                                <td>Sub Total</td>
                                <td>Remove</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="hidden-xs">
                                    <a href="detail.html">
                                        <img src="images/product-2.jpg" alt="Age Of Wisdom Tan Graphic Tee" title="" width="47" height="47">
                                    </a>
                                </td>
                                <td><a href="detail.html">Age Of Wisdom Tan Graphic Tee</a>
                                </td>
                                <td>
                                    <select name="" class="form-control">
                                        <option value="" selected="selected">S</option>
                                        <option value="">M</option>
                                    </select>
                                </td>
                                <td>-</td>
                                <td>
                                    <input type="number" name="pcs" value="1" class="form-control">
                                </td>
                                <td class="price">$ 122.21</td>
                                <td>$ 122.21</td>
                                <td class="text-center">
                                    <a href="#" class="remove_cart" rel="2">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="hidden-xs">
                                    <a href="detail.html">
                                        <img src="images/product-12.jpg" alt="Adidas Men Red Printed T-shirt" title="" width="47" height="47">
                                    </a>
                                </td>
                                <td><a href="detail.html">Adidas Men Red Printed T-shirt</a>
                                </td>
                                <td>
                                    <select name="" class="form-control">
                                        <option value="">S</option>
                                        <option value="" selected="selected">M</option>
                                    </select>
                                </td>
                                <td>
                                	<select name="" class="form-control">
                                        <option value="" selected="selected">Red</option>
                                        <option value="">Blue</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="pcs" value="1" class="form-control">
                                </td>
                                <td class="price">$ 20.63</td>
                                <td>$ 41.26</td>
                                <td class="text-center">
                                    <a href="#" class="remove_cart" rel="1">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6" align="right">Total</td>
                                <td class="total" colspan="2"><b>$ 163.47</b>
                                </td>
                            </tr>
                        </tbody>
					</table>

<div class="btn-group btns-cart" style="text-align: center;display: block;">
						<button type="button" class="btn btn-primary" onClick="window.location='catalogue.html'"><i class="fa fa-arrow-circle-left"></i> Continue Shopping</button>
						<button type="button" class="btn btn-primary">Update Cart</button>
						<button type="button" class="btn btn-primary" onClick="window.location='checkout.html'">Checkout <i class="fa fa-arrow-circle-right"></i></button>
					</div>

                         
                    </div>
                    
                    <div class="clearfix"></div>
                    <hr>
               </div>
          </section>
          
     </div>

     
     <?php include("footer.php");?>
</div>
<script src="js/jquery-latest.min.js"></script>
<script>window.jQuery || document.write('<script src="js/jquery-1.9.0.min.js"><\/script>')</script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/jquery.flexslider-min.js"></script>
<script src="js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.isotope.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.ui.totop.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script src="js/bootstrap.touchspin.js"></script>
<script type="text/javascript" src="js/wow.min.js"></script>
<script type="text/javascript" src="js/snap.svg-min.js"></script>
<script type="text/javascript" src="js/restart_theme.js"></script>
<script type="text/javascript" src="js/collapser.js"></script>
<script> 
$(document).ready(function(){
  $(".top-cart-title").click(function(){
    $(".top-cart-content").slideToggle("slow");
  });
  
});
</script>
</body>
</html>