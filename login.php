<?php include('include/header.php'); ?>

<!-- BEGIN SLIDER -->



<script>

function validated()

{

	var username=$("#username").val();

	var password=$("#password").val();

	

	if(username=='' || username==false)

	{

		alert('please enter username');

		return false;

	}

	

	else if(password=='' || password==false)

	{

		alert('please enter password');

		return false;

	

	}

	





}



</script>



<div class="entry-content">

  <div class="page_title2">

    <div class="container">

      <div class="title-1">

        <h1>Login</h1>

      </div>

      <div class="pagenation">

        <div class="moduletable breadcrumbs">

          <ul class="breadcrumbs list-unstyled list-inline">

            <li><a class="pathway" href="index.php">Home</a></li>

            /

            <li class="active"><span>Login</span></li>

          </ul>

        </div>

      </div>

    </div>

  </div>

  <!-- END SLIDER -->

  <!--// Main Content //-->

  <div class="main-content">

    <section class="pagesection" style="background-color: #ffffff; padding: 40px 0px 10px 0px;">

    <div class="container">

      <div class="row">

        <div class="col-md-6 col-sm-6 col-xs-12 center-block">

          <div class="panel panel-default p2">

            <div class="panel-heading2 text-center">Member Login</div>

            <div class="panel-body">

            <form class="form-horizontal" action="post-action.php" method="post">

              <input name="action" type="hidden" value="loginuser" />

			  <div style="color:red;  font-size:14px; font-weight:bold;">

                <?php if(isset($_GET['msg']) && !empty($_GET['msg'])) { ?>

                <span style="color:#F00;padding-left:10px;">

                <?php if($_GET['msg']=='wrong') { echo "Wrong Credential Details or account deactivated!";}  if($_GET['msg']=='logout') { echo "You Are Logout!";}?>

                </span><br/>

                <br/>

                <?php } ?>

              </div>

              <div class="form-group">

                <label for="inputEmail3" class="col-sm-2 control-label">Username</label>

                <div class="col-sm-10">

                  <input type="text" class="form-control" id="username" name="username" placeholder="Enter User Name*">

                </div>

              </div>

              <div class="form-group">

                <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

                <div class="col-sm-10">

                  <input type="password" class="form-control" id="password" name="password" placeholder="Enter Login Password*">

                </div>

              </div>

              </div>

              <div class="panel-footer2 text-center">

                <input type="submit" name="submit" onClick="return validated();" value="Login" class="login">
                
                <a href="forget.php">Forgot Your Password ?</a>

              </div>

            </form>

          </div>

        </div>

      </div>

    </div>

  </div>

</div>

</div>

</section>

</div>

<!--// Main Content //-->

<?php include('include/footer.php'); ?>

