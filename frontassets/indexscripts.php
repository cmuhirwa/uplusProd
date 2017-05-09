<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../db.php");
?>

<?PHP // 1 START HOLD FOR AMOUNT RWF && PROMPT THE  PHONE AND DESC
	
if(isset($_GET['groupName'])){ // HOLD THE DATA IN VARIABLE
	$groupName	= $_GET['groupName'];
	$amount 	= $_GET['amount'];
	$currency	= $_GET['currency'];
?>

<h2 class="slide_header" id="slide_header"><?php echo $groupName;?></h2>
<form action="frontassets/indexscripts.php" method="post">
	<input type="hidden" name="fundName" id="fundName" value="<?php echo $groupName;?>"/>
	<input type="hidden" name="fundAmount" id="fundAmount" value="<?php echo $amount;?>"/>
	<input type="hidden" name="fundCurrency" id="fundCurrency" value="<?php echo $currency;?>"/>
	<p>
		<div id="returnName">We need a phone to send <?php echo number_format($amount); echo $currency;?> to</div>
	</p><br>
	<div class="inputContainer">
		<input type="text"  disabled class="newinput" id="selectCurrency" value="+250" style="width: 29%;height: 50px;padding-top: 6px;font-size: 32px;"/>
		<input name="raisePhone" onkeyup="change(this);" id="raisePhone" class="newinput" style="width: 70%; text-align: unset;" placeholder="Phone"/> 	
	</div>
	<div class="inputContainer">
		<textarea name="fundDesc" onkeyup="changedesc(this);" id="fundDesc" class="newinput" max="10" style="width: 100%; height: 75px; font-size:20px;text-align: unset;" placeholder="Short Description of <?php echo $groupName;?>"></textarea><br/>
	</div>
	<div style="text-align: right; padding-right: 3px;" id="doneBtn">
		
	</div>
</form>

<!-- START JAVASCRIPTS TO CHECK THE PHONE AND SEND DATA -->
<script>
function change (el) 
{
	var max_len = 9;
	var full_phone = 8;
	if (el.value.length > max_len) 
	{
		el.value = el.value.substr(0, max_len);
	}
	if (el.value.length > full_phone) 
	{
	var userphone	 = '0'+document.getElementById('raisePhone').value;
	var fundAmount	 = document.getElementById('fundAmount').value;
	var fundCurrency = document.getElementById('fundCurrency').value;
	//alert(userphone);
	$.ajax({
		type		:"GET",
		url			:"frontassets/indexscripts.php",
		datatype	:"html",
		data		:{
			Checkuserphone 	: userphone,
			fundAmount		: fundAmount,
			fundCurrency 	: fundCurrency,
		},
		success	:function(html, textStatus)
		{
			$('#returnName').html(html);
		},
		error: function(xht, textStatus, errorThrown)
		{
			alert("Error:"+ errorThrown);
		}
	});
	$.ajax({
		type		:"GET",
		url			:"frontassets/indexscripts.php",
		datatype	:"html",
		data		:{
			CheckuserphoneBtn 	: userphone,
		},
		success	:function(html, textStatus)
		{
			$('#doneBtn').html(html);
		},
		error: function(xht, textStatus, errorThrown)
		{
			alert("Error:"+ errorThrown);
		}
	});
	}
	//document.getElementById('raisePhone').innerHTML =
}
function changedesc (el) 
{
	var max_len = 102;
	if (el.value.length > max_len) 
	{
		el.value = el.value.substr(0, max_len);
	}
}
</script>
<!-- END JAVASCRIPTS TO CHECK THE PHONE AND SEND DATA -->  

<?php // 1 END HOLD FOR AMOUNT RWF && PROMPT THE  PHONE AND DESC
}
?>  
                   
<?php // 2 START CHECK IF THE USER EXISTS
if(isset($_GET['CheckuserphoneBtn'])){
	$phonebtn = $_GET['CheckuserphoneBtn'];
	$sqlbtn = $db->query("SELECT * FROM users WHERE phone='$phonebtn' AND active =1 LIMIT 1");
	$countPhonesbtn =	mysqli_num_rows($sqlbtn);
	if($countPhonesbtn > 0)
	{
		echo '<input type="submit" name="savethereturn" class="md-btn md-btn-large md-btn-success" style="background: #007569;" value="Done"/>';
	}
	else
	{
		echo '<a href="javascript:viod()" onclick="registerFb()" class="md-btn md-btn-large md-btn-success" style="background: #007569;">Done</a>';
	}
}
if(isset($_GET['Checkuserphone'])){
	$phone 			= $_GET['Checkuserphone'];
	$fundAmount		= $_GET['fundAmount'];
	$fundCurrency	= $_GET['fundCurrency'];
	$sql = $db->query("SELECT * FROM users WHERE phone='$phone' AND active =1 LIMIT 1");
	$countPhones =	mysqli_num_rows($sql);
	if($countPhones > 0)
	{
		while($row = mysqli_fetch_array($sql))
		{
			$password = $row['password'];
			$id = $row["id"];
			$lastvisit = $row['visits'];
			
			session_start();			
			$_SESSION["id"] = $id;
			$_SESSION["phone1"] = $phone;
			$_SESSION["password"] = $password;
			$newvisit = $lastvisit + 1;
			$sqlUpdateVisitation = $db->query("UPDATE users SET visits = $newvisit, last_visit=now() WHERE id = $id")or die (mysqli_error());
			$adminName = $row['name'];
			$adminId = $row['id'];
			echo '<input hidden name="adminName" value="'.$adminName.'">';
			echo '<input hidden name="adminId" value="'.$adminId.'">';
			echo $row['name'].', We will send you '.number_format($fundAmount).''.$fundCurrency.' through '.$phone.' but you can change it later';
		}
	}
	elseif($countPhones == 0)
	{
		session_start();
		if(!empty($_SESSION['phone1'])) {
		unset($_SESSION['phone1']);
		}
		echo 'Ok! We will send '.number_format($fundAmount).''.$fundCurrency.' to '.$phone.' but you can change it later';
	}
} // 2 END CHECK IF THE USER EXISTS
?> 

<?php // 3 IF ITS A RETURNING CUSTOMER JUST SAVE THE FUNDRAISE AND REDIRECT
if(isset($_POST['savethereturn']))
{
	$accName 		= $_POST['fundName'];
	$saving 		= $_POST['fundAmount'];
	$fundCurrency 	= $_POST['fundCurrency'];
	$adminId 		= $_POST['adminId'];
	$adminName	 	= $_POST['adminName'];
	$adminPhone 	= '0'.$_POST['raisePhone'];
	$groupDesc 		= $_POST['fundDesc'];
	$groupBank 		= 1;


	// 1 add the account with the phone
	$sql = $db->query("INSERT INTO accounts
		(accName, adminId, adminName, adminPhone, bankaccount, groupBank, groupDesc,
		groupType, saving, createdDate,level)
		VALUES
		('$accName', '$adminId', '$adminName', '$adminPhone','$adminPhone','$groupBank','$groupDesc',
		'WEDDING','$saving',now(), 'private')
		") or die (mysqli_error());
		
		// 2 GRAB ACCONT ID
		$sqlid = $db->query("SELECT id FROM accounts ORDER BY id DESC LIMIT 1") or die (mysqli_error());
		$rowid = mysqli_fetch_array($sqlid);
		$lastid = $rowid['id'];
		$lastAccountName = $fetchaccountId['accName'];
		
		$defaltSMS = 'Hi! '.$adminName.' is raising '.number_format($saving).' Rwf for '.$accName.'. To contribute visit this link http://uplus.rw/f/i'.$lastid.' , for more info call '.$adminName.' on '.$adminPhone.'';
		$insertSMS = $db->query("UPDATE accounts SET custommessage = '$defaltSMS' WHERE id = '$lastid'")or die (mysqli_error());

		// 3 START GO TO ADD THE ACCOUNT TO RTGS 3//////////////////////////////////////////////3
			//////////////////////////////////////////////////////////////////////
				//START CHECK IF THE SENDER IS NOT NEW
					$sqlCheckExist = $outCon -> query("SELECT * FROM bank_accounts WHERE accountNumber ='$adminPhone' limit 1");
					$countExistAccount = mysqli_num_rows($sqlCheckExist);
					if(!$countExistAccount > 0){
					// START INSERT THE ACCOUNT  	
						$sql = $outCon->query("insert into clients(name) values('$accName')");
						$sqllaststu= $outCon->query("select id from clients order by id desc limit 1");
						$laststu_id=$row=mysqli_fetch_array($sqllaststu);
						$client_id=$row['id'];
						$sqlsklstu= $outCon->query("insert into bank_client(client_id, bank_id, accountNumber) 
						  values('$client_id','1','$adminPhone')")or mysqli_error();
					// END INSERT THE ACCOUNT
					$conectGroupBank = $outCon->query("insert into group_account (accountNumber, groupId, bankId) 
					VALUES ('$adminPhone','$lastid', '1')");
					//echo 'accountNumber: '.$adminPhone.' and bankName: '.$lastid.', Collection Account created<br/>';
					}
					else{
						$conectGroupBank = $outCon->query("insert into group_account (accountNumber, groupId, bankId) 
						VALUES ('$adminPhone','$lastid', '1')");
					//echo 'accountNumber: '.$adminPhone.' and bankName: '.$lastid.', Collection Account created<br/>';
					
					}
		
			/////////////////////////////////////////////////////////////////
		//3 END GO TO ADD THE ACCOUNT TO RTGS 3///////////////////////////////////////////////////
		
	$userId = $adminId;
	$sqljoin = $db->query("INSERT INTO account_user
	(acceptance, accountID, userId )
	VALUES
	('yes', '$lastid', '$userId')")or die (mysqli_error());
	header('location: ../editCont'.$lastid.'');
	exit();
}
?>

<?php // 4 SAVE FACEBOOK DATA
if(isset($_GET['savename']))
{
	$savename 	= $_GET['savename'];
	$fbId 		= $_GET['fbId'];
	$gender 	= $_GET['gender'];
	$picture 	= $_GET['picture'];
	
	$fundName	 = $_GET['fundName'];
	$fundAmount	 = $_GET['fundAmount'];
	$fundCurrency= $_GET['fundCurrency'];
	$fundPhone	 = $_GET['fundPhone'];
	$fundDesc	 = $_GET['fundDesc'];
	
	// Check if fb is new
	$sqlCheckFb = $db->query("SELECT * FROM users WHERE fbId = '$fbId' LIMIT 1");
	$countCheckFb = mysqli_num_rows($sqlCheckFb);
	if($countCheckFb > 0)
	{
		$rowUserFbs = mysqli_fetch_array($sqlCheckFb);
		$passworduser = $rowUserFbs['password'];
		$iduser = $rowUserFbs['id'];
		$lastvisit = $rowUserFbs['visits'];
		$phoneuser = $rowUserFbs['phone'];
			
			session_start();
			$_SESSION["id"] = $iduser;
			$_SESSION["phone1"] = $phoneuser;
			$_SESSION["password"] = $passworduser;
			$newvisit = $lastvisit + 1;
			$sqlUpdateVisitation = $db->query("UPDATE users SET visits = $newvisit, last_visit=now() WHERE id = $iduser")or die (mysqli_error());
	}
	else
	{
		$sql = $db->query("INSERT INTO users
		(fbId, gender, phone, active, joinedDate, last_visit,
		name, password, visits)
		VALUES
		('$fbId', '$gender', '$fundPhone', '1', now(), now(),
		'$savename', '1234', '1')
		") or die (mysqli_error());
		//echo 'it was not in';
		$sqllastUser = $db->query("SELECT * FROM users ORDER BY id DESC limit 1");
		$rowUserLast = mysqli_fetch_array($sqllastUser);
			
		$phoneuser = $rowUserLast['phone'];
		$passworduser = $rowUserLast['password'];
		$iduser = $rowUserLast['id'];
		$lastvisit = $rowUserLast['visits'];
			 
		session_start();
		$_SESSION["id"] = $iduser;
		$_SESSION["phone1"] = $phoneuser;
		$_SESSION["password"] = $passworduser;
		$newvisit = $lastvisit + 1;
		$sqlUpdateVisitation = $db->query("UPDATE users SET visits = $newvisit, last_visit=now(), active =1 WHERE id = $iduser")or die (mysqli_error());
		
		$contents	= file_get_contents($picture);
		$save_path="../proimg/".$iduser.".jpg";
		file_put_contents($save_path,$contents);
	}
	
// CREAT THE GROUP

	$accName 	= $fundName;
	$adminName 	= $savename;
	$adminPhone = $phoneuser;
	$bankaccount= $fundPhone;
	$groupBank	= 1;
	$groupDesc	= $fundDesc;
	$groupType	= 'WEDDING';
	$saving 	= $fundAmount;
	
	$sqlNewContribution = $db->query("INSERT INTO `accounts`( 
    accName, adminId, adminName,adminPhone,
	bankaccount,groupBank,groupDesc,
	groupType,saving,createdDate) VALUES (
	'$accName', '$iduser', '$adminName','$adminPhone',
	'$bankaccount','$groupBank','$groupDesc',
	'$groupType','$saving',now())
	") or die (mysqli_error());
	$sqllastFund = $db->query("SELECT id FROM accounts ORDER BY id desc limit 1");
	$rowlastFund = mysqli_fetch_array($sqllastFund);
	$lastFund = $rowlastFund['id'];
	
	$defaltSMS	= 'Hi! '.$adminName.' is raising '.number_format($saving).' Rwf for '.$accName.'. To contribute visit this link http://uplus.rw/f/i'.$lastFund.' , for more info call '.$adminName.' on '.$adminPhone.'';
	$insertSMS = $db->query("UPDATE accounts SET custommessage = '$defaltSMS' WHERE id = '$lastFund'")or die (mysqli_error());

	// 3 START GO TO ADD THE ACCOUNT TO RTGS 3//////////////////////////////////////////////3
			//////////////////////////////////////////////////////////////////////
				//START CHECK IF THE SENDER IS NOT NEW
					$sqlCheckExist = $outCon -> query("SELECT * FROM bank_accounts WHERE accountNumber ='$adminPhone' limit 1");
					$countExistAccount = mysqli_num_rows($sqlCheckExist);
					if(!$countExistAccount > 0){
					// START INSERT THE ACCOUNT  	
						$sql = $outCon->query("insert into clients(name) values('$accName')");
						$sqllaststu= $outCon->query("select id from clients order by id desc limit 1");
						$laststu_id=$row=mysqli_fetch_array($sqllaststu);
						$client_id=$row['id'];
						$sqlsklstu= $outCon->query("insert into bank_client(client_id, bank_id, accountNumber) 
						  values('$client_id','1','$bankaccount')")or mysqli_error();
					// END INSERT THE ACCOUNT
					$conectGroupBank = $outCon->query("insert into group_account (accountNumber, groupId, bankId) 
					VALUES ('$bankaccount','$lastFund', '1')");
					//echo 'accountNumber: '.$adminPhone.' and bankName: '.$lastid.', Collection Account created<br/>';
					}
					else{
						$conectGroupBank = $outCon->query("insert into group_account (accountNumber, groupId, bankId) 
						VALUES ('$bankaccount','$lastFund', '1')");
					//echo 'accountNumber: '.$adminPhone.' and bankName: '.$lastid.', Collection Account created<br/>';
					
					}
		
			/////////////////////////////////////////////////////////////////
		//3 END GO TO ADD THE ACCOUNT TO RTGS 3///////////////////////////////////////////////////
		
	$userId = $iduser;
	$sqljoin = $db->query("INSERT INTO account_user
	(acceptance, accountID, userId )
	VALUES
	('yes', '$lastFund', '$userId')")or die (mysqli_error());
	
	echo '<div style="text-align: center; color: #fff; font-size:20px;">
		Thanks '.$savename.', we are creating your contribution...
	<div>';
	//header('location: ../editCont'.$lastFundId.'');*/
}
?>

<?php // 5 IF CHOSEN TO USE PHONE SEND PIN
if(isset($_GET['getPin']))
{
	$fundPhone	 = $_GET['fundPhone'];
	$sqlcheckPin = $db->query("SELECT password FROM users WHERE phone = '$fundPhone' LIMIT 1");
	$countPin = mysqli_num_rows($sqlcheckPin);
	if($countPin > 0)
	{
		$rowpin = mysqli_fetch_array($sqlcheckPin);
		$code = $rowpin['password'];
	}else
	{
		$code = rand(1000, 9999);
		$sqlsavePin = $db->query("INSERT INTO `users`(
		phone, active, joinedDate, password,visits) 
		VALUES('$fundPhone','0',now(),'$code','0')")or die (mysqli_error());
	}
	
	require_once('../classes/sms/AfricasTalkingGateway.php');
	$username   = "cmuhirwa";
	$apikey     = "17700797afea22a08117262181f93ac84cdcd5e43a268e84b94ac873a4f97404";
	$recipients = '+25'.$fundPhone;
	$message    = 'Welcome to uPlus, Please use '.$code.' to activate your uPlus account.';// Specify your AfricasTalking shortCode or sender id
	$from = "uplus";

	$gateway    = new AfricasTalkingGateway($username, $apikey);

	try 
	{
		$results = $gateway->sendMessage($recipients, $message, $from);
		
		ECHO'
		<div style="color: #fff;">
			Enter a 4digit pin we sent you on '.$fundPhone.'
			<input id="pincode" hidden value="'.$code.'">
			<div class="inputContainer">
				<input name="pin" onkeyup="changePin(this);" id="pin" class="newinput" style="color: #fff; width: 50%; text-align: unset;" placeholder="PIN"/> 	
			</div>
		</div>';
	}
	catch (AfricasTalkingGatewayException $e)
	{
		$results.="Encountered an error while sending: ".$e->getMessage();
	}

}
?>

<?PHP // 6 VERIFY THE PIN
if(isset($_GET['checkPin']))
{
	$pin			= $_GET['pin'];
	
	$fundName	 = $_GET['fundName2'];
	$fundAmount	 = $_GET['fundAmount'];
	$fundCurrency= $_GET['fundCurrency'];
	$fundPhone	 = $_GET['fundPhone'];
	$fundDesc	 = $_GET['fundDesc'];
	$savename	 = "";
		
	$sqlcheckPin 	= $db->query("SELECT * FROM users WHERE phone = '$fundPhone' LIMIT 1");
	$rowPin 		= mysqli_fetch_array($sqlcheckPin);
	$PinCheck 		= $rowPin['password'];
	if($PinCheck == $pin)
	{// KEEP SESSION AND CREAT THE ACCOUNT

		$phoneuser		= $rowPin['phone'];
		$passworduser 	= $rowPin['password'];
		$iduser 		= $rowPin['id'];
		$lastvisit 		= $rowPin['visits'];
			 
		session_start();
		$_SESSION["id"] = $iduser;
		$_SESSION["phone1"] = $phoneuser;
		$_SESSION["password"] = $passworduser;
		$newvisit = $lastvisit + 1;
		$sqlUpdateVisitation = $db->query("UPDATE users SET visits = $newvisit, last_visit=now(), active =1 WHERE id = $iduser")or die (mysqli_error());
		
		// CREAT THE GROUP

		$accName 	= $fundName;
		$adminName 	= "";
		$adminPhone = $phoneuser;
		$bankaccount= $fundPhone;
		$groupBank	= 1;
		$groupDesc	= $fundDesc;
		$groupType	= 'WEDDING';
		$saving 	= $fundAmount;
		
		$sqlNewContribution = $db->query("INSERT INTO `accounts`( 
		accName, adminId, adminName,adminPhone,
		bankaccount,groupBank,groupDesc,
		groupType,saving,createdDate) VALUES (
		'$accName', '$iduser', '$adminName','$adminPhone',
		'$bankaccount','$groupBank','$groupDesc',
		'$groupType','$saving',now())
		") or die (mysqli_error());
		$sqllastFund = $db->query("SELECT id FROM accounts ORDER BY id desc limit 1");
		$rowlastFund = mysqli_fetch_array($sqllastFund);
		$lastFund = $rowlastFund['id'];
		
		$defaltSMS	= 'Hi! '.$adminName.' is raising '.number_format($saving).' Rwf for '.$accName.'. To contribute visit this link http://uplus.rw/f/i'.$lastFund.' , for more info call '.$adminName.' on '.$adminPhone.'';
		$insertSMS = $db->query("UPDATE accounts SET custommessage = '$defaltSMS' WHERE id = '$lastFund'")or die (mysqli_error());

		// 3 START GO TO ADD THE ACCOUNT TO RTGS 3//////////////////////////////////////////////3
				//////////////////////////////////////////////////////////////////////
				//START CHECK IF THE SENDER IS NOT NEW
					$sqlCheckExist = $outCon -> query("SELECT * FROM bank_accounts WHERE accountNumber ='$adminPhone' limit 1");
					$countExistAccount = mysqli_num_rows($sqlCheckExist);
					if(!$countExistAccount > 0){
					// START INSERT THE ACCOUNT  	
						$sql = $outCon->query("insert into clients(name) values('$accName')");
						$sqllaststu= $outCon->query("select id from clients order by id desc limit 1");
						$laststu_id=$row=mysqli_fetch_array($sqllaststu);
						$client_id=$row['id'];
						$sqlsklstu= $outCon->query("insert into bank_client(client_id, bank_id, accountNumber) 
						  values('$client_id','1','$bankaccount')")or mysqli_error();
					// END INSERT THE ACCOUNT
					$conectGroupBank = $outCon->query("insert into group_account (accountNumber, groupId, bankId) 
					VALUES ('$bankaccount','$lastFund', '1')");
					//echo 'accountNumber: '.$adminPhone.' and bankName: '.$lastid.', Collection Account created<br/>';
					}
					else{
						$conectGroupBank = $outCon->query("insert into group_account (accountNumber, groupId, bankId) 
						VALUES ('$bankaccount','$lastFund', '1')");
					//echo 'accountNumber: '.$adminPhone.' and bankName: '.$lastid.', Collection Account created<br/>';
					
					}
		
			/////////////////////////////////////////////////////////////////
		//3 END GO TO ADD THE ACCOUNT TO RTGS 3///////////////////////////////////////////////////
		
		$userId = $iduser;
		$sqljoin = $db->query("INSERT INTO account_user
		(acceptance, accountID, userId )
		VALUES
		('yes', '$lastFund', '$userId')")or die (mysqli_error());
		
		echo '<div style="text-align: center; color: #fff; font-size:20px;">
			Thanks '.$savename.', we have created your contribution.
			<a style="color: #7cb342;" href="editCont'.$lastFund.'">Click here</a>..
		<div>';
		
	
	}else
	{
		echo '
		<div style="color: #fff;">
		Ops! Pin did not much, please try again and Enter a 4digit pin we sent you on '.$fundPhone.'
		<div class="inputContainer">
			<input name="pin" onkeyup="changePin(this);" id="pin" class="newinput" style="color: #fff; width: 50%; text-align: unset;" placeholder="PIN"/> 	
		</div>
	</div>';
	}
}

?>

<?php // 7 STARNT CHANGE TABS FROM FUNDS, INVEST TO SAVINGS

	if(isset($_GET['calltab'])){
		if($_GET['calltab'] == 1){
			?>
		<div id="actions" class="uk-container uk-container-center uk-invisible" data-uk-scrollspy="{cls:'uk-animation-fade uk-invisible',delay:300,topoffset:-150}">
		<h2 class="heading_c uk-margin-medium-bottom uk-text-center-medium">
                Public Contributions
            </h2> 	
			<?php
			echo '<ul class="uk-grid uk-grid-small  uk-grid-width-medium-1-3 uk-grid-width-large-1-3">
			';
					include '../db.php';
					$n="";
					$sql = $db->query("SELECT * FROM accounts WHERE level = 'public' ORDER BY rand() limit 9");
					$sqlres = $db->query("SELECT * FROM accounts WHERE level = 'public'");
					$countresults = mysqli_num_rows($sqlres);
					while($row = mysqli_fetch_array($sql))
					{
						$groupID = $row['id'];
						$groupName = $row["accName"];
							$saving = round($row['saving']);
							$likes = round($row['likes']);
							$adminPhone = $row['adminPhone'];
							$currentAmount = round($row['currentAmount']);
							$groupDescription = $row["groupDesc"];
							$groupBank = $row["bankaccount"];
							$contributionDate = $row["opening"];
							
							$sqlbalance = $outCon->query("SELECT * FROM groupbalance WHERE groupId = '$groupID'");
							$balanceCount = mysqli_num_rows($sqlbalance);

							$rowbalance = mysqli_fetch_array($sqlbalance);
							$currentAmount = $rowbalance['Balance'];
							if($balanceCount == 0){
								$currentAmount = 0;
							}
							if($currentAmount < 0){
								$prog = 0;
							
							}else{
								$prog = $currentAmount*100/$saving;
							}
								//$prog = rand(0,100);
								$prog = round($prog);
								//$likes = rand(0,300);
					echo'<li>
							<div class="md-card" style="border-radius: 5px;">
								<div class="md-card-content padding-reset">
									<div id="likes'.$groupID.'"><span class="likes" onclick="likeit(likes='.$likes.', likeid='.$groupID.')">'.$likes.'</span></div>
									<div id="heart'.$groupID.'"><i class="uk-icon-heart uk-icon-medium md-color-white heart"></i></div>
									<a href="f/i'.$row['id'].'">
										<h4 class="fundtitle">'.$row['accName'].'</h4>
										<div class="overlaytitle"></div>
									</a>
									<img class="fundPhoto" src="temp/group'.$row['id'].'.jpeg" alt="">
								</div>
								<div class="progress">
									<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="'.$prog.'" aria-valuemin="0" aria-valuemax="100" style="width:'.$prog.'%">
									  '.$prog.'%
									</div>
								</div>
								<div class="raisedNow">Raised '.number_format($currentAmount).' Rwf</div>
								<div class="md-card-content">
									'.$row['groupDesc'].'
								</div>
							</div>
							<br>
						</li>';
						
					}
					echo '</ul>';	
					if($countresults > 9){
						echo '<div class="text-center"><button class="btn btn-success">See More Contributions</button></div>';
					}
				?>
			<br>
		</div>
		<?php
		}
elseif($_GET['calltab'] == 3){
	?>
	<div id="actions" class="uk-container uk-container-center uk-invisible" data-uk-scrollspy="{cls:'uk-animation-fade uk-invisible',delay:300,topoffset:-150}">
		<h2 class="heading_c uk-margin-medium-bottom uk-text-center-medium">
               Investment Opportunities <a href="javascript:void()" onclick="csd()">CSD</a>
            </h2> 
	<ul id="csdback" class="uk-grid uk-grid-small  uk-grid-width-medium-1-3 uk-grid-width-large-1-3">
				<?php $sql1 = $investdb->query("SELECT * FROM `productcategory`");
												
							while($rowcats = mysqli_fetch_array($sql1))	
							{?>
				
				<li>
					<div class="md-card md-shadow-2dp">
						<div class="md-card-header" style="background: #007569;
    color: #fff;
    text-align: center;
    font-weight: 500;
    padding: 10px;">
							<?php 
							$CategId = $rowcats['catId'];
							echo $rowcats['catNane'];?>
						</div>
						<div class="md-card-content" style="padding-top: 0px;">
							<table class="uk-table">
								<thead>
									<tr>
										<th class="cmeFixedProduct">Product</th>
										<th class="cmeFixedLast">Price(Rwf)</th>
										<th class="cmeFixedChange">Change(%)</th>
										<th class="cmeFixedChange">Action</th>
									</tr>
								</thead>
								<tbody style="font-size: 13px">
										<?php 
		$sqlinvest = $investdb ->query("SELECT * FROM `items1` where status ='open' AND productCode = '$CategId'");
		$countData = mysqli_num_rows($sqlinvest);
		if($countData > 0){
		while($row = mysqli_fetch_array($sqlinvest)){
			$itemId = $row['itemId'];
						$postTitle = $row['itemName'];
						$abrev = $row['abrev'];
						
						$sqlPrevPrice = $investdb->query("SELECT * FROM (SELECT * FROM `theask`  WHERE itemCode = '$itemId' ORDER BY `transactionId` DESC LIMIT 2) AS Ptab ORDER BY `transactionId` ASC LIMIT 1");
						$sqlNewPrice = $investdb->query("SELECT * FROM theask WHERE itemCode = '$itemId' ORDER BY transactionID DESC limit 1");
						$rowPrevPrice = mysqli_fetch_array($sqlPrevPrice);
						$rowNewPrice = mysqli_fetch_array($sqlNewPrice);
						$prevPrice = number_format(($rowPrevPrice['unitPrice']),2);
						$updatedDate = $rowNewPrice['doneOn'];
						$currentPrice = number_format(($rowNewPrice['unitPrice']),2);
						$indicator = $currentPrice - $prevPrice;
						if($prevPrice == 0){
							$percindicator = 0;
						}else
						{
							$percindicator = round(($indicator * 100/$prevPrice),2);
						}
						if($prevPrice > $currentPrice)
						{
							$sign = '<span style="float: left;
    background: #ba031d;
    width: 50px;
    padding: 1px 2px;
    text-align: right;
    display: block;
    margin: 0 3px 0 0;
    color: #fff;
    border-radius: 4px;
"> '.$percindicator.'</span>
<i class="fa fa-angle-down" style="
    float: left;
    font-size: 18px;
    color: #ba031d;
"></i>';
						}
						elseif($prevPrice == $currentPrice)
						{
							$sign = "(0)";
						}
						else
						{
							$sign = '<span style="float: left;
    background: #4bac43;
    width: 50px;
    padding: 1px 2px;
    text-align: right;
    display: block;
    margin: 0 3px 0 0;
    color: #fff;
    border-radius: 4px;
">+ '.$percindicator.'</span>
<i class="fa fa-angle-up" style="
    float: left;
    font-size: 18px;
    color: #4bac43;
"></i>';
						}																
			?><tr>
											<td><a><?php echo $row['abrev'];?></a></td>
											<td><?php echo $currentPrice;?></td>
											<td><?php echo $sign?></td><td>
<a href="javascript:void()">More</a>
</td>
		</tr><?php }
		} ?>
								</tbody>
							</table>
						</div>
					</div>
				</li>
			<?php }?>
			</ul>
			<br>
			<br>
		</div>
		<?php
}		
	} // END CHANGE TABS FROM FUNDS, INVEST TO SAVINGS
?>

<?php // 8 LIKE THE FUND
// Check if the method exists
if(isset($_GET['newlikes'])){
	$newlikes 	=$_GET['newlikes'];
	$likeId 	=$_GET['likeId'];
	
	$sql = $db->query("UPDATE accounts SET likes='$newlikes' WHERE id = '$likeId'");
	echo 'yes';
} // END LIKE THE FUND
?> 