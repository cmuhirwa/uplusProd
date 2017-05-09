		<?php
		//error_reporting(E_ALL); 
		//ini_set('display_errors', 1);
		if (isset($_GET['groupId'])){	
				$groupID = $_GET['groupId'];
				
				include "../db.php"; 
				$sql2 = $db->query("SELECT * FROM accounts WHERE id='$groupID'"); 
				while($row = mysqli_fetch_array($sql2)){ 
					$groupName = $row["accName"];
					$saving = round($row['saving']);
					$adminPhone = $row['adminPhone'];
					$adminName = $row['adminName'];
					$currentAmount = round($row['currentAmount']);
					$groupDescription = $row["groupDesc"];
					$groupStory = $row["groupStory"];
					$groupBank = $row["bankaccount"];
					$custommessage = $row["custommessage"];
					$replymessage = $row["replymessage"];
					$contributionDate = $row["opening"];
					
					$outCon = mysqli_connect("localhost", "uplus_uplus", "clement123" , "uplus_rtgs");
					$sqlbalance = $outCon->query("SELECT * FROM groupbalance WHERE accountNumber = '$groupBank'");
					$balanceCount = mysqli_num_rows($sqlbalance);

					$rowbalance = mysqli_fetch_array($sqlbalance);
					$currentAmount = $rowbalance['Balance'];
					if($balanceCount == 0){
						$currentAmount = 0;
					}
					$prog = $currentAmount*100/$saving;
					$progressing =$prog + (20*$prog/100);
					
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

		<!doctype html>

		<html lang="en">
		  <head>
		    <meta charset="utf-8">
		    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		    
			<meta property="fb:app_id"             content="1822800737957483">
			<meta property="og:url"                content="http://uplus.rw/front/i<?php echo $groupID?>" >
			<meta property="og:type"               content="article" >
			<meta property="og:title"              content="<?php echo $groupName?> (<?php echo number_format($saving);?> Rwf)">
			<meta property="og:description"        content="<?php echo $groupDescription?>">
			<meta property="og:image"              content="http://uplus.rw/temp/group<?php echo $groupID;?>.jpeg" >
			
			<meta name="description" content="<?php echo $groupDescription?>">
		    
			
			
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
			<link rel="canonical" href="http://uplus.rw/front/i<?php echo $groupID?>">
		    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
		    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		    <!--<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.green-indigo.min.css" />
		    -->
			<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.deep_orange-amber.min.css" /><!-- <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.green-indigo.min.css" />
			 --><link rel="stylesheet" href="styles.css"><!-- 
			<link rel="stylesheet" href="css/material.deep_purple-pink.min.css"> -->
			
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		    <script src="../assets/js/jquery.js"></script>
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
		    
		    	
		   
		      <header class="mdl-layout__header mdl-color-text--accent-contrast mdl-layout__header--scroll mdl-color--primary"  >
		       
		       		<div class="mdl-layout--large-screen-only mdl-layout__header-row"  
		      			style="background-color: #00897b;">
		        	</div>
		        <div class="mdl-layout--large-screen-only mdl-layout__header-row" style="background-color: #00897b;">
		        	<center with="100%"><img src="../assets/images/apple-touch-icon.png" style="margin-left: 444%;"></center>
		        </div>
			        <div class="mdl-layout__tab-bar mdl-js-ripple-effect mdl-color-text--accent-contrast" 
			        style="background-color: #00897b;">
			          <a href="#overview" class="mdl-layout__tab is-active mdl-color-text--accent-contrast"><h6 style="color: white;">Contribution</h6></a>
			          <a href="#features" class="mdl-layout__tab mdl-color-text--accent-contrast"><h6 style="color: white;">Privacy and Terms</h6></a>
			        </div>
		      </header>
		      <main class="mdl-layout__content">
		        <div class="mdl-layout__tab-panel is-active" id="overview">
		          <section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp">
		            <header style="background-image: url(../temp/group<?php echo $groupID;?>.jpeg);background-size: cover; background-repeat: no-repeat; background-position: center center;" class="section__play-btn mdl-cell mdl-cell--5-col-desktop mdl-cell--2-col-tablet mdl-cell--4-col-phone mdl-color--teal-100 mdl-color-text--white">
		             
					  <i class="material-icons">play_circle_filled</i>
		            </header>
		            <div id="contBody" class="mdl-card mdl-cell mdl-cell--7-col-desktop mdl-cell--6-col-tablet mdl-cell--4-col-phone">
		              <div class="mdl-card__supporting-text" >
		                <h4><?php echo $groupName;?> </h4>
		                <?php echo $groupDescription;?><br/>
		                <input id="forGroupId" hidden value="<?php echo $groupID;?>">
		                <input id="forGroupName" hidden value="<?php echo $groupName;?>">
					  </div>
		              <div class="mdl-card__actions">
		                <a  href="javascript:void()" onclick="frontpayementOptions()" 
						class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored mdl-color--accent mdl-color-text--accent-contrast">Contribute Now</a>
		              </div>
		            </div>
		            <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="btn1">
		              <i class="material-icons">share</i>
		            </button>
		            <ul class="mdl-menu mdl-js-menu mdl-menu--bottom-right" for="btn1">
		              <a href="javascript:void()" id="shareBtn"><li class="mdl-menu__item">Facebook</li></a>
		              <li class="mdl-menu__item"><a href="javascript:void()">Twitter</a></li>
		              <li class="mdl-menu__item"><a href="whatsapp://send?text=You are invited to contribut for <?php echo$groupName;?> rasing <?php echo $saving;?>Rwf, now having <?php echo $currentAmount;?>Rwf. You can conribut from 100Rwf with MTN MM, Visa or Master card. For more info click: www.uplus.rw/cont<?php echo$groupID;?>">Whatsapp</a></li>
		            </ul>
		          </section>
		          <section class="section--center mdl-grid mdl-grid--no-spacing">
					<div class="mdl-cell mdl-cell--12-col">
						<?php echo number_format($currentAmount);?>/<?php echo number_format($saving);?>Rwf<div id="p3" class="mdl-progress mdl-js-progress"></div>
					</div>
		          </section>
				  <section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp">
		            <div class="mdl-card mdl-cell mdl-cell--12-col">
						<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
						  <div class="mdl-tabs__tab-bar" style="display: block;">
							  <a href="#starks-panel" class="mdl-tabs__tab is-active">Story</a>
							  <a href="#lannisters-panel" class="mdl-tabs__tab">Comments</a>
							  <a href="#targaryens-panel" class="mdl-tabs__tab">Chat</a>
						  </div>

						  <div class="mdl-tabs__panel is-active" id="starks-panel">
							<div class="mdl-card mdl-cell mdl-cell--12-col">
								<div class="mdl-card__supporting-text mdl-grid mdl-grid--no-spacing">
									<?php echo $groupStory;?>
									
								</div>
							</div>
						  </div>
						  <div class="mdl-tabs__panel" id="lannisters-panel">
							<div class="mdl-card mdl-cell mdl-cell--12-col">
							  <div class="mdl-card__supporting-text mdl-grid mdl-grid--no-spacing">
								<div class="fb-comments" data-href="http://uplus.rw/front/index.php?groupId=<?php echo $groupID;?>" data-width="760" data-numposts="5"></div>
							   </div>
							</div>
						  </div>
						  <div class="mdl-tabs__panel" id="targaryens-panel">
							Chat with the group creator here
						  </div>
						</div>
					</div> 
				  </section>
				  <section></section>
		        </div>
		        <div class="mdl-layout__tab-panel" id="features">
		         <section class="section--center mdl-grid mdl-grid--no-spacing">
					<header class="container text-left"> 
						<div class="span12 col-sm-12"> 
							<h3 class="pulloutHeadline text-left active-sending-money">
								Sending Money to or Receiving Money From a Friend or Family Member
							</h3> 
						</div> 
					</header> 
					<div class="containerCentered container"> 
						<div class="span12 col-sm-12"> 
							<a class="anchor" name="sending-money"> </a> 
							<h4 class="pulloutHeadline text-left">Sending money</h4> 
						</div> </div> <div class="containerCentered container"> 
						<div class="span12 col-sm-12"> 
						<p>You can send money to a friend or family member using the send money
							feature in your PayPal account (sometimes called 'personal payments?
							or ?peer-to-peer/P2P payments?).&nbsp; You can send money to a
							friend or family member even if they don?t have a PayPal account
							at the time you send them money, using their email address or mobile
							number in any currency that PayPal supports, and you can choose	which
							<a href="#preferred-payment-method">payment method</a> 
							you want to use. &nbsp;If the person to whom you are sending money 
							does not have a PayPal account, they can claim it by creating an
							account, or it will be refunded to you.&nbsp; Receiving money from
							a friend or family member is described under 
							<a href="#receiving-money">Receiving Money</a>.
						</p>
						<p>We may, at our discretion, impose limits on the amount of money you can send,
						including money you send for purchases. &nbsp;You can view your sending limit,
						if any, by logging into your PayPal account. &nbsp;Completing the same steps to verify 
						your information as is required for the removal of withdrawal limits, may allow us to
						increase your sending limits.</p> <p>When you send money to a friend or family member,
						one of three things may happen:&nbsp; they may accept, decline or fail to claim the money.
						&nbsp;If they either decline to accept the money or don?t claim it within 30 days of the 
						date it is sent, the money (including any fees you were charged for sending the money) 
						will be refunded to:</p> <ul> <li>The original payment method you used for the transaction,
						if you used a credit card, debit card or PayPal Credit as the payment method, or
						</li> <li>Your PayPal balance, if you used your PayPal balance as the payment method or a bank account as the payment method, once the money clears the bank.</li> </ul> <p class="contentPara">The fees applicable to sending money can be found on the <a href="https://www.paypal.com/us/webapps/mpp/paypal-fees#sending-friends-family">Fees for Sending Money to Friends and Family page</a> and will be disclosed to you in advance each time you initiate a transaction to send money to a friend or family member.&nbsp; If you convert money in your PayPal balance from one currency to another before sending money, you also will pay a <a href="#currency-conversion">currency conversion</a> spread for that conversion.&nbsp; And, if you use your credit card as the payment method when sending money, you may be charged a cash-advance fee by your card issuer.</p> <p class="contentPara">If you send money to a friend or family member from a third party (non-PayPal) website or by using a third party?s product or service, then the third party will determine if the sender or recipient pays the fee. &nbsp;This will be disclosed to you by the third party before the payment is initiated.</p> <p class="contentPara">You can also use the send money feature in your PayPal account to pay for good or services.&nbsp; You will not be charged for sending money to purchase goods or services as long as you choose the ?send money to pay for goods and services? feature in your PayPal account. &nbsp;In that case, the seller selling the goods or services pays the fees. &nbsp;You may not use the ?send money to a friend or family member? feature in your PayPal account when you are paying for goods and services.</p> <p class="contentPara">&nbsp;</p> </div> </div> <div class="containerCentered container"> <div class="span12 col-sm-12"> <a class="anchor" name="receiving-money"> </a> <h4 class="pulloutHeadline text-left">Receiving money</h4> </div> </div> <div class="containerCentered container"> <div class="span12 col-sm-12"> <p class="contentPara">If a friend or family member sends money to you, the money will appear in your PayPal balance. If someone sends you money in a currency you do not currently hold, you may decline it and return it to the sender. &nbsp;Alternatively, you can accept it as-is and create a PayPal balance in that currency or accept it and <a href="#s1-multiple-currencies">convert it</a> to the primary currency you have selected for your PayPal account.&nbsp; If you choose to convert the funds, you will be charged a <a href="#s1-multiple-currencies">currency conversion</a> spread included in the foreign exchange conversion rate.</p> </div> </div> </section>
				 </div>
		        <footer class="mdl-mega-footer">
		          <div class="mdl-mega-footer--middle-section">
		            <div class="mdl-mega-footer--drop-down-section">
		              <input class="mdl-mega-footer--heading-checkbox" type="checkbox" checked>
		              <h1 class="mdl-mega-footer--heading">Features</h1>
		              <ul class="mdl-mega-footer--link-list">
		                <li><a href="#">About</a></li>
		                <li><a href="#">Terms</a></li>
		                <li><a href="#">Partners</a></li>
		                <li><a href="#">Updates</a></li>
		              </ul>
		            </div>
		            <div class="mdl-mega-footer--drop-down-section">
		              <input class="mdl-mega-footer--heading-checkbox" type="checkbox" checked>
		              <h1 class="mdl-mega-footer--heading">Details</h1>
		              <ul class="mdl-mega-footer--link-list">
		                <li><a href="#">Spec</a></li>
		                <li><a href="#">Tools</a></li>
		                <li><a href="#">Resources</a></li>
		              </ul>
		            </div>
		            <div class="mdl-mega-footer--drop-down-section">
		              <input class="mdl-mega-footer--heading-checkbox" type="checkbox" checked>
		              <h1 class="mdl-mega-footer--heading">Technology</h1>
		              <ul class="mdl-mega-footer--link-list">
		                <li><a href="#">How it works</a></li>
		                <li><a href="#">Patterns</a></li>
		                <li><a href="#">Usage</a></li>
		                <li><a href="#">Products</a></li>
		                <li><a href="#">Contracts</a></li>
		              </ul>
		            </div>
		            <div class="mdl-mega-footer--drop-down-section">
		              <input class="mdl-mega-footer--heading-checkbox" type="checkbox" checked>
		              <h1 class="mdl-mega-footer--heading">FAQ</h1>
		              <ul class="mdl-mega-footer--link-list">
		                <li><a href="#">Questions</a></li>
		                <li><a href="#">Answers</a></li>
		                <li><a href="#">Contact us</a></li>
		              </ul>
		            </div>
		          </div>
		          <div class="mdl-mega-footer--bottom-section">
		            <div class="mdl-logo">
		              create your own
		            </div>
		            <ul class="mdl-mega-footer--link-list">
		              <li><a href="#">uplus backend</a></li>
		              <li><a href="#">Help</a></li>
		              <li><a href="#">Privacy and Terms</a></li>
		            </ul>
		          </div>
		        </footer>
		      </main>
		    </div>
			<a href="../" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-button--fab mdl-js-ripple-effect mdl-shadow--4dp" id="view-source" >
		            <i class="material-icons" role="presentation">add</i>
		            <span class="visuallyhidden">Add</span>
		          </a>
		    <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
		  <!-- MDL Progress Bar with Buffering -->
		<script>
		function frontpayementOptions(){
		var forGroupId	= document.getElementById('forGroupId').value;
		var forGroupName	= document.getElementById('forGroupName').value;
		document.getElementById('contBody').innerHTML ='Loading ...';
			$.ajax({
					type : "GET",
					url : "payments.php",
					dataType : "html",
					cache : "false",
					data : {
						forGroupId : forGroupId,
						forGroupName : forGroupName,
					},
					success : function(html, textStatus){
						$("#contBody").html(html);
					},
					error : function(xht, textStatus, errorThrown){
						alert("Error : " + errorThrown);
					}
			});
		}
		</script>
		<script>
		  document.querySelector('#p3').addEventListener('mdl-componentupgraded', function() {
		    this.MaterialProgress.setProgress(<?php echo $prog;?>);
		    this.MaterialProgress.setBuffer(<?php echo $progressing;?>);
		  });
		</script>
		<script>
		document.getElementById('shareBtn').onclick = function() {
			//alert('done');
		  FB.ui({
		    method: 'share',
			mobile_iframe: true,
		    display: 'popup',
		    href: 'http://uplus.rw/front/index.php?groupId=<?php echo $groupID?>',
		    hashtag: '#kusanya',
		    quote: 'You can contribut with MTN mobile money, Tigo Cash and Visa Card.',
		  }, function(response){});
		}
		</script>
		  </body>
		</html>
