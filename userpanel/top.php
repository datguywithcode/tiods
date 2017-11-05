 <nav class="navbar navbar-top navbar-static-top">
          <div class="container-fluid">

            <!-- sidebar collapse and toggle buttons get grouped for better mobile display -->
            <!--<div class="navbar-header nav">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-top">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand show-hide-sidebar hide-sidebar" href="#"><i class="fa fa-outdent"></i></a>
              <a class="navbar-brand show-hide-sidebar show-sidebar" href="#"><i class="fa fa-indent"></i></a>
            </div>-->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-top">

              

              <ul class="nav navbar-nav">

                <!-- start of LANGUAGE MENU -->
               <!-- <li class="dropdown language-nav">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img src="images/United-Kingdom.png" data-no-retina  alt=""> English <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#"><img src="images/Spain.png" data-no-retina  alt=""> Spanish</a></li>
                    <li><a href="#"><img src="images/France.png" data-no-retina  alt=""> French</a></li>
                    <li><a href="#"><img src="images/Germany.png" data-no-retina  alt=""> German</a></li>
                    <li><a href="#"><img src="images/Italy.png" data-no-retina  alt=""> Italian</a></li>
                  </ul>
                </li> -->
                <!-- end of LANGUAGE MENU -->
                
                <!-- start of OPEN NOTIFICATION PANEL BUTTON -->
                <?php 
                $str11="select * from message where reciever_id='$userId' and read_receiver=1 order by id desc";
                $res11=mysql_query($str11);
                $count11=mysql_num_rows($res11); ?>
                <li>
                  <a href="#" class="btn-show-chat">
                    <i class="ti-announcement"></i><span class="badge badge-warning"><?php echo $count11;?></span>
                  </a>
                </li>
                <!--<li  data-toggle="tooltip" data-placement="right" title="Check our Online Documentation">
                  <a href="#" class="search-field">
                    <i class="ti-heart" ></i>
                  </a>
                </li>-->
                <!-- end of OPEN NOTIFICATION PANEL BUTTON -->

              </ul>

            <!-- end of navbar-collapse -->
          </div>
          <!-- end of container-fluid -->
        </nav>
		
              <ul class="nav navbar-nav navbar-left nna">

                <!-- start of USER MENU -->
                <li class="dropdown user-profile">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    <div class="user-img-container">
                      <img src="<?php echo $userimage;?>" alt="My Image"> 
                    </div> 
					<font size="4">Welcome</font> <b><?php echo $result['first_name']." ".$result['last_name'];?></b> !<span class="chat-status success"></span>
                  </a>

                  <ul class="dropdown-menu" role="menu">
                    <li><a href="update-profile.php">My Profile</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                  </ul>
                </li>
                <!-- end of USER MENU -->

              </ul>
		
		
			<div class="nnb">
				<font size="4">You are on</font> <b><?php echo $obj_func->memType($result['mem_type']); ?> Membership</b><br />
				<font size="4">Personal Purchasing Points</font> = <b><?php echo $obj_func->personalPoint($result['user_id'],$result['mem_type']); ?></b>
			</div>
		
			<div class="nnc">
				<a href="../logout.php" class="btn btn-success"><b>Logout</b></a>
			</div>
			
		