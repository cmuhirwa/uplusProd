<?php // Get me backif i havent logedin
session_start();
	if (!isset($_SESSION["phone1"])) {
		header("location: logout.php"); 
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
$label="";
if ($existCount > 0) { 
	while($row = mysqli_fetch_array($sql)){ 
			 $thisid = $row["id"];
			 $userPhone = $row["phone"];
			 $name = $row["name"];
			}
	}
else{
	echo "
	<br/><br/><br/><h3>Your account has been temporally deactivated</h3>
	<p>Please contact: <br/><em>(+25) 078 484-8236</em><br/><b>muhirwaclement@gmail.com</b></p>		
	Or<p><a href='logout'>Click Here to login again</a></p>
";
exit();
}?>
<?php
if (isset($_GET['groupId'])){	
		$groupID = $_GET['groupId'];
		//include "db.php"; 
		$sql2 = $db->query("SELECT * FROM accounts WHERE id='$groupID'"); 
		while($row = mysqli_fetch_array($sql2)){ 
			$groupName = $row["accName"];
			$saving = round($row['saving']);
			$adminPhone = $row['adminPhone'];
			$adminName = $row['adminName'];
			$groupDescription = $row["groupDesc"];
			$bankaccount = $row["bankaccount"];
			$custommessage = $row["custommessage"];
			$replymessage = $row["replymessage"];
			$contributionDate = $row["opening"];			
		}
		$sqladminID = $db->query("SELECT id adminID FROM users WHERE phone = '$adminPhone'");
		$fetchAdminID = $rowAdminID = mysqli_fetch_array($sqladminID);
		$adminID = $rowAdminID["adminID"];
		
		$outCon = mysqli_connect("localhost","root","","rtgs");
		$sqlbalance = $outCon->query("SELECT * FROM balance WHERE accountNumber = '$bankaccount'");
		$rowbalance = mysqli_fetch_array($sqlbalance);
		$balance = $rowbalance['Balance'];
		
		$prog = $balance*100/$saving;
		$progressing=''.$prog.'%';
		if($balance == ''){
			$balance = 0;
		}
	}
else{
	echo 'nothig isset';
}
?>


<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<!-- Mirrored from getbootstrapadmin.com/remark/material/iconbar/pages/blank.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 18 Nov 2016 13:59:26 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap material admin template">
  <meta name="author" content="">

  <title>Test</title>

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

  <!-- Fonts -->
  <link rel="stylesheet" href="assets/global/fonts/material-design/material-design.min3f0d.css?v2.2.0">
  <link rel="stylesheet" href="assets/global/fonts/brand-icons/brand-icons.min3f0d.css?v2.2.0">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,700'>
	
    
    <link href="croppic/assets/css/main.css" rel="stylesheet">
	<link href="croppic/assets/css/croppic.css" rel="stylesheet">

  <!--[if lt IE 9]>
    <script src="assets/global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

  <!--[if lt IE 10]>
    <script src="assets/global/vendor/media-match/media.match.min.js"></script>
    <script src="assets/global/vendor/respond/respond.min.js"></script>
    <![endif]-->

  <!-- Scripts -->
  <script src="assets/global/vendor/modernizr/modernizr.min.js"></script>
  <script src="assets/global/vendor/breakpoints/breakpoints.min.js"></script>
  <script>
    Breakpoints();
  </script>
</head>
<body>
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
                <img src="proimg/<?php echo $thisid;?>.jpg" alt="...">
                <i></i>
              </span>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li role="presentation">
                <a href="profile" role="menuitem"><i class="icon md-account" aria-hidden="true"></i> Profile</a>
              </li>
              <li role="presentation">
                <a href="privacy" role="menuitem"><i class="icon md-settings" aria-hidden="true"></i> Settings</a>
              </li>
              <li class="divider" role="presentation"></li>
              <li role="presentation" >
                <a href="logout" role="menuitem"><i class="icon md-power" aria-hidden="true"></i> Logout</a>
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
            <span class="site-menu-title">Dash</span>
            <div class="site-menu-badge">
              <span class="badge badge-success">
          0
        </span>
            </div>
          </a>
        </li> 
      <li class="site-menu-item">
          <a href="ikimina">
           <i class="site-menu-icon md-accounts-alt" aria-hidden="true"></i>
            <span class="site-menu-title">Ikimina</span>
            <div class="site-menu-badge">
              <span class="badge badge-success">
          0
        </span>
            </div>
          </a>
        </li> 
        
		<li class="site-menu-item has-sub">
          <a href="javascript:void(0)" >
            <i class="site-menu-icon md-leak" aria-hidden="true"></i>
            <span class="site-menu-title">Kusanya</span>
            <div class="site-menu-badge">
              <span class="badge badge-success">
          0
        </span>
            </div>
          </a>
			<ul class="site-menu-sub">
				<li class="site-menu-item">
				  <a class="animsition-link waves-effect waves-classic" href="onceof">
					<div class="site-menu-label">
						<i class="site-menu-icon md-n-1-square" ></i>
					</div>
					<span class="site-menu-title">Once Off</span>
				  </a>
				</li>
				<li class="site-menu-item">
				  <a class="animsition-link waves-effect waves-classic"  href="recurring.php">
					
					<div class="site-menu-label">
						<i class="site-menu-icon md-rotate-right" ></i>
					</div>
					<span class="site-menu-title">Recurring</span>
					
				  </a>
				</li>
			</ul>
	   </li>  
        <li class="site-menu-item">
          <a href="shora">
           <i class="site-menu-icon md-balance" aria-hidden="true"></i>
            <span class="site-menu-title">Shora</span>
            <div class="site-menu-badge">
              <span class="badge badge-success">
         0
        </span>
            </div>
          </a>
        </li> 
    </ul>
    </div>
  </div>
 

  <!-- Page -->
  <div class="page animsition">
    <div class="page-content">
		<div class="row">
			<div class="col-lg-6">	
				<h4><?php echo number_format($balance);?>/
					<small><?php echo number_format($saving);?> Rwf  
					
					</small>
                    <span class="pull-right" id="countDown"></span>
				</h4>
				<div class="progress progress-md">
				  <div class="progress-bar progress-bar-success progress-bar-indicating active" style="width: <?php echo $progressing;?>;" role="progressbar">
					<span class="sr-only"><?php echo $progressing;?> Complete</span>
				  </div>
				</div>
			  <div class="example-wrap">
				<div class="nav-tabs-horizontal nav-tabs-inverse nav-tabs-animate">
				  <ul class="nav nav-tabs" data-plugin="nav-tabs" role="tablist">
					<li class="active" role="presentation">
					  <a data-toggle="tab" href="#exampleTabsInverseOne" aria-controls="exampleTabsInverseOne" role="tab" aria-expanded="true">
					  <span class="badge badge-default">
					  <?php 
						include "db.php"; 
						$sqlTotalInv = $db->query("SELECT * FROM joined_ua WHERE groupId='$groupID'")or 
mysqli_error();
						$noTotalInv = mysqli_num_rows($sqlTotalInv);
						echo $noTotalInv;
						?>
						</span> Invited
					</a>
					</li>
					<li role="presentation" class="">
					  <a data-toggle="tab" href="#exampleTabsInverseTwo" aria-controls="exampleTabsInverseTwo" role="tab" aria-expanded="false">
					  <span class="badge badge-danger"><?php 
						include "db.php"; 
						$sqlTotalJoin = $db->query("SELECT * FROM joined_ua WHERE groupId='$groupID' and acceptance='yes'")or mysqli_error();
						$noTotalJoin = mysqli_num_rows($sqlTotalJoin);
						echo $noTotalJoin;
						?></span> Joined
					</a>
					</li>
					<li>
                    <a  href="#" >
                      <i class="icon md-plus-circle-o-duplicate" aria-hidden="true"></i> Group
                    </a>
                  </li>
				  </ul>
				  <div class="tab-content padding-20">
					<div class="tab-pane animation-slide-left active" id="exampleTabsInverseOne" role="tabpanel">
						<form>
						  <div class="input-search input-search-dark">
							<i class="input-search-icon md-search" aria-hidden="true"></i>
							<input type="text" class="form-control" name="" placeholder="Search...">
						  </div>
						</form>
						<br>
					  <ul class="list-group list-group-dividered list-group-full">
					  <?php 
						include "db.php"; 
						$sqlinvited = $db->query("SELECT * FROM joined_ua WHERE groupId='$groupID' AND acceptance ='no'")or mysqli_error();
						$no_invited = mysqli_num_rows($sqlinvited);
						$ninvited = 0;
						
						while($row1 = mysqli_fetch_array($sqlinvited)){ 
							$status = rand(1,2);
						if($status == 1){	
								$printStatus ='online';
							}elseif($status == 2){	
								$printStatus ='away';
							}
						
							$ninvited++;
							echo'<li class="list-group-item">
									<div class="media">
									  <div class="media-left">
										'.$ninvited.' 
									  </div>
									  <div class="media-body">
										<h4 class="media-heading">'.$row1['userPhone'].'</h4>
									  </div>
									  <div class="media-right">
										<span class="status status-lg status-'.$printStatus.'"></span>
									  </div>
									</div>
								</li>';
								}
					  ?>
					</ul>
					
					</div>
					<div class="tab-pane animation-slide-right" id="exampleTabsInverseTwo" role="tabpanel">
						<form>
						  <div class="input-search input-search-dark">
							<i class="input-search-icon md-search" aria-hidden="true"></i>
							<input type="text" class="form-control" name="" placeholder="Search...">
						  </div>
						</form>
						<br>
						<ul class="list-group list-group-dividered list-group-full">
					 
						<?php 
						include "db.php"; 
						$sqljioned = $db->query("SELECT * FROM joined_ua WHERE groupId='$groupID' AND acceptance ='yes'")or mysqli_error();
						$no_joined = mysqli_num_rows($sqljioned);
						if($no_joined > 0){
								while($row2 = mysqli_fetch_array($sqljioned)){ 
									echo'<li class="list-group-item">
								<div class="media">
								  <div class="media-left">
									<a class="avatar" href="javascript:void(0)">
									  <img class="img-responsive" src="proimg/'.$row2['userId'].'.jpg" alt="...">
									</a>
								  </div>
								  <div class="media-body">
									<h4 class="media-heading">'.$row2['userName'].'</h4>
									<small>'.$row2['userPhone'].'</small>
								  </div>
								  <div class="media-right">
									<a href="javascript:void()"><i class="icon md-comment"></i></a>
								  </div>
								</div>
							  </li>
							 ';
							}
						}else{
							echo'no one has contributed yet';
						}
					  ?>
					</ul>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		
			<div class="col-md-6 col-xs-12 masonry-item">
			  <!-- Widget User list -->
			  <div class="widget widget-article widget-shadow"" id="widgetUserList">
				<div class="widget-header cover -hover overlay">
					<div  id="cropContainerModal"><img class="cover-image overlay-spin" src="temp/group<?php echo $groupID;?>.jpeg"/></div>
				</div>
				<div class="widget-body widget-content">
				  
				    <div class="widget-content">
						<div class="tab-content">
							<div class="tab-pane active" id="exampleTabsLineLeftOne" role="tabpanel">
							   
							  <h3 class="widget-title"><?php echo $groupName;?></h3>
								<p class="widget-metas"><?php echo $groupBank;?></p>
								<p>Group Info:
									<textarea class="form-control" placeholder="Briefly Describe Yourself"><?php echo $groupDescription;?></textarea>
								</p>
										
								<div class="widget-body-footer">
								  <a class="btn btn-default" href="javascript:void(0)">UPDATE</a>
								</div>
							</div>
							<div class="tab-pane " id="exampleTabsLineLeftTwo" role="tabpanel">
						<li class="list-group-item" data-toggle="context" data-target="#contextMenu">try</li>	  
			
							  </br>
							  </br>
							  </br>
							  </br>
							  </br>
							  </br>
									  
								<div class="widget-body-footer">
								  <a class="btn btn-default" href="javascript:void(0)">UPDATE</a>
								</div>
							</div>
							<div class="tab-pane" id="exampleTabsLineLeftThree" role="tabpanel">
							  <div class="row" >
								<div class="col-lg-6">
									<div class="form-group">
										<label class="control-label" for="custommessage">Custom Invitation SMS:   <i class="icon md-phone"></i></label>
										<textarea class="maxlength-textarea form-control" data-plugin="maxlength" 
										data-placement="bottom-right-inside" maxlength="160" rows="5" id="custommessage"
										required ><?php echo $custommessage;?></textarea>
									
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label class="control-label" for="custommessage">Custom thanks SMS:   <i class="icon md-phone"></i></label>
										<textarea class="maxlength-textarea form-control" data-plugin="maxlength" 
										data-placement="bottom-right-inside" maxlength="160" rows="5" id="replymessage" required"><?php echo $replymessage;?></textarea>
									</div>
								</div>
							</div>
											
								<div class="widget-body-footer">
								  <a class="btn btn-default" href="javascript:void(0)">UPDATE</a>
								</div>
							</div>
						</div>
					</div>
					<a class="btn-raised btn btn-dark btn-floating" 
						href="whatsapp://send?text=<?php echo $name;?> is inviting
						you to contribute for <?php echo$groupName;?> rasing
						<?php echo $saving;?>Rwf, now having <?php echo $balance;?>Rwf,
						you can conribute from 100Rwf with MTN MM, Visa and Master card .
						for more info click http//uplus.16mb.com/editCont<?php echo$groupID;?>">
						<i class="icon md-share" aria-hidden="true"></i>
					</a>		
				</div>
			  </div>
			  <!-- End Widget User list -->
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
  <script src=" https://code.jquery.com/jquery-2.1.3.min.js"></script>
   
	
	
	<script src="croppic/assets/js/bootstrap.min.js"></script>
	<script src="croppic/assets/js/jquery.mousewheel.min.js"></script>
   	<script src="croppic.min.js"></script>
    <script src="croppic/assets/js/main.js"></script>
    <script>
		
		
		var croppicContainerModalOptions = {
				uploadUrl:'img_save_to_file.php?groupId=<?php echo $groupID;?>',
				cropUrl:'img_crop_to_file.php?groupId=<?php echo $groupID;?>',
				modal:true,
				imgEyecandyOpacity:0.4,
				loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
				onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
				onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
				onImgDrag: function(){ console.log('onImgDrag') },
				onImgZoom: function(){ console.log('onImgZoom') },
				onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
				onAfterImgCrop:function(){ console.log('onAfterImgCrop') },
				onReset:function(){ console.log('onReset') },
				onError:function(errormessage){ console.log('onError:'+errormessage) }
		}
		var cropContainerModal = new Croppic('cropContainerModal', croppicContainerModalOptions);
		
	</script>
	
	
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

  <script src="assets/global/js/components/asscrollable.min.js"></script>
  <script src="assets/global/js/components/animsition.min.js"></script>
  <script src="assets/global/js/components/slidepanel.min.js"></script>
  <script src="assets/global/js/components/switchery.min.js"></script>
  <script src="assets/global/js/components/tabs.min.js"></script>


  <script>
    (function(document, window, $) {
      'use strict';

      var Site = window.Site;
      $(document).ready(function() {
        Site.run();
      });
    })(document, window, jQuery);
  </script>


  
  </script>
</body>


<!-- Mirrored from getbootstrapadmin.com/remark/material/iconbar/pages/blank.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 18 Nov 2016 13:59:26 GMT -->
</html>