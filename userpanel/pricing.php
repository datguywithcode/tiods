
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Welcome</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,700' rel='stylesheet' type='text/css'>

    <link href="css/epoch.min.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">

    <!-- SugarRush CSS -->
    <!-- <link href="css/sugarrush.css" rel="stylesheet"> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body class="">
    <div class="animsition">  
    
      <!-- start of LOGO CONTAINER -->
      <div id="logo-container">
        <a href="#" id="logo-img">
          <img src="images/logo.png" class="big-logo" alt="SugarCrush">
          <img src="images/logo-mobile.png" data-no-retina  class="small-logo" alt="">
        </a>
      </div>
      <!-- end of LOGO CONTAINER -->

      <!-- - - - - - - - - - - - - -->
      <!-- start of SIDEBAR        -->
      <!-- - - - - - - - - - - - - -->
      <div id="sidebar">
        <div class="sidebar_scroll"> <!-- start of slimScroll -->

          <!--
          <div class="welcome">
            <div class="left">
              <div class="img-container">
                <img src="../demofiles/demoimage.gif" class="welcome-img">
              </div>
            </div>

            <div class="right">
              <span>Welcome, <strong>Bruno</strong></span>
              <ul class="user-options">
                <li><a href="#"><i class="ti-user"></i></a></li>
                <li><a href="#"><i class="ti-pencil"></i></a></li>
                <li><a href="#"><i class="ti-settings"></i></a></li>
                <li><a href="#"><i class="ti-power-off"></i></a></li>
              </ul>
            </div>
          </div>
          -->

          <ul class="nav lg-menu" id="main-nav">
            <li class="sidebar-title">
              <h5 class="text-center margin-bottom-30 margin-top-15">Navigation</h5>
            </li>
            <li><a href="index.html"> <i class="ti-dashboard"></i> <span>Dashboard</span></a>
            </li>

            <li><a href="#"> <i class="ti-email"></i> <span>Messages</span> <i class="pull-right has-submenu ti-angle-right"></i> <span class="label label-info label-as-badge">12</span></a>
              <ul class="nav nav-submenu submenu-hidden"> 
                <li><a href="inbox.html">Inbox</a></li>
                <li><a href="compose.html" class="active_submenu">Compose</a></li>
                <li><a href="readmessage.html">Read message</a></li>
              </ul>
            </li>

            <li><a href="#"> <i class="ti-user"></i> <span>Users</span> <i class="pull-right has-submenu ti-angle-right"></i></a>
              <ul class="nav nav-submenu submenu-hidden"> 
                <li><a href="allusers.html">All Users</a></li>
                <li><a href="addnew.html">Add new</a></li>
              </ul>
            </li>

            <li><a href="#"> <i class="ti-package"></i> <span>Extra pages</span> <i class="pull-right has-submenu ti-angle-right"></i> <span class="label label-danger">hot!</span></a>
              <ul class="nav nav-submenu submenu-hidden"> 
                <li><a href="login.html">Login</a></li>
                <li><a href="recover.html">Recover password</a></li>
                <li><a href="register.html">Register</a></li>
                <li><a href="lockscreen.html">Locked screen</a></li>
                <li><a href="#" >Blank page</a></li>
              </ul>
            </li>

            <li class="sidebar-title">
              <h5 class="text-center margin-bottom-30 margin-top-15">Demos &amp; Docs</h5>
            </li>
            
            <li><a href="#"> <i class="ti-layout-cta-left"></i> <span>UI / UX</span> <i class="pull-right has-submenu ti-angle-right"></i></a>
              <ul class="nav nav-submenu submenu-hidden"> 
                <li><a href="#" >Typography</a></li>
                <li><a href="#" >UI Elements</a></li>
                <li><a href="#" >Lists</a></li>
                <li><a href="#" >Panels</a></li>
                <li><a href="#" >Alerts</a></li>
                <li><a href="#" >Buttons</a></li>
                <li><a href="#" >Calendar</a></li>
                <li><a href="#" >Maps</a></li>
                <li><a href="#" >File upload</a></li>
                <li><a href="#">Star rating</a></li>
              </ul>
            </li>

            <li><a href="#" > <i class="ti-plug"></i> <span>Widgets</span> <span class="label label-warning">40+</span></a></li>

            <li><a href="#"> <i class="ti-smallcap"></i> <span>Forms</span> <i class="pull-right has-submenu ti-angle-right"></i></a>
              <ul class="nav nav-submenu submenu-hidden"> 
                <li><a href="#">Form Elements</a></li>
                <li><a href="#">Validation</a></li>
                <li><a href="#">Wizard</a></li>
              </ul>
            </li>
            <li><a href="#"> <i class="ti-layout-grid3-alt"></i> <span>Tables</span> <i class="pull-right has-submenu ti-angle-right"></i></a>
              <ul class="nav nav-submenu submenu-hidden"> 
                <li><a href="datatables.html">Data tables</a></li>
                <li><a href="pricing.html">Price tables</a></li>
              </ul>
            </li>
            <li><a href="charts.html"> <i class="ti-bar-chart"></i> <span>Charts</span></a></li>
            <li><a href="#"> <i class="ti-palette"></i> <span>Styles configuration</span></a></li>

            <li class="sidebar-title">
              <h5 class="text-center margin-bottom-30 margin-top-15">Widgets</h5>
            </li>
            <li class="widget">
              <div class="form-group">
                <div class="small"><span class="initialism">Bandwidth</span> <span class="pull-right label label-primary">90%</span></div>
                <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;"></div>
                </div>
              </div>
              <div class="form-group">
                <div class="small">CPU usage <span class="pull-right label label-warning">51%</span></div>
                <div class="progress">
                  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="51" aria-valuemin="0" aria-valuemax="100" style="width: 51%;"></div>
                </div>
              </div>
              <div class="form-group">
                <div class="small">Database <span class="pull-right label label-danger">6%</span></div>
                <div class="progress">
                  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="6" aria-valuemin="0" aria-valuemax="100" style="width: 6%;"></div>
                </div>
              </div>
            </li>

          </ul>

        </div> <!-- end of slimScroll -->
      </div>
      <!-- - - - - - - - - - - - - -->
      <!-- end of SIDEBAR          -->
      <!-- - - - - - - - - - - - - -->


      <main id="playground">

            
        <!-- - - - - - - - - - - - - -->
        <!-- start of TOP NAVIGATION -->
        <!-- - - - - - - - - - - - - -->
        <nav class="navbar navbar-top navbar-static-top">
          <div class="container-fluid">

            <!-- sidebar collapse and toggle buttons get grouped for better mobile display -->
            <div class="navbar-header nav">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-top">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand show-hide-sidebar hide-sidebar" href="#"><i class="fa fa-outdent"></i></a>
              <a class="navbar-brand show-hide-sidebar show-sidebar" href="#"><i class="fa fa-indent"></i></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-top">

              <!-- start of SEARCH BLOCK -->
              <div class="navbar-form navbar-left navbar-search-block">

                <div class="search-field-container">
                  <input type="text" placeholder="Search" class="search-field">
                  <a href="#"><i class="ti-search"></i></a>
                </div>

                <!-- start of CLOSE BUTTON -->
                <a href="#" class="btn btn-danger search-close"><i class="ti-close"></i></a>
                <!-- end of CLOSE BUTTON -->

                <div class="container-fluid search-container">
                  <div class="row">

                    <!-- start of CONTACTS COLUMN -->
                    <div class="col-md-4">
                      <h3>Contacts</h3>
                      <ul>
                        <li>
                          <a href="#">
                            <div class="img-container">
                              <img src="images/demoimage.gif" alt="">
                            </div>
                            <span>Jon Snow</span>
                          </a>
                        </li>

                        <li>
                          <a href="#">
                            <div class="img-container">
                              <img src="images/demoimage.gif" alt="">
                            </div>
                            <span>Steven T.</span>
                          </a>
                        </li>

                        <li>
                          <a href="#">
                            <div class="img-container">
                              <img src="images/demoimage.gif" alt="">
                            </div>
                            <span>Bruno Q.</span>
                          </a>
                        </li>

                        <li>
                          <a href="#">
                            <div class="img-container">
                              <img src="images/demoimage.gif" alt="">
                            </div>
                            <span>Rolf E.</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                    <!-- end of CONTACTS COLUMN -->

                    <!-- start of MESSAGES COLUMN -->
                    <div class="col-md-4">
                      <h3>Messages</h3>
                      <ul>
                        <li>
                          <a href="#">
                            <div class="img-container">
                              <img src="images/demoimage.gif" alt="">
                            </div>
                            <span>Jon Snow</span>
                          </a>
                        </li>

                        <li>
                          <a href="#">
                            <div class="img-container">
                              <img src="images/demoimage.gif" alt="">
                            </div>
                            <span>Steven T.</span>
                          </a>
                        </li>

                        <li>
                          <a href="#">
                            <div class="img-container">
                              <img src="images/demoimage.gif" alt="">
                            </div>
                            <span>Bruno Q.</span>
                          </a>
                        </li>

                        <li>
                          <a href="#">
                            <div class="img-container">
                              <img src="images/demoimage.gif" alt="">
                            </div>
                            <span>Rolf E.</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                    <!-- end of MESSAGES COLUMN -->

                    <!-- start of RECENT COLUMN -->
                    <div class="col-md-4">
                      <h3>Recent</h3>
                      <ul>
                        <li>
                          <a href="#">
                            <div class="img-container">
                              <img src="images/demoimage.gif" alt="">
                            </div>
                            <span>Jon Snow</span>
                          </a>
                        </li>

                        <li>
                          <a href="#">
                            <div class="img-container">
                              <img src="images/demoimage.gif" alt="">
                            </div>
                            <span>Steven T.</span>
                          </a>
                        </li>

                        <li>
                          <a href="#">
                            <div class="img-container">
                              <img src="images/demoimage.gif" alt="">
                            </div>
                            <span>Bruno Q.</span>
                          </a>
                        </li>

                        <li>
                          <a href="#">
                            <div class="img-container">
                              <img src="images/demoimage.gif" alt="">
                            </div>
                            <span>Rolf E.</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                    <!-- end of RECENT COLUMN -->

                  </div>
                </div>

              </div>
              <!-- end of SEARCH BLOCK -->

              <ul class="nav navbar-nav">

                <!-- start of LANGUAGE MENU -->
                <li class="dropdown language-nav">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img src="../src/img/flags/United-Kingdom.png" data-no-retina  alt=""> English <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#"><img src="images/Spain.png" data-no-retina  alt=""> Spanish</a></li>
                    <li><a href="#"><img src="images/France.png" data-no-retina  alt=""> French</a></li>
                    <li><a href="#"><img src="images/Germany.png" data-no-retina  alt=""> German</a></li>
                    <li><a href="#"><img src="images/Italy.png" data-no-retina  alt=""> Italian</a></li>
                  </ul>
                </li>
                <!-- end of LANGUAGE MENU -->
                
                <!-- start of OPEN NOTIFICATION PANEL BUTTON -->
                <li>
                  <a href="#" class="btn-show-chat">
                    <i class="ti-announcement"></i><span class="badge badge-warning">4</span>
                  </a>
                </li>
                <li  data-toggle="tooltip" data-placement="right" title="Check our Online Documentation">
                  <a href="#">
                    <i class="ti-heart"></i>
                  </a>
                </li>
                <!-- end of OPEN NOTIFICATION PANEL BUTTON -->

              </ul>

              <ul class="nav navbar-nav navbar-right">

                <!-- start of USER MENU -->
                <li class="dropdown user-profile">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    <div class="user-img-container">
                      <img src="images/demoimage.gif" alt=""> 
                    </div> 
                    Jon Snow <span class="chat-status success"></span>
                  </a>

                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Profile</a></li>
                    <li><a href="#">Settings</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Lock</a></li>
                    <li><a href="#">Logout</a></li>
                  </ul>
                </li>
                <!-- end of USER MENU -->

              </ul>
            </div>
            <!-- end of navbar-collapse -->
          </div>
          <!-- end of container-fluid -->
        </nav>

        <!-- - - - - - - - - - - - - -->
        <!-- end of TOP NAVIGATION -->
        <!-- - - - - - - - - - - - - -->


        <!-- PAGE TITLE -->
        <section id="page-title" class="row">

          <div class="col-md-8">
            <h1>Pricing Tables</h1>
            <p class="lead">Compare plans and prices</p>
          </div>

          <div class="col-md-4">

            <ol class="breadcrumb pull-right no-margin-bottom">
              <li><a href="#">Documentation</a></li>
              <li><a href="#">Tables</a></li>
              <li class="active">Pricing tables</li>
            </ol>

          </div>
        </section> <!-- / PAGE TITLE -->

        <div class="container-fluid">
          <div class="row">
       
            <div class="col-md-3">
              <div class="widget price-table">
                <section class="panel panel-success">
                  <header class="panel-heading">
                    <h4 class="panel-title">Simple</h4>
                  </header>
                  <div class="panel-body">
                    <div class="price text-success">
                      <span>$</span>19<small>99</small>
                    </div>
                  </div>
                  
                </section>
                <div class="plan-info">
                  15 e-mail accounts
                </div>
                <div class="plan-info">
                  100GB space
                </div>
                <div class="plan-info">
                  1 domain name
                </div>
                <div class="plan-info">
                  500GB bandwidth
                </div>
                <a href="#" class="add-to-cart btn btn-success">Add to cart</a>

              </div> <!-- / widget price-table -->

            </div> <!-- / col-md-3 -->

            <div class="col-md-3">
              <div class="widget price-table">
                <section class="panel panel-warning">
                  <header class="panel-heading">
                    <h4 class="panel-title">Standard</h4>
                  </header>
                  <div class="panel-body">
                    <div class="price text-warning">
                      <span>$</span>39<small>99</small>
                    </div>
                  </div>
                  
                </section>
                <div class="plan-info">
                  25 e-mail accounts
                </div>
                <div class="plan-info">
                  200GB space
                </div>
                <div class="plan-info">
                  3 domain name
                </div>
                <div class="plan-info">
                  1TB bandwidth
                </div>
                <a href="#" class="add-to-cart btn btn-warning">Add to cart</a>

              </div> <!-- / widget price-table -->

            </div> <!-- / col-md-3 -->

            <div class="col-md-3">
              <div class="widget price-table">
                <section class="panel panel-primary">
                  <header class="panel-heading">
                    <h4 class="panel-title">Pro</h4>
                  </header>
                  <div class="panel-body">
                    <div class="price text-primary">
                      <span>$</span>99<small>99</small>
                    </div>
                  </div>
                  
                </section>
                <div class="plan-info">
                  unlimited e-mail accounts
                </div>
                <div class="plan-info">
                  500GB space
                </div>
                <div class="plan-info">
                  5 domain name
                </div>
                <div class="plan-info">
                  5TB bandwidth
                </div>
                <a href="#" class="add-to-cart btn btn-primary">Add to cart</a>

              </div> <!-- / widget price-table -->

            </div> <!-- / col-md-3 -->

            <div class="col-md-3">
              <div class="widget price-table">
                <section class="panel panel-danger">
                  <header class="panel-heading">
                    <h4 class="panel-title">Ultimate</h4>
                  </header>
                  <div class="panel-body">
                    <div class="price text-danger">
                      <span>$</span>139<small>99</small>
                    </div>
                  </div>
                  
                </section>
                <div class="plan-info">
                  unlimited e-mail accounts
                </div>
                <div class="plan-info">
                  unlimited space
                </div>
                <div class="plan-info">
                  15 domain name
                </div>
                <div class="plan-info">
                  unlimited bandwidth
                </div>
                <a href="#" class="add-to-cart btn btn-danger">Add to cart</a>

              </div> <!-- / widget price-table -->

            </div> <!-- / col-md-3 -->

          </div> <!-- / row -->

        </div> <!-- / container-fluid -->



      <footer>
        <p>Powered by <a href="#">Company</a> Admin Panel</p>
      </footer>


    </main> <!-- /playground -->


    <!-- - - - - - - - - - - - - -->
    <!-- start of NOTIFICATIONS  -->
    <!-- - - - - - - - - - - - - -->
    <aside id="multi-panel">
      <div class="container-fluid no-margin slimscroll">

        <ul id="multi-panel-tabs" class="nav nav-tabs" role="tablist">
          <li><a href="#" class="close-multi-panel"><i class="fa fa-indent"></i></a></li>
          <li role="presentation" class="active"><a href="#contacts" role="tab" id="contacts-tab" data-toggle="tab" aria-controls="contacts" aria-expanded="true">Contacts</a></li>
          <li role="presentation"><a href="#alerts" id="alerts-tab" role="tab" data-toggle="tab" aria-controls="alerts">Alerts</a></li>
        </ul> 

        <section class="panel ">
            
          <div id="multi-panel-tabs-content" class="tab-content">




            <!-- Chat -->
            <div role="tabpanel" class="tab-pane fade in active" id="contacts" aria-labelledby="contacts-tab">

              <div class="widget chat-widget list-group">
                <a class="list-group-item" href="#">
                  <span class="chat-status success"></span> Daenerys Targaryen <span class="label label-warning pull-right">13</span>
                </a>
              </div>

              <div class="widget chat-widget list-group">
                <a class="list-group-item" href="#">
                  <span class="chat-status success"></span> Tyrion Lannister
                </a>
              </div>

              <div class="widget chat-widget list-group">
                <a class="list-group-item" href="#">
                  <span class="chat-status warning"></span> Cersei Lannister <span class="label label-warning pull-right">2</span>
                </a>
              </div>

              <div class="widget chat-widget list-group">
                <a class="list-group-item" href="#">
                  <span class="chat-status danger"></span> Arya Stark
                </a>
              </div>

              <div class="widget chat-widget list-group">
                <a class="list-group-item" href="#">
                  <span class="chat-status danger"></span> Sansa Stark
                </a>
              </div>

            </div> <!-- / Chat -->

            <!-- Alerts -->
            <div role="tabpanel" class="tab-pane fade" id="alerts" aria-labelledby="alerts-tab">
              
              <div class="widget">

                <h4 class="widget-title">Tasks Updated</h4>
                <div class="panel-body">
                  <div class="form-group">
                    <div class="small"><span class="initialism">HTML</span> coding <span class="pull-right label label-danger">90%</span></div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;"></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="small">Server setup <span class="pull-right label label-info">21%</span></div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="21" aria-valuemin="0" aria-valuemax="100" style="width: 21%;"></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="small">Bandwidth <span class="pull-right label label-warning">16%</span></div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="16" aria-valuemin="0" aria-valuemax="100" style="width: 16%;"></div>
                    </div>
                  </div>
                </div>

              </div>

              <!-- MESSAGES WIDGET -->
              <div class="widget messages-widget">
                <h4 class="widget-title">New Messages</h4>
                <ul class="list-group">
                  <li class="list-group-item unread">
                    <span class="from"><a href="#">Jon Snow</a></span> <span class="label label-success">Jobs</span>
                    <p><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></p>
                  </li>
                  <li class="list-group-item">
                    <span class="from"><a href="#">Cersei Lannister</a></span> <span class="label label-info">PHP</span> <span class="label label-danger">Javascript</span>
                    <p><a href="#">Class aptent taciti sociosqu ad litora torquent per conubia nostra, vestibulum.</a></p>
                  </li>
                  <li class="list-group-item">
                    <span class="from"><a href="#">Sansa Stark</a></span>
                    <p><a href="#">Aenean cursus lacinia dolor et lacinia. Duis felis, venenatis et.</a></p>
                  </li>
                </ul>
              </div> <!-- / MESSAGES WIDGET -->

              <!-- MESSAGES WIDGET -->
              <div class="widget files-widget">
                <h4 class="widget-title">New Uploads</h4>
                <ul class="list-group">
                  <li class="list-group-item unread">
                    <i class="ti-clip"></i> <span class="from"><a href="#">project1.jpg</a></span> by <strong>Sansa S.</strong>
                    <a href="#" class="btn btn-danger btn-xs pull-right"><i class="ti-cloud-down"></i></a>
                  </li>
                  <li class="list-group-item">
                    <i class="ti-clip"></i> <span class="from"><a href="#">userlist.xls</a></span> by <strong>Jamie L.</strong>
                    <a href="#" class="btn btn-danger btn-xs pull-right"><i class="ti-cloud-down"></i></a>
                  </li>
                  <li class="list-group-item unread">
                    <i class="ti-clip"></i> <span class="from"><a href="#">userphoto.jpg</a></span> by <strong>John S.</strong>
                    <a href="#" class="btn btn-danger btn-xs pull-right"><i class="ti-cloud-down"></i></a>
                  </li>
                  <li class="list-group-item">
                    <i class="ti-clip"></i> <span class="from"><a href="#">item_codecanyon.rar</a></span> by <strong>Sansa S.</strong>
                    <a href="#" class="btn btn-danger btn-xs pull-right"><i class="ti-cloud-down"></i></a>
                  </li>
                </ul>
              </div> <!-- / MESSAGES WIDGET -->


            </div> <!-- / Alerts -->

          </div>

        </section>


      </div>
    </aside>
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
  <script src="js/jquery.dataTables.min.js"></script>

  <script src="js/includes.js"></script>
  <script src="js/sugarrush.js"></script>
  <script src="js/sugarrush.tables.js"></script>
  </body>
</html>