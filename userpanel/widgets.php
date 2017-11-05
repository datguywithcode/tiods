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
        <a href="index.html" id="logo-img">
          <img src="images/logo.png" class="big-logo" alt="">
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
                            <span>Arya Stark</span>
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
                            <span>Arya Stark</span>
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
                            <span>Arya Stark</span>
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
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img src="images/United-Kingdom.png" data-no-retina  alt=""> English <span class="caret"></span></a>
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
        <!-- end of TOP NAVIGATION   -->
        <!-- - - - - - - - - - - - - -->


        <div class="container-fluid">
          
          <div class="row">
            <div class="col-md-12">
              <h3>Alert widgets</h3>
            </div>
          </div>

          <div class="row">

            <div class="col-lg-3 col-md-4 col-sm-6">

              <!-- NEW MESSAGES WIDGET - COLOR #1 -->
              <a href="#" class="text-widget color-1">
                <header><strong>2</strong> new messages</header>
                <small>in your message inbox</small>
                <span class="icon"><i class="ti-email"></i></span>
              </a> <!-- / NEW MESSAGES WIDGET - COLOR #1 -->

            </div> 
            <div class="col-lg-3 col-md-4 col-sm-6">

              <!-- NEW USERS WIDGET - COLOR #2 -->
              <a href="#" class="text-widget color-2">
                <header><strong>32</strong> new users</header>
                <small>have registered to your website</small>
                <span class="icon"><i class="ti-user"></i></span>
              </a> <!-- / NEW USERS WIDGET - COLOR #2 -->

            </div> 
            <div class="col-lg-3 col-md-4 col-sm-6">

              <!-- NEW ORDERS WIDGET - COLOR #3 -->
              <a href="#" class="text-widget color-3">
                <header><strong>12</strong> new orders</header>
                <small>placed on your store</small>
                <span class="icon"><i class="ti-shopping-cart"></i></span>
              </a> <!-- / NEW ORDERS WIDGET - COLOR #3 -->

            </div> 

            <div class="col-lg-3 col-md-4 col-sm-6">

              <!-- BANDWIDTH WIDGET - COLOR #4 -->
              <a href="#" class="text-widget color-4">
                <header><strong>568</strong> mb</header>
                <small>used bandwidth this week</small>
                <span class="icon"><i class="ti-cloud-down"></i></span>
              </a> <!-- / BANDWIDTH WIDGET - COLOR #4 -->

            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">

              <!-- NEW FILES WIDGET - COLOR #4 -->
              <a href="#" class="text-widget color-5">
                <header><strong>14</strong> new files</header>
                <small>uploaded by users</small>
                <span class="icon"><i class="ti-file"></i></span>
              </a> <!-- / NEW FILES WIDGET - COLOR #4 -->

            </div> 
            <div class="col-lg-3 col-md-4 col-sm-6">

              <!-- NEW COMMENTS WIDGET - COLOR #5 -->
              <a href="#" class="text-widget color-6">
                <header><strong>59 </strong> new comments</header>
                <small>waiting for approval</small>
                <span class="icon"><i class="ti-comment"></i></span>
              </a> <!-- / NEW COMMENTS WIDGET - COLOR #5 -->

            </div> 
            <div class="col-lg-3 col-md-6 col-sm-6">

              <!-- NEW FILES WIDGET - COLOR #4 -->
              <a href="#" class="text-widget color-2">
                <header><strong>1444</strong> items</header>
                <small>left in stock</small>
                <span class="icon"><i class="ti-star"></i></span>
              </a> <!-- / NEW FILES WIDGET - COLOR #4 -->

            </div> 
            <div class="col-lg-3 col-md-6 col-sm-6">

              <!-- NEW COMMENTS WIDGET - COLOR #5 -->
              <a href="#" class="text-widget color-1">
                <header><strong>2 </strong> payments received</header>
                <small>4 still pending</small>
                <span class="icon"><i class="ti-money"></i></span>
              </a> <!-- / NEW COMMENTS WIDGET - COLOR #5 -->

            </div> 

          </div>
          
            



      <footer>
        <p>Powered by <a href="#">Company</a> Admin Panel</p>
      </footer>


    </main> <!-- /playground -->



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
  <script src="js/d3.min.js"></script>
  <script src="js/epoch.min.js"></script>

  <script src="js/includes.js"></script>
  <script src="js/sugarrush.js"></script>
  <script>
  jQuery(document).ready(function() {
    // REAL TIME DATA GENERATOR
    /*
     * Real-time data generators for the example graphs in the documentation section.
     */
    (function() {

        /*
         * Class for generating real-time data for the area, line, and bar plots.
         */
        var RealTimeData = function(layers) {
            this.layers = layers;
            this.timestamp = ((new Date()).getTime() / 1000)|0;
        };

        RealTimeData.prototype.rand = function() {
            return parseInt(Math.random() * 100) + 50;
        };

        RealTimeData.prototype.history = function(entries) {
            if (typeof(entries) != 'number' || !entries) {
                entries = 60;
            }

            var history = [];
            for (var k = 0; k < this.layers; k++) {
                history.push({ values: [] });
            }

            for (var i = 0; i < entries; i++) {
                for (var j = 0; j < this.layers; j++) {
                    history[j].values.push({time: this.timestamp, y: this.rand()});
                }
                this.timestamp++;
            }

            return history;
        };

        RealTimeData.prototype.next = function() {
            var entry = [];
            for (var i = 0; i < this.layers; i++) {
                entry.push({ time: this.timestamp, y: this.rand() });
            }
            this.timestamp++;
            return entry;
        }

        window.RealTimeData = RealTimeData;


        /*
         * Gauge Data Generator.
         */
        var GaugeData = function() {};

        GaugeData.prototype.next = function() {
            return Math.random();
        };

        window.GaugeData = GaugeData;



        /*
         * Heatmap Data Generator.
         */

        var HeatmapData = function(layers) {
            this.layers = layers;
            this.timestamp = ((new Date()).getTime() / 1000)|0;
        };
        
        window.normal = function() {
            var U = Math.random(),
                V = Math.random();
            return Math.sqrt(-2*Math.log(U)) * Math.cos(2*Math.PI*V);
        };

        HeatmapData.prototype.rand = function() {
            var histogram = {};

            for (var i = 0; i < 1000; i ++) {
                var r = parseInt(normal() * 12.5 + 50);
                if (!histogram[r]) {
                    histogram[r] = 1;
                }
                else {
                    histogram[r]++;
                }
            }

            return histogram;
        };

        HeatmapData.prototype.history = function(entries) {
            if (typeof(entries) != 'number' || !entries) {
                entries = 60;
            }

            var history = [];
            for (var k = 0; k < this.layers; k++) {
                history.push({ values: [] });
            }

            for (var i = 0; i < entries; i++) {
                for (var j = 0; j < this.layers; j++) {
                    history[j].values.push({time: this.timestamp, histogram: this.rand()});
                }
                this.timestamp++;
            }

            return history;
        };

        HeatmapData.prototype.next = function() {
            var entry = [];
            for (var i = 0; i < this.layers; i++) {
                entry.push({ time: this.timestamp, histogram: this.rand() });
            }
            this.timestamp++;
            return entry;
        }

        window.HeatmapData = HeatmapData;


    })();

    // Real time line epoch

    var data3 = new RealTimeData(3);

    var chart = $('#real-time-bar').epoch({
        type: 'time.bar',
        data: data3.history(),
        axes: [],
        margins: { top: 0, right: 0, bottom: 0, left: 0 }
    });

    setInterval(function() { chart.push(data3.next()); }, 1000);
    chart.push(data3.next());


  });
  </script>
  </body>
</html>