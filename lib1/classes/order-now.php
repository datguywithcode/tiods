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
               <h1>Order Now</h1>
               
               <ul class="breadcrumb pull-right">
                    <li><a href="index.php">Home</a> </li>
                    <li class="active">Order Now</li>
               </ul>
          </section>

        <div class="row">
          <div class="col-sm-12">
            <!-- Filters -->
            <ul class="nav nav-tabs nav-justified">
              <li class="active"><a href="#popular" data-toggle="tab">Most Popular</a></li>
              <li class=""><a href="#recommended" data-toggle="tab">Recommended</a></li>
              <li class=""><a href="#recent" data-toggle="tab">Recently Added</a></li>
              <li class=""><a href="#last" data-toggle="tab">Last Chance</a></li>
            </ul>


              <div class="tab-content wht-box">

                <!-- All-->
                <div class="tab-pane fade active in" id="popular">
                
                <?php $product_show=mysql_query("select * from products where status='0' and mode='Most Popular' order by product_id desc");
				      while($products=mysql_fetch_array($product_show)){
				
				?>
                  <div class="col-sm-3">
                    <div class="shop-product featured">
                      <a href="#"><img src="product_images/<?php echo $products['m_image'];?>" class="img-responsive" alt="..."></a>
                      <a href="#"><h5 class="primary-font"><?php echo $products['product_name'];?></h5></a>
                      <p class="text-muted">
                        <?php echo strip_tags(substr($products['description'],0,50),'<p></p>');?>...
                      </p>
                      <p class="price">
                        <span class="new">$ <?php echo number_format($products['price'],2);?></span>
                        <span class="new"><?php echo $products['points'];?> BV</span>
                      </p>
                        <a href="javascript:void(0)"><button type="button" title="Add to Cart" class="btn btn-sm btn-primary"  onClick="AddToCart(<?php echo $products['product_id'];?>,'cart_total','popup',<?php echo $_SESSION['rand']; ?>,1)"><span><span><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Add to Cart</span></span></button></a>
              
                     
                    </div>
                  </div>
                  
                  <?php } ?>
                 
                </div>

                <!-- Ebooks -->
                <div class="tab-pane fade" id="recommended">
                   <?php $product_show=mysql_query("select * from products where status='0' and mode='Recommended' order by product_id desc");
				      while($products=mysql_fetch_array($product_show)){
				
				?>
                  <div class="col-sm-3">
                    <div class="shop-product featured">
                      <a href="#"><img src="product_images/<?php echo $products['m_image'];?>" class="img-responsive" alt="..."></a>
                      <a href="#"><h5 class="primary-font"><?php echo $products['product_name'];?></h5></a>
                      <p class="text-muted">
                        <?php echo strip_tags(substr($products['description'],0,50),'<p></p>');?>...
                      </p>
                      <p class="price">
                        <span class="new">$ <?php echo number_format($products['price'],2);?></span>
                        <span class="new"><?php echo $products['points'];?> BV</span>
                      </p>
                       <a href="javascript:void(0)"><button type="button" title="Add to Cart" class="btn btn-sm btn-primary"  onClick="AddToCart(<?php echo $products['product_id'];?>,'cart_total','popup',<?php echo $_SESSION['rand']; ?>,1)"><span><span><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Add to Cart</span></span></button></a>
              
                    </div>
                  </div>
                  
                  <?php } ?>
                </div>

                <!-- Audio CD -->
                <div class="tab-pane fade" id="recent">
                 <?php $product_show=mysql_query("select * from products where status='0' and mode='Recent' order by product_id desc");
				      while($products=mysql_fetch_array($product_show)){
				
				?>
                  <div class="col-sm-3">
                    <div class="shop-product featured">
                      <a href="#"><img src="product_images/<?php echo $products['m_image'];?>" class="img-responsive" alt="..."></a>
                      <a href="#"><h5 class="primary-font"><?php echo $products['product_name'];?></h5></a>
                      <p class="text-muted">
                        <?php echo strip_tags(substr($products['description'],0,50),'<p></p>');?>...
                      </p>
                      <p class="price">
                        <span class="new">$ <?php echo number_format($products['price'],2);?></span>
                        <span class="new"><?php echo $products['points'];?> BV</span>
                      </p>
                         <a href="javascript:void(0)"><button type="button" title="Add to Cart" class="btn btn-sm btn-primary"  onClick="AddToCart(<?php echo $products['product_id'];?>,'cart_total','popup',<?php echo $_SESSION['rand']; ?>,1)"><span><span><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Add to Cart</span></span></button></a>
              
                    </div>
                  </div>
                  
                  <?php } ?>
                </div>

                <!-- Audio CD -->
                <div class="tab-pane fade" id="last">
                  <?php $product_show=mysql_query("select * from products where status='0' and mode='Last Chance' order by product_id desc");
				      while($products=mysql_fetch_array($product_show)){
				
				?>
                  <div class="col-sm-3">
                    <div class="shop-product featured">
                      <a href="#"><img src="product_images/<?php echo $products['m_image'];?>" class="img-responsive" alt="..."></a>
                      <a href="#"><h5 class="primary-font"><?php echo $products['product_name'];?></h5></a>
                      <p class="text-muted">
                        <?php echo strip_tags(substr($products['description'],0,50),'<p></p>');?>...
                      </p>
                      <p class="price">
                        <span class="new">$ <?php echo number_format($products['price'],2);?></span>
                        <span class="new"><?php echo $products['points'];?> BV</span>
                      </p>
                        <a href="javascript:void(0)"><button type="button" title="Add to Cart" class="btn btn-sm btn-primary"  onClick="AddToCart(<?php echo $products['product_id'];?>,'cart_total','popup',<?php echo $_SESSION['rand']; ?>,1)"><span><span><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Add to Cart</span></span></button></a>
              
                    </div>
                  </div>
                  
                  <?php } ?>
              </div> <!-- /.tab-content -->         


            <!-- Pagination 
            <div class="row">
              <div class="col-sm-12">
                <ul class="pagination pull-right">
                  <li class="disabled"><a href="#">«</a></li>
                  <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li><a href="#">5</a></li>
                  <li><a href="#">»</a></li>
                </ul>
              </div>
            </div> <!-- / .row -->
            
          </div> <!-- / .col-sm-8 -->
        </div> <!-- / .row -->


          
    </div>
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