<?php
//error_reporting(E_ALL); 
//ini_set('display_errors', 1);
if (isset($_GET['groupId'])){	
		$groupID = $_GET['groupId'];
		require_once "parsedown/Parsedown.php";
		$parsedown = new parsedown();
		include "../db.php"; 
		$sql2 = $db->query("SELECT * FROM accounts WHERE id='$groupID'"); 
		while($row = mysqli_fetch_array($sql2)){ 
			$groupName = $row["accName"];
			$saving = round($row['saving']);
			$adminPhone = $row['adminPhone'];
			$adminName = $row['adminName'];
			$currentAmount = round($row['currentAmount']);
			$groupDesc = $row["groupDesc"];
			$groupStory = $parsedown->text($row["groupStory"]);
			$groupBank = $row["bankaccount"];
			$custommessage = $row["custommessage"];
			$replymessage = $row["replymessage"];
			$contributionDate = $row["opening"];
			$createdDate = $row["createdDate"];
			
			$sqlbalance = $outCon->query("SELECT * FROM groupbalance WHERE groupId = '$groupID'");
			$balanceCount = mysqli_num_rows($sqlbalance);

			$rowbalance = mysqli_fetch_array($sqlbalance);
			$currentAmount = $rowbalance['Balance'];
			if($balanceCount == 0){
				$currentAmount = 0;
			}
			$prog = $currentAmount*100/$saving;
			$progressing =$prog + (20*$prog/100);
			
		}
		$sqladminID = $db->query("SELECT id adminID, gender adminGender FROM users WHERE phone = '$adminPhone'");
		$fetchAdminID = $rowAdminID = mysqli_fetch_array($sqladminID);
		$adminID = $rowAdminID["adminID"];
		$adminGender = $rowAdminID["adminGender"];
		
		if($currentAmount == ''){
			$currentAmount = 0;
		}
	}
else{
	echo 'nothig isset';
}
?>

		<!doctype html>

		<html lang="en">
		  <head>
		    <meta charset="utf-8">
		    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		    
			<meta property="fb:app_id"             content="1822800737957483">
			<meta property="og:url"                content="http://uplus.rw/f/i<?php echo $groupID?>" >
			<meta property="og:type"               content="article" >
			<meta property="og:title"              content="<?php echo $groupName?> (<?php echo number_format($saving);?> Rwf)">
			<meta property="og:description"        content="<?php echo $groupDesc?>">
			<meta property="og:image"              content="http://uplus.rw/temp/group<?php echo $groupID;?>.jpeg" >
			
			<meta name="description" content="<?php echo $groupDesc?>">
		    
			
			
			<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
		    <title>uplus</title>

		    <!-- Add to homescreen for Chrome on Android -->
		    <meta name="mobile-web-app-capable" content="yes">
		    <link rel="icon" sizes="192x192" href="images/android-desktop.png">

		    <!-- Add to homescreen for Safari on iOS -->
		    <meta name="apple-mobile-web-app-capable" content="yes">
		    <meta name="apple-mobile-web-app-status-bar-style" content="black">
		    <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">

		    <!-- Tile icon for Win8 (144x144 + tile color) -->
		    
		    <link rel="shortcut icon" href="images/favicon.png">
			<link rel="canonical" href="http://uplus.rw/f/i<?php echo $groupID?>">
		    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
		    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		    <!--<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.green-indigo.min.css" />
		    -->
			<link rel="stylesheet" href="css/style.css" /><!-- <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.green-indigo.min.css" />
			 --><!-- 
			<link rel="stylesheet" href="css/material.deep_purple-pink.min.css"> -->
			
			<style>
		    #view-source {
		      position: fixed;
		      display: block;
		      right: 0;
		      bottom: 0;
		      margin-right: 40px;
		      margin-bottom: 40px;
		      z-index: 900;
		    }
		    </style>
			<link rel="stylesheet" href="../frontassets/css/bootstrap.css">
  
 <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

	<link rel="stylesheet" href="css/popup-polyfill.min.css">
	<link rel="stylesheet" href="styles.css">
	
	
	
	<!-- Add jQuery library -->
	<script type="text/javascript" src="fancy/jquery-1.10.2.min.js"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="fancy/jquery.fancybox.pack.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="fancy/jquery.fancybox.css?v=2.1.5" media="screen" />
	
	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="fancy/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="fancy/jquery.fancybox-thumbs.js?v=1.0.7"></script>

	
	<script type="text/javascript">
		$(document).ready(function() {
			
			$('.fancybox-thumbs').fancybox({
				prevEffect : 'none',
				nextEffect : 'none',

				padding: 0,
				
				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,
				
				arrows    : false,
				nextClick : true,

				helpers : {
					thumbs : {
						width  : 50,
						height : 50
					}
				}
				
				



			});

			

		});
	</script>
	<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}
	</style>

	
</head>
<body class="mdl-demo mdl-color--grey-100 mdl-color-text--grey-700 mdl-base">
		    <script>
			  window.fbAsyncInit = function() {
			    FB.init({
			      appId      : '1822800737957483',
			      xfbml      : true,
			      version    : 'v2.8'
			    });
			    FB.AppEvents.logPageView();
			  };

			  (function(d, s, id){
			     var js, fjs = d.getElementsByTagName(s)[0];
			     if (d.getElementById(id)) {return;}
			     js = d.createElement(s); js.id = id;
			     js.src = "//connect.facebook.net/en_US/sdk.js";
			     fjs.parentNode.insertBefore(js, fjs);
			   }(document, 'script', 'facebook-jssdk'));
			</script>

	
		    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
		    <header  class="mdl-layout__header mdl-layout__header--scroll" style="background: #fff; position: fixed;box-shadow: 0 2px 6px rgba(0, 0, 0, 0.25);  transition: all 280ms cubic-bezier(0.4, 0, 0.2, 1);">
				<nav class="uk-navbar">
					<div style="
    margin-left: auto;
    margin-right: auto;
    max-width: 1200px;
    padding: 0 35px;
    color: #444;
">
						<a href="../index.php" >
							<img src="../frontassets/img/logo_main.png" alt="" width="71" style="height: 100%;" class="dense-image dense-loading">
						</a>
						<a href="../home" style="color: #fff;
    float: right;
    background: #2196F3;
    margin-top: 14px;
    border: none;
    border-radius: 2px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    min-height: 31px;
    min-width: 70px;
    padding: 2px 16px;
    text-align: center;
    text-shadow: none;
    text-transform: uppercase;
    box-sizing: border-box;
    cursor: pointer;
    -webkit-appearance: none;
    display: inline-block;
    vertical-align: middle;
    font: 500 14px/31px 'Roboto', sans-serif !important;">SIGN IN</a>
					</div>
				</nav>
			</header>
			<main class="mdl-layout__content" >
		        <div class="mdl-layout__tab-panel is-active" id="overview" style="padding: unset; padding-top: unset;">
					<div class="profile" style="background-image: url(../proimg/<?php echo $adminID;?>.jpg);"></div>
	<div class="profileInfo">
	<table border="0">
		<tr>
			<td>
				<b><?php echo  $adminName;?></b>
			</td>
		</tr>
		<tr>
			<td>
				<b style="
    color: #000;
    opacity: 0.5;
"><i class="fa fa-facebook-square"></i> Facebook Verified</b>
			</td>
		</tr>
		<tr>	
			<td onclick="alert('We are still working on this module.')" style="cursor: pointer;">
			 <i  class="fa fa-envelope"></i>
				Contact <?php if($adminGender == 'male'){echo 'him';}else{echo 'her';}?>
			</td>
		</tr>
	</table>
		
		<div style="display: block; margin-top: 20px;">
			<div style="color: #657786;font-size: 14px;line-height: 1;margin-bottom: 10px;">
				<span style="text-align: left;"><i class="fa fa-camera"></i></span>
				<span style="text-align: left;"><a href="javascript:void()" style="    font-size: 13px;
    font-weight: 400;">1 Pictures and Videos</a></span>
	</div>
			<div style="margin: -5px 0 0 -5px; max-height: 176px;overflow: hidden;">
				<p>
					<a class="fancybox-thumbs" data-fancybox-group="thumb" href="../temp/group<?php echo $groupID;?>.jpeg"><span style="background-image: url(../temp/group<?php echo $groupID;?>.jpeg);" class="gallery"></span></a>
	
	</p>
			</div>
		</div>
	</div>

					<div class="contributors">
	<h5 style="text-align: center; font-size: 17px;"><i class="fa fa-group"></i> <?php 
							$sqlcountcontr = $outCon->query("SELECT `amount` FROM `transactionsview` WHERE `operation` = 'debit' and`forGroupId` = '$groupID'");
							echo $countContr = mysqli_num_rows($sqlcountcontr);
							?> Contributors</h5><hr style="margin-top: 18px;margin-bottom: 20px;border: 0; border-top: 1px solid #616161;">
	<div>
								<?php 
							$sqlcontributors = $outCon->query("SELECT `amount`, clientName FROM `transactionsview` WHERE `operation` = 'debit' and`forGroupId` = '$groupID' ORDER BY amount DESC limit 5");
							$ncontrib = 0;
							while($row = mysqli_fetch_array($sqlcontributors))
							{
								$ncontrib++;
								echo '<div style="padding-bottom: 15px;">
			<i class="fa fa-user-circle" style="
    color: #007569;
    float: left;
    font-size: 32px;
"></i>
			<div style="padding-top: 5px;padding-left: 40px;">'.$ncontrib.' <a style="
    font-weight: 400;
">'.$row['clientName'].'</a>: '.number_format($row['amount']).' Rwf</div>
		</div>';
							}
							if($countContr > 5)
							{
								$leftmore = $countContr - 5;
								echo'
								<div style="text-align: center"><a style="
    font-weight: 400;
" href="#">Show me other '.$leftmore.' more</a></div>';
							}
						?>
	</div>
</div>
				 
				<section class="section--center mdl-grid mdl-grid--no-spacing" style="margin-bottom: 95px; max-width: 730px; padding-top: 50px;">
					<div style="    background: linear-gradient(to bottom,transparent 0,rgba(0,0,0,.82) 100%);
    text-shadow: 2px 2px 14px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    margin: 220px 0 0 0;
    padding: 0 15px;
	position: absolute;    width: 100%;
    height: 37%;">
					<h3 style="color: #f5f5f5;
"><?php echo $groupName;?></h3>
					<h6 style="font-size: 18px; color: #e1eae9;
"><?php echo $groupDesc;?><br><br></h6>

					</div>
					<div style="background-size: cover;background-repeat: no-repeat;background-position: center center; height: 380px; width: 100%;background-image: url(../temp/group<?php echo $groupID;?>.jpeg);"></div>
				</section>
		        <section class="section--center"  style="margin: -140px 0 0 0;max-width: 100%;
    padding-bottom: 15px;">
				<div  style="max-width: 680px;" class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp" style="width: 700px;margin: -140px 0px 0 282px;position: absolute; z-index: 100;">
					<div class="mdl-cell mdl-cell--8-col" style="background: #fff; padding: 7px 25px 7px 25px;">
						To date<i style="float: right;">Target</i>
						<div style="font-size: 20px; font-weight: 800;">
							<?php echo number_format($currentAmount);?>RWF
							<b style="float: right;"><?php echo number_format($saving);?>Rwf</b>
						</div>
						<div class="progress" style="background-color: #e1eae9;">
							<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo $prog;?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $prog;?>%">
							  <?php echo number_format($prog);?>%
							</div>
						</div>
						<span style="float: right" id="countDown"></span>
					</div>
					<div class="mdl-cell mdl-cell--4-col" id="contdiv">
						<button  href="javascript:void()" class="mdl-button mdl-button--raised dialog-button" id="contbtn">Contribute Now</button>
					</div>
					</div>
					
		        </section>
				
				<section id="tabing" class="section--center mdl-grid mdl-grid--no-spacing" style="margin-bottom: 10px; max-width: 730px; height: 40px;">
					<div onclick="openCity(event, '1')" id="defaultOpen" class="mdl-card mdl-cell mdl-cell--3-col activeTab">
						<span class="currentSpan" style="height: 20%"></span>
						Story
					</div>
					<div onclick="openCity(event, '2'), changeTab(tab=2)" class=" mdl-card mdl-cell mdl-cell--3-col otherTab">
						<span class="updatesLogo"><i class="fa fa-globe"></i></span>
						UPdates
					</div>
					<div class="mdl-card mdl-cell mdl-cell--3-col fbShare" id="shareBtn">Share facebook</div>
					<div onclick="javascript:window.open('http://twitter.com/share?url=http://uplus.rw/f/i<?php echo $groupID;?>;text=<?php echo $adminName;?> Is rasing <?php echo number_format($saving);?>Rwf for <?php echo $groupName;?>. You can contribute using MTN mobile money, Tigo cash, Visa cards here:;size=l&amp;count=none', '_blank','toolbar=no, scrollbars=no, menubar=no, resizable=no, width=700,height=220')" class="mdl-card mdl-cell mdl-cell--3-col twtShare">
						share Twitter</div>
					
				</section>
				<div id="1" class="tabcontent">
					<section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp" style="margin-bottom: 30px; max-width: 730px;">
		            	<div class="mdl-card mdl-cell mdl-cell--12-col" id="tabsCont" style="padding: 12px; min-height: 80px;">
							<?php echo $groupStory;?>
							
						</div> 
					</section>
				</div>
				<div id="2" class="tabcontent">
					<?php
						$sqlgetUpdates = $db->query("SELECT * FROM updatestransaction WHERE groupId = '$groupID' ORDER  BY id DESC");
						 $countUpdates = mysqli_num_rows($sqlgetUpdates);
						if($countUpdates > 0){
							while($rowUpdates = mysqli_fetch_array($sqlgetUpdates)){
					?>
					<section class="section--center mdl-grid mdl-grid--no-spacing" style="box-shadow:0 1px 1px 0px rgba(0,0,0,.14), 0px 1px 1px -1px rgba(0,0,0,.2), 0 0px 2px 0px rgba(0,0,0,.12);margin-bottom: 10px; max-width: 730px;">
		            	<div class="mdl-card mdl-cell mdl-cell--12-col" id="tabsCont" style="padding: 12px; min-height: unset;">
							<table>
								<tr>
									<td style=" padding-right: 8px;">
										<img src=""></td>
									<td>
										<p style="font-size: 14px;font-weight: normal;line-height: 1.38;">On (<?php echo '<small>'.$rowUpdates['createdDate'].'</small>) <br/>'; echo $rowUpdates['body'];?>.</p> 
									</td> 
								</tr>
							</table>
						</div> 
					</section>
					<?php }
						}?>
				
          
					<section class="section--center mdl-grid mdl-grid--no-spacing " style="box-shadow:0 1px 1px 0px rgba(0,0,0,.14), 0px 1px 1px -1px rgba(0,0,0,.2), 0 0px 2px 0px rgba(0,0,0,.12);margin-bottom: 10px; max-width: 730px;">
		            	<div class="mdl-card mdl-cell mdl-cell--12-col" id="tabsCont" style="padding: 12px; min-height: unset;">
							<table>
								<tr>
									<td style=" padding-right: 8px;">
												<img src=""></td>
									<td>
										<p style="font-size: 14px;font-weight: normal;line-height: 1.38;">On (<?php echo '<small>'.$createdDate.'</small>) <br/>'; if($adminGender == 'male'){echo '<a href="javascript:void()" style="color: #006157;">Mr. ';}else{echo '<a href="javascript:void()" style="color: #006157;">Mrs. ';} echo ''.$adminName.'</a>';?>.<span style="color:#90949c">Created this contribution group.</span><p> 
									</td> 
								</tr>
							</table>
						</div> 
					</section>
					
					
				</div>
				 <section class="section--center mdl-grid mdl-grid--no-spacing" style="margin-bottom: 30px; max-width: 730px;">
					<div class="fb-comments" data-href="http://uplus.rw/f/index.php?groupId=<?php echo $groupID;?>" data-width="650" data-numposts="5"></div>
				<div class="tab">
</div>




				</section>
		        </div>
		        <footer class="mdl-mega-footer" style="background: #007569 !important;z-index: 50;position: relative;">
		          <div class="mdl-mega-footer--bottom-section">
		            <div class="mdl-logo">
		              Copyright © 2016 uplus mutual partner, All rights reserved.
		            </div>
		          </div>
		        </footer>
		      </main>
		    </div>
			<dialog id="dialog" class="mdl-dialog" style="padding:0px;">
				<div class="mdl-dialog__actions" style="padding:2px;text-align: center; display: block;font-size: 20px;    background: #007569; color: #fff;">
					Money Transfer
				</div>
				<div class="mdl-dialog__content" style="padding:0px; border-bottom: solid #ccc 0.1px;" id="contBody">
					<form id="payform" method="post" action="../3rdparty/rtgs/transfer.php">
						<input name="bkVisa" hidden />
						<div class="form-style-2">
							<label for="field1" style="width: 100%;">
								<span style="font-size: 18px">Amount <span class="required">*</span>
								</span>
								<input placeholder="0.00" style="width: 45%;" class="input-field" name="field1" type="number" id="contributedAmount">
								<span>
									<select style="width: 33%;" class="select-field" name="currency" id="currency">
										<option value="RWF">Rwandan Francs</option>
										<option value="USD">US Dolar</option>
									</select>
								</span>
							</label>
							<h6><div id="amountError" style="color: #f44336;"></div></h6>
							<div class="mdl-grid mdl-grid--no-spacing" >
								<div style="width: 33%"> <a href="javascript:void()" onclick="frontpayement2(method=1)"><div style="border-radius: 3px; background-image: url(images/1.jpg); background-size: 100% 100%; height: 90px; margin: 5px; box-shadow: 0.5px 0.5px 0.25px 0.25px #888888;"></div></a></div>
								<div style="width: 33%"> <a href="javascript:void()" onclick="frontpayement2(method=2)"><div style="border-radius: 3px; background-image: url(images/2.jpg); background-size: 100% 100%; height: 90px; margin: 5px; box-shadow: 0.5px 0.5px 0.25px 0.25px #888888;"></div></a></div>
								<div style="width: 33%"> <a href="javascript:void()" onclick="payVisa()"><div  style="border-radius: 3px; background-image: url(../proimg/banks/4.png); background-size: 100% 100%; height: 90px; margin: 5px; box-shadow: 0.5px 0.5px 0.25px 0.25px #888888;"></div></a></div>
							</div>
						</div>
					</form>
				</div>
				<div class="mdl-dialog__actions" id="actionbc" style="padding:0px; display: block;">
					<button type="button" class="mdl-button btn-danger">Close</button>
				</div>
			</dialog>	 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/popup-polyfill.min.js"></script>

		    <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
			
		  <!-- MDL Progress Bar with Buffering -->
		<script>
		document.getElementById('shareBtn').onclick = function() {
			//alert('done');
		  FB.ui({
		    method: 'share',
			mobile_iframe: true,
		    display: 'popup',
		    href: 'http://uplus.rw/f/index.php?groupId=<?php echo $groupID?>',
		    hashtag: '#kusanya',
		    quote: 'You can contribute with MTN mobile money, Tigo Cash and Visa Card.',
		  }, function(response){});
		}
		</script>
		<script>
function changeTab(tab)
{
	var twitter="('http://twitter.com/share?url=http://uplus.rw/f/i<?php echo $groupID;?>;text=<?php echo $adminName;?> Is rasing <?php echo number_format($saving);?>Rwf for <?php echo $groupName;?>. You can contribute using MTN mobile money, Tigo cash, Visa cards here:;size=l&amp;count=none', '_blank','toolbar=no, scrollbars=no, menubar=no, resizable=no, width=700,height=220')";
	var shares = '<div class="mdl-card mdl-cell mdl-cell--3-col fbShare" id="shareBtn">Share facebook</div>'
	+'<div onclick="javascript:window.open'+twitter+'" class="mdl-card mdl-cell mdl-cell--3-col twtShare">share Twitter</div>';
	if(tab == 1)
	{
		document.getElementById('tabing').innerHTML = 
			'<div class="activeTab mdl-card mdl-cell mdl-cell--3-col">'
				+'<span class="currentSpan" style="height: 20%"></span>Story'
			+'</div>'
			+'<div onclick="openCity(event, 2), changeTab(tab=2)" class="otherTab mdl-card mdl-cell mdl-cell--3-col ">'
				+'<span class="updatesLogo"><i class="fa fa-globe"></i></span>'
				+'UPdates'
			+'</div>'+shares;
	}
	else if(tab == 2)
	{
		document.getElementById('tabing').innerHTML = 
			'<div onclick="openCity(event, 1),  changeTab(tab=1)" class="otherTab mdl-card mdl-cell mdl-cell--3-col">'
				+'Story'
			+'</div>'
			+'<div  class="activeTab  mdl-card mdl-cell mdl-cell--3-col ">'
				+'<span class="updatesLogo"><i class="fa fa-globe"></i></span>'
				+'<span class="currentSpan" style="height: 20%"></span>UPdates'
			+'</div>'+shares;
	}
}	
</script>
<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
<script src="js/popup.js"></script>	
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

<script type="text/javascript" src="../assets/js/timer.js"></script>
<script src="js/js.js"></script>

<!-- SEND METHOD AND GET ME THE PHONE INPUT-->
<!-- SEND METHOD AND GET ME THE PHONE INPUT-->
<script>
function frontpayement2(method)
{
	var forGroupId = <?php echo $groupID;?>;
	var contributedAmount =$("#contributedAmount").val();
	var currency =$("#currency").val();
	/*if (!currency == 'RWF') 
		{
			document.getElementById('amountError').innerHTML = 'For MTN and TIGO we only RWF currency';
			return false;
		}
	*/
	if (contributedAmount == null || contributedAmount == "") 
		{
			document.getElementById('amountError').innerHTML = 'Contributed Amount must be  out';
			return false;
		}
	if (contributedAmount < 500) 
		{
			document.getElementById('amountError').innerHTML = 'The minimum contribution allowed is 500 Rwf';
			return false;
		}
		document.getElementById('contBody').innerHTML = '<div style="margin: 100px;">Loading...</div>';
			
		$.ajax({
			type : "GET",
			url : "payments.php",
			dataType : "html",
			cache : "false",
			data : {
				method : method,
				contributedAmount : contributedAmount,
				forGroupId1 : forGroupId,
			},
			success : function(html, textStatus){
				$("#contBody").html(html);
			},
			error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			}
	});
}
function payVisa()
 {
	var contributedAmount =$("#contributedAmount").val();
	if (contributedAmount == null || contributedAmount == "") 
		{
			document.getElementById('amountError').innerHTML = 'Contributed Amount must be  out';
			return false;
		}
	if (contributedAmount < 500) 
		{
			document.getElementById('amountError').innerHTML = 'The minimum contribution allowed is 500 Rwf';
			return false;
		}
	document.getElementById('payform').submit();
	document.getElementById('contBody').innerHTML ='<div class="loader"></div>';
 }
</script>
<!-- GET ME THE DONE BTN -->
<script>
function handleChange(input)
{
	var method = document.getElementById('opperator').value;
	if (method == '1') 
	{
		var opperator = 'MTN';
		var errorcolor = '#e91e63;';
	}
	else if (method == '2') 
	{
		var opperator = 'TIGO';
		var errorcolor = '#fff;';
	}
	else if (method == '3') 
	{
		var opperator = 'AIRTEL';
		var errorcolor = '#fff;';
	}
    if ( input.value < 1000000) 
	{
		document.getElementById('alowMtn').innerHTML = '<div style="color: '+errorcolor+'"> Keep typing till you get a Done button</div>';
		document.getElementById('doneMtn').innerHTML = '';
	}
    else if (input.value > 9999999) 
	{
		document.getElementById('alowMtn').innerHTML = '<div style="color: '+errorcolor+'">Please enter a valid '+opperator+' Rwanda number</div>';
		document.getElementById('doneMtn').innerHTML = '';
	}
	else
	{
		document.getElementById('alowMtn').innerHTML = '';
		document.getElementById('doneMtn').innerHTML = '<button class="myButton" onclick="kwishura()"><i class="icon md-check"></i>Done</button>';
	}
}
</script>

</body>
</html>
