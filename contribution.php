<?php
if (isset($_GET['groupId'])){	
		$groupID = $_GET['groupId'];
		include "db.php"; 
		$sql2 = $db->query("SELECT * FROM accounts WHERE id='$groupID'"); 
		while($row = mysqli_fetch_array($sql2)){ 
			$groupName = $row["accName"];
			$saving = number_format($row['saving']);
			$adminPhone = $row['adminPhone'];
			$adminName = $row['adminName'];
			$currentAmount = number_format($row['currentAmount']);
			$groupDescription = $row["groupDesc"];
			$groupBank = $row["bankaccount"];
			$custommessage = $row["custommessage"];
			$replymessage = $row["replymessage"];
			$contributionDate = $row["opening"];
			$prog = $currentAmount*100/$saving;
			$progressing=''.$prog.'%';
			
		}
		$sqladminID = $db->query("SELECT id adminID FROM users WHERE phone = '$adminPhone'");
		$fetchAdminID = $rowAdminID = mysqli_fetch_array($sqladminID);
		$adminID = $rowAdminID["adminID"];
		
		if($currentAmount == ''){
			$currentAmount = 0;
		}
	}
else{
	echo 'nothig isset';
}
?>


<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta property="fb:app_id"             content="1822800737957483">
	<meta property="og:url"                content="http://uplus.rw/index.php?<?php echo $groupID?>" >
	<meta property="og:type"               content="article" >
	<meta property="og:title"              content="<?php echo $groupName?>">
	<meta property="og:description"        content="<?php echo $groupDescription?>">
	<meta property="og:image"              content="../proimg/groupimg/<?php echo $groupID?>.jpg" >
	
  <meta name="description" content="Ikimina">
  <meta name="author" content="Clement">

  <title>uPlus/ <?php echo $groupName;?></title>

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

  <!-- Plugins For This Page -->
  <link rel="stylesheet" href="assets/global/vendor/cropper/cropper.min3f0d.css?v2.2.0">

  <!-- Page -->
  <link rel="stylesheet" href="assets/examples/css/forms/image-cropping.min3f0d.css?v2.2.0">
  <link rel="stylesheet" href="assets/examples/css/dashboard/v1.min3f0d.css?v2.2.0">

  
  <!-- Fonts -->
  <link rel="stylesheet" href="assets/global/fonts/material-design/material-design.min3f0d.css?v2.2.0">
  <link rel="stylesheet" href="assets/global/fonts/brand-icons/brand-icons.min3f0d.css?v2.2.0">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,700'>


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
<body class="site-menubar-keep site-menubar-hide">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

  <nav class="site-navbar navbar navbar-inverse navbar-fixed-top navbar-mega" role="navigation">
    <div class="navbar-header">
      <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
        <img class="navbar-brand-logo" src="assets/images/logo.png" title="Uplus">
        <span class="navbar-brand-text hidden-xs"> Uplus</span>
      </div>
    </div>

  </nav>
 
  <!-- Page -->
  <div class="page animsition">
  <div class="page-header text-center">
      <h1 class="page-title"><?php echo $groupName;?></h1>
      
    </div>
    <div class="page-content">
		<div class="row">
			<div class="col-lg-4">	
				<h4><?php echo $currentAmount;?>/
					<small><?php echo $saving;?> Rwf  
					
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
					<li role="presentation" class="active">
						<a data-toggle="tab" href="#msgChat" aria-controls="msgChat" role="tab" aria-expanded="false">
							Chat
						</a>
					</li>
					<li role="presentation">
						<a data-toggle="tab" href="#exampleTabsInverseTwo" aria-controls="exampleTabsInverseTwo" role="tab" aria-expanded="false">
						  <span class="badge badge-danger"><?php 
							include "db.php"; 
							$sqlTotalJoin = $db->query("SELECT * FROM joined_ua WHERE accountID='$groupID' and acceptance='yes'")or mysqli_error();
							$noTotalJoin = mysqli_num_rows($sqlTotalJoin);
							echo $noTotalJoin;
							?></span> Joined
						</a>
					</li>
					<li role="presentation">
					   <a data-toggle="tab" href="#exampleTabsInverseOne" aria-controls="exampleTabsInverseOne" role="tab" aria-expanded="true">
						<span class="badge badge-default">
						  <?php 
							include "db.php"; 
							$sqlTotalInv = $db->query("SELECT * FROM joined_ua WHERE accountID='$groupID'")or mysqli_error();
							$noTotalInv = mysqli_num_rows($sqlTotalInv);
							echo $noTotalInv;
							?>
						</span> Invited
					   </a>
					</li>
				  </ul>
				  <div class="tab-content padding-20">
					<div class="tab-pane animation-slide-left active" id="msgChat" role="tabpanel">
						<div class="chats-wrap">
							<div class="chats">
							  <div class="chat">
								<div class="chat-body">
								  <div class="text-left">
									  <a class="avatar margin-left-0" data-toggle="tooltip" href="#" data-placement="left"
									  title="June Lane">
										<img src="proimg/3.jpg" alt="...">
									  </a>
									</div>
								  <div class="chat-content" data-toggle="tooltip" title="8:30 am">
									<p>
									  Hello. Wellcome to the group chat box.
									  share your thoughts with the group member here.
									</p>
									
								  </div>
								</div>
							  </div>
							 <!-- <div class="chat chat-right">
								<div class="chat-body">
									<div class="text-right">
									  <a class="avatar margin-left-15" data-toggle="tooltip" href="#" data-placement="left"
									  title="June Lane">
										<img src="proimg/4.jpg" alt="...">
									  </a>
									</div>
								  <div class="chat-content" data-toggle="tooltip" title="8:35 am">
									<p>
									  I'm just looking around.
									</p>
									<p>Will you tell me something about yourself? </p>
								  </div>
								</div>
							  </div>
							--></div>
						</div>
						<!-- Message Input-->
						<hr/>
						<form class="app-message-input">
							<div class="input-group form-material">
							  <span class="input-group-btn">
								<a href="javascript: void(0)" class="btn btn-pure btn-default icon md-camera"></a>
							  </span>
							  <input class="form-control" type="text" placeholder="Type message here ...">
							  <span class="input-group-btn">
								<button type="button" class="btn btn-pure btn-default icon md-mail-send"></button>
							  </span>
							</div>
						</form>
						<!-- End Message Input-->
					</div>
					<div class="tab-pane animation-slide-left" id="exampleTabsInverseTwo" role="tabpanel">
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
							$sqljioned = $db->query("SELECT * FROM joined_ua WHERE accountID='$groupID' AND acceptance ='yes'")or mysqli_error();
							$no_joined = mysqli_num_rows($sqljioned);
							if($no_joined > 0){
									while($row2 = mysqli_fetch_array($sqljioned)){ 
										echo'<li class="list-group-item">
									<div class="media">
									  <div class="media-left">
										<a class="avatar" href="javascript:void(0)">
										  <img class="img-responsive" src="proimg/'.$row2['id'].'.jpg" alt="...">
										</a>
									  </div>
									  <div class="media-body">
										<h4 class="media-heading">'.$row2['name'].'</h4>
										<small>'.$row2['phone'].'</small>
									  </div>
									  <div class="media-right">
										
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
					<div class="tab-pane animation-slide-right" id="exampleTabsInverseOne" role="tabpanel">
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
						$sqlinvited = $db->query("SELECT * FROM joined_ua WHERE accountID='$groupID' AND acceptance ='no'")or mysqli_error();
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
										<h4 class="media-heading">'.$row1['phone'].'</h4>
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
				  </div>
				</div>
			  </div>
			</div>
		
			<div class="col-md-8 col-xs-12 masonry-item">
			  <!-- Widget User list -->
			  <div class="widget widget-article widget-shadow" id="widgetUserList">
				<div class="widget-header cover overlay text-center">
					<div class="cover-background" style="background-image: url(proimg/groupimg/<?php echo $groupID;?>.jpg)">
					<div class="vertical-align padding-horizontal-0">
					  <div class="vertical-align-bottom width-full">
						<a class="avatar avatar-100 img-bordered bg-white margin-top-20" href="javascript:void(0)">
						  <img src="proimg/<?php echo $adminID;?>.jpg" alt="">
						</a>
						<h3 class="white"><?php echo $adminName;?></h3>
						<p class="white">Organizer</p>
						<button type="button" class="btn btn-primary margin-bottom-20">CONTRIBUTE NOW</button>
					  <!--  <div class="row no-space overlay-background padding-vertical-10">
						  <div class="col-xs-4">
							<div class="counter counter-inverse">
							  <span class="counter-number">13.2K</span>
							  <div class="counter-label">Followers</div>
							</div>
						  </div>
						  <div class="col-xs-4">
							<div class="counter counter-inverse">
							  <span class="counter-number">246</span>
							  <div class="counter-label">Following</div>
							</div>
						  </div>
						  <div class="col-xs-4">
							<div class="counter counter-inverse">
							  <span class="counter-number">32</span>
							  <div class="counter-label">Tweets</div>
							</div>
						  </div>
						</div>
					  -->
					  </div>
					</div>
				  </div>
				</div>  
			  
				<div class="widget-body widget-content">
					<h3 class="widget-title text-center"><?php echo $groupName;?></h3>
				    <div class="widget-actions widget-actions-sidebar">
						</br></br>
						<a data-toggle="tab" 
									href="#exampleTabsLineLeftOne" 
									aria-controls="exampleTabsLineLeftOne" 
									role="tab" 
									aria-expanded="true">
						  <i class="icon md-globe"></i>
						</a>
						<a data-toggle="tab" 
									href="#exampleTabsLineLeftTwo" 
									aria-controls="exampleTabsLineLeftTwo" 
									role="tab" 
									aria-expanded="false">
						  <i class="icon md-map"></i>
						</a>
					</div>
					<div class="widget-content">
						<div class="tab-content">
							<div class="tab-pane active" id="exampleTabsLineLeftOne" role="tabpanel">
							   </br>
							  <p><?php echo $groupDescription;?></p>
								<p class="widget-metas"><?php echo $groupBank;?></p>
								
							  </br>
							  </br>	
							</div>
							<div class="tab-pane " id="exampleTabsLineLeftTwo" role="tabpanel">
						
							  </br>
							  </br>
							  </br>
							  </br>
							  </br>
							  </br>
									
							</div>
						</div>
					</div>
					<a class="btn-raised btn btn-dark btn-floating" 
						href="whatsapp://send?text=You are invited to contribute for <?php echo$groupName;?> rasing <?php echo $saving;?>Rwf, now having <?php echo $currentAmount;?>Rwf, you can conribute from 100Rwf with MTN MM, Visa or Master card. For more info click: www.uplus.16mb.com/cont<?php echo$groupID;?>">
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
  <footer class="site-footer" style="text-align: center;">
    <div class="site-footer-legal">© 2015 <a href="http://uplus.rw">uPlus</a></div>
	<a href="javascript:void()"><i class="icon md-android"></i></a>&nbsp;&nbsp;/&nbsp;&nbsp; 
	<a href="javascript:void()"><i class="icon md-apple"></i></a>&nbsp;&nbsp;/&nbsp;&nbsp;
	<a href="javascript:void()"><i class="icon md-windows"></i></a>
    <div class="site-footer-right">
      Invest for a better future with <i class="red-600 wb wb-globe"></i> uPlus
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

  <!-- Plugins For This Page -->
  <script src="assets/global/vendor/cropper/cropper.min.js"></script>

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


  <script src="assets/examples/js/forms/image-cropping.min.js"></script>
<?php 
	$nowthis = date_create($contributionDate);
	$year = date_format($nowthis, "Y");
	$month = date_format($nowthis, "n");
	$day = date_format($nowthis, "j");
?>
  <script>
  $(document).ready(function(){
	  var year1 = " <?php echo $year ?> ";
	  var month2 = " <?php echo $month ?> ";
	  var day3 = " <?php echo $day ?> ";
		$('#countDown').revolver({
			year : year1,	
			month : month2,	
			day : day3,	
		});
	});
	</script>
	<script type="text/javascript" src="assets/js/timer.js"></script>
	
</body>


</html>