<?php // Destry session if it hasn't been used for 15 minute.
session_start();
	if (!isset($_SESSION["phone1"])) {
		header("location: pages/login.php"); 
    exit();
}
?>
<?php 
$session_id = preg_replace('#[^0-9]#i', '', $_SESSION["id"]); // filter everything but numbers and letters
$phone = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["phone1"]); // filter everything but numbers and letters
$password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["password"]); // filter everything but numbers and letters
include "db.php"; 
$sql = $db->query("SELECT * FROM users WHERE phone='$phone' AND password='$password' LIMIT 1"); // query the person
// ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
$existCount = mysqli_num_rows($sql); // count the row nums
if ($existCount > 0) { 
	while($row = mysqli_fetch_array($sql)){ 
			 $thisid = $row["id"];
			 $name = $row["name"];
			}
		} 
		else{
		echo "
		
		<br/><br/><br/><h3>Your account has been temporally deactivated</h3>
		<p>Please contact: <br/><em>(+25) 078 484-8236</em><br/><b>muhirwaclement@gmail.com</b></p>		
		Or<p><a href='pages/logout.php'>Click Here to login again</a></p>
		
		";
	    exit();
	}
?>

<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Ikimina">
  <meta name="author" content="Clement">

  <title>uPlus</title>

  <link rel="apple-touch-icon" href="assets/images/apple-touch-icon.png">
  <link rel="shortcut icon" href="assets/images/favicon.ico">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="assets/global/css/bootstrap.min3f0d.css?v2.2.0">
  <link rel="stylesheet" href="assets/global/css/bootstrap-extend.min3f0d.css?v2.2.0">
  <link rel="stylesheet" href="assets/css/site.min3f0d.css?v2.2.0">

 <!-- Plugins -->
  <link rel="stylesheet" href="assets/global/vendor/animsition/animsition.min3f0d.css?v2.2.0">
  <link rel="stylesheet" href="assets/global/vendor/asscrollable/asScrollable.min3f0d.css?v2.2.0">
  <link rel="stylesheet" href="assets/global/vendor/switchery/switchery.min3f0d.css?v2.2.0">
  <link rel="stylesheet" href="assets/global/vendor/intro-js/introjs.min3f0d.css?v2.2.0">
  <link rel="stylesheet" href="assets/global/vendor/slidepanel/slidePanel.min3f0d.css?v2.2.0">
  <link rel="stylesheet" href="assets/global/vendor/flag-icon-css/flag-icon.min3f0d.css?v2.2.0">
  <link rel="stylesheet" href="assets/global/vendor/waves/waves.min3f0d.css?v2.2.0">

<!-- Page -->
  <link rel="stylesheet" href="assets/examples/css/pages/profile.min3f0d.css?v2.2.0">

  <!-- Fonts 
  <link rel="stylesheet" href="assets/global/fonts/web-icons/web-icons.min3f0d.css?v2.2.0">-->
  <link rel="stylesheet" href="assets/global/fonts/brand-icons/brand-icons.min3f0d.css?v2.2.0">
  <link rel="stylesheet" href="assets/global/fonts/material-design/material-design.min3f0d.css?v2.2.0">
  <link rel="stylesheet" href="assets/global/fonts/brand-icons/brand-icons.min3f0d.css?v2.2.0">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,700'>
  
  <link rel="stylesheet" type="text/css" href="assets/css/timeline.css">
 
  <!-- Scripts -->
  <script src="assets/global/vendor/modernizr/modernizr.min.js"></script>
  <script src="assets/global/vendor/breakpoints/breakpoints.min.js"></script>
  <script>
    Breakpoints();
  </script>
  
  <script src="js/jquery.js"></script>
   <script src="js/uploadFile.js"></script>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
	</script>
  <script src="js/ajax_call.js"></script>
</head>
<body class="page-profile">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

  <nav class="site-navbar navbar navbar-inverse navbar-fixed-top navbar-mega" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle hamburger hamburger-close navbar-toggle-left hided"
      data-toggle="menubar">
        <span class="sr-only">Toggle navigation</span>
        <span class="hamburger-bar"></span>
      </button>
      <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-collapse"
      data-toggle="collapse">
        <i class="icon md-more" aria-hidden="true"></i>
      </button>
      <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
        <img class="navbar-brand-logo" src="assets/images/logo.png" title="Uplus">
        <span class="navbar-brand-text hidden-xs"> Uplus</span>
      </div>
      <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-search"
      data-toggle="collapse">
        <span class="sr-only">Toggle Search</span>
        <i class="icon md-search" aria-hidden="true"></i>
      </button>
    </div>

    <div class="navbar-container container-fluid">
      <!-- Navbar Collapse -->
      <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
		<!-- Navbar Toolbar -->
        <ul class="nav navbar-toolbar">
          <li class="hidden-float">
            <a class="icon md-search" data-toggle="collapse" href="#" data-target="#site-navbar-search"
            role="button">
              <span class="sr-only">Toggle Search</span>
            </a>
          </li>
        </ul>
	  
	  
        <!-- Navbar Toolbar Right -->
        <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
          <li class="dropdown" id="profile">
            <a class="navbar-avatar dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false"
            data-animation="scale-up" role="button">
              <span class="avatar avatar-online">
                <img src="profiles/<?php echo $thisid;?>.jpg" alt="...">
                <i></i>
              </span>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li role="presentation">
                <a href="profile.php" role="menuitem"><i class="icon wb-user" aria-hidden="true"></i> Profile</a>
              </li>
              <li role="presentation">
                <a href="privacy.php" role="menuitem"><i class="icon wb-settings" aria-hidden="true"></i> Settings</a>
              </li>
              <li class="divider" role="presentation"></li>
              <li role="presentation" >
                <a href="pages/logout.php" role="menuitem"><i class="icon wb-power" aria-hidden="true"></i> Logout</a>
</li>
            </ul>
          </li>
        </ul>
        <!-- End Navbar Toolbar Right -->
      </div>
      <!-- End Navbar Collapse -->

      <!-- Site Navbar Seach -->
      <div class="collapse navbar-search-overlap" id="site-navbar-search">
        <form role="search">
          <div class="form-group">
            <div class="input-search">
              <i class="input-search-icon md-search" aria-hidden="true"></i>
              <input type="text" class="form-control" name="site-search" placeholder="Search...">
              <button type="button" class="input-search-close icon md-close" data-target="#site-navbar-search"
              data-toggle="collapse" aria-label="Close"></button>
            </div>
          </div>
        </form>
      </div>
      <!-- End Site Navbar Seach -->
    </div>
  </nav>
  <div class="site-menubar site-menubar-dark">
    <div class="site-menubar-body">
      <ul class="site-menu">
        <li class="site-menu-item has-sub active open">
          <a href="home">
			<i class="site-menu-icon md-home" aria-hidden="true"></i>
            <span class="site-menu-title">Groups</span>
            <div class="site-menu-badge">
              <span class="badge badge-success">
			    <?php
					$sql1 = $db->query("SELECT * FROM `joined_ua` WHERE `userPhone` = '$phone' and acceptance = 'yes' ");
					$count_accounts = mysqli_num_rows($sql1);
					echo $count_accounts;
				?>
			  </span>
            </div>
          </a>
        </li> 
		  <li class="site-menu-item">
          <a href="ikimina.php">
           <i class="site-menu-icon md-refresh-sync" aria-hidden="true"></i>
            <span class="site-menu-title">Ikimina</span>
            <div class="site-menu-badge">
              <span class="badge badge-success">
          <?php
          $sql1 = $db->query("SELECT * FROM `joined_ua` WHERE groupType = 'IKIMINA' and  `userPhone` = '$phone' and acceptance = 'yes'");
          $count_accounts = mysqli_num_rows($sql1);
          echo $count_accounts;
        ?>
        </span>
            </div>
          </a>
        </li> 
        <li class="site-menu-item has-sub">
          <a href="onceof.php">
           <i class="site-menu-icon md-balance" aria-hidden="true"></i>
            <span class="site-menu-title">Fundraising</span>
            <div class="site-menu-badge">
              <span class="badge badge-success">
          <?php
          $sql1 = $db->query("SELECT * FROM `joined_ua` WHERE groupType = 'WEDDING' or groupType = 'TIGHT' and `userPhone` = '$phone' and acceptance = 'yes'");
          $count_accounts = mysqli_num_rows($sql1);
          echo $count_accounts;
        ?>
        </span>
            </div>
          </a>
        </li>  
        <li class="site-menu-item">
          <a href="investment.php">
			     <i class="site-menu-icon md-money-box" aria-hidden="true"></i>
            <span class="site-menu-title">Investment</span>
            <div class="site-menu-badge">
              <span class="badge badge-success">
			    <?php
					$sql1 = $db->query("SELECT * FROM `joined_ua` WHERE groupType = 'INVESTMENT' and `userPhone` = '$phone' and acceptance = 'yes'");
					$count_accounts = mysqli_num_rows($sql1);
					echo $count_accounts;
				?>
			  </span>
            </div>
          </a>
        </li> 
	  </ul>
    </div>
  </div>

  <!-- Page -->
  <div class="page animsition">
    <div class="page-content container-fluid">
      <div class="row">
        <div class="col-md-3">
          <!-- Page Widget -->
          <div class="widget widget-shadow text-center">
            <div class="widget-header">
              <div class="widget-header-content">
                <a class="avatar avatar-lg" href="javascript:void(0)">
                  <img src="assets/global/portraits/5.jpg" alt="...">
                </a>
                <h4 class="profile-user">Terrance arnold</h4>
                <p class="profile-job">Charity</p>
                <p>Friends and family Mugabo Serge got a car accident, 
				but by God's grace he survived, he is supposed to be operated as soon as posible. 
				Please he needs your support, whaterver you can give means a lot.</p>
                <button type="button" class="btn btn-primary">Change</button>
              </div>
            </div>
            <div class="widget-footer">
              <div class="row no-space">
                <div class="col-xs-6">
                  <strong class="profile-stat-count">260</strong>
                  <span>Raised</span>
                </div>
                <div class="col-xs-6">
                  <strong class="profile-stat-count">180</strong>
                  <span>Out of</span>
                </div>
              </div>
            </div>
          </div>
          <!-- End Page Widget -->
        </div>

        <div class="col-md-9">
          <!-- Panel -->
          <div class="panel">
            <div class="panel-body nav-tabs-animate nav-tabs-horizontal">
              <ul class="nav nav-tabs nav-tabs-line" data-plugin="nav-tabs" role="tablist">
                <li class="active" role="presentation"><a data-toggle="tab" href="#activities" aria-controls="activities"
                  role="tab"><span class="badge badge-danger">556</span> Joined </a></li>
                <li role="presentation"><a data-toggle="tab" href="#messages" aria-controls="messages"
                  role="tab">Invited</a></li>
                <li class="dropdown" role="presentation">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                    <span class="caret"></span>Groups </a>
                  <ul class="dropdown-menu" role="menu">
                    <li class="active" role="presentation"><a data-toggle="tab" href="#activities" aria-controls="activities"
                      role="tab">Activities <span class="badge badge-danger">5</span></a></li>
                    <li role="presentation"><a data-toggle="tab" href="#profile" aria-controls="profile"
                      role="tab">Profile</a></li>
                    <li role="presentation"><a data-toggle="tab" href="#messages" aria-controls="messages"
                      role="tab">Messages</a></li>
                  </ul>
                </li>
              </ul>

              <div class="tab-content">
                <div class="tab-pane active animation-slide-left" id="activities" role="tabpanel">
                  <ul class="list-group">
                  </ul>
				
                  <a class="btn btn-block btn-default profile-readMore" href="javascript:void(0)"
                  role="button">Show more</a>
                </div>
			  </div>
            </div>
          </div>
          <!-- End Panel -->
        </div>
      </div>
    </div>
  </div>
  <!-- End Page -->


  <!-- Footer -->
  <footer class="site-footer">
    <div class="site-footer-legal">© 2016 <a href="http://themeforest.net/item/remark-responsive-bootstrap-admin-template/11989202">Remark</a></div>
    <div class="site-footer-right">
      Crafted with <i class="red-600 icon md-favorite"></i> by <a href="http://themeforest.net/user/amazingSurge">amazingSurge</a>
    </div>
  </footer>
  <!-- Core  -->
  <script src="assets/global/vendor/jquery/jquery.min.js"></script>
  <script src="assets/global/vendor/bootstrap/bootstrap.min.js"></script>
  <script src="assets/global/vendor/animsition/animsition.min.js"></script>
  <script src="assets/global/vendor/asscroll/jquery-asScroll.min.js"></script>
  <script src="assets/global/vendor/mousewheel/jquery.mousewheel.min.js"></script>
  <script src="assets/global/vendor/asscrollable/jquery.asScrollable.all.min.js"></script>
  <script src="assets/global/vendor/ashoverscroll/jquery-asHoverScroll.min.js"></script>
  <script src="assets/global/vendor/waves/waves.min.js"></script>

  <!-- Plugins -->
  <script src="assets/global/vendor/switchery/switchery.min.js"></script>
  <script src="assets/global/vendor/intro-js/intro.min.js"></script>
  <script src="assets/global/vendor/screenfull/screenfull.min.js"></script>
  <script src="assets/global/vendor/slidepanel/jquery-slidePanel.min.js"></script>

  <!-- Scripts -->
  <script src="assets/global/js/core.min.js"></script>
  <script src="assets/js/site.min.js"></script>

  <script src="assets/js/sections/menu.min.js"></script>
  <script src="assets/js/sections/menubar.min.js"></script>
  <script src="assets/js/sections/sidebar.min.js"></script>

  <script src="assets/global/js/configs/config-colors.min.js"></script>
  <script src="assets/js/configs/config-tour.min.js"></script>

  <script src="assets/global/js/components/asscrollable.min.js"></script>
  <script src="assets/global/js/components/animsition.min.js"></script>
  <script src="assets/global/js/components/slidepanel.min.js"></script>
  <script src="assets/global/js/components/switchery.min.js"></script>
  <script src="assets/global/js/components/tabs.min.js"></script>

  <script src="assets/global/js/plugins/responsive-tabs.min.js"></script>


  <script>
    (function(document, window, $) {
      'use strict';

      var Site = window.Site;
      $(document).ready(function() {
        Site.run();
      });
    })(document, window, jQuery);
  </script>

</body>
</html>