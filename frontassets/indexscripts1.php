<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../db.php");
	
if(isset($_GET['groupName'])){
	 $groupName = $_GET['groupName'];
	 $amount = $_GET['amount'];
	 $currency = $_GET['currency'];
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<!-- END FACEBOOK LOGIN -->

<h2 class="slide_header" id="slide_header"><?php echo $groupName;?></h2>
<form action="frontassets/indexscripts.php" method="submit">
	<input type="hidden" name="fundName" value="<?php echo $groupName;?>"/>
	<input type="hidden" name="fundAmount" id="fundAmount" value="<?php echo $amount;?>"/>
	<input type="hidden" name="fundCurrency" id="fundCurrency" value="<?php echo $currency;?>"/>
	<p>
		<div id="returnName">We need a phone to send <?php echo number_format($amount); echo $currency;?> to</div>
	</p><br>
	<div class="inputContainer">
		<input type="text"  disabled class="newinput" id="selectCurrency" value="+250" style="width: 29%;
		height: 50px;
		padding-top: 6px;
		font-size: 32px;"/>
		<input name="raisePhone" onkeyup="change(this);" id="raisePhone" class="newinput" style="width: 70%; text-align: unset;" placeholder="Phone"/> 	
	</div>
	<div class="inputContainer">
		<textarea name="fundDesc" onkeyup="changedesc(this);" id="fundDesc" class="newinput" max="10" style="width: 100%; height: 75px; font-size:20px;text-align: unset;" placeholder="Short Description of <?php echo $groupName;?>"></textarea><br/>
	</div>
	<div style="text-align: right; padding-right: 3px;" id="doneBtn">
		
	</div>
</form>

<!-- 2END INTERATIONS -->
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
function registerFb(){
	var yes = 'yes';
	$.ajax({
		type		:"GET",
		url			:"scripts/facebook.php",
		datatype	:"html",
		data		:{
			Yes 	: yes,
		},
		success	:function(html, textStatus)
		{
			alert('comeback fresh');
			$('#slide_content_a').html(html);
		},
		error: function(xht, textStatus, errorThrown)
		{
			alert("Error:"+ errorThrown);
		}
	});
	
}
</script>  
<!-- 2END INTERATIONS -->
                     
<?php // CHANGE TABS FROM FUNDS, INVEST TO SAVINGS
	}
	if(isset($_GET['calltab'])){
		?>
		<div id="actions" class="uk-container uk-container-center uk-invisible" data-uk-scrollspy="{cls:'uk-animation-fade uk-invisible',delay:300,topoffset:-150}">
		<h2 class="heading_c uk-margin-medium-bottom uk-text-center-medium">
                Public Contributions
            </h2> 	
			<ul class="uk-grid uk-grid-small  uk-grid-width-medium-1-3 uk-grid-width-large-1-3">
			<?php
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
?>

<?php // CHECK IF THE USER EXISTS
if(isset($_GET['CheckuserphoneBtn'])){
	$phonebtn = $_GET['CheckuserphoneBtn'];
	$sqlbtn = $db->query("SELECT * FROM users WHERE phone='$phonebtn' LIMIT 1");
	$countPhonesbtn =	mysqli_num_rows($sqlbtn);
	if($countPhonesbtn > 0)
	{
		echo '<input type="submit" class="md-btn md-btn-large md-btn-success" style="background: #007569;" value="Done"/>';
	}
	else
	{
		echo '<a href="javascript:viod()" onclick="registerFb()" class="md-btn md-btn-large md-btn-success" style="background: #007569;">Done</a>';
	}
}
if(isset($_GET['Checkuserphone'])){
	$phone = $_GET['Checkuserphone'];
	$fundAmount		= $_GET['fundAmount'];
	$fundCurrency	= $_GET['fundCurrency'];
	session_start();
	$sql = $db->query("SELECT * FROM users WHERE phone='$phone' LIMIT 1");
	$countPhones =	mysqli_num_rows($sql);
	if($countPhones > 0)
	{
		while($row = mysqli_fetch_array($sql))
		{
			$password = $row['password'];
			$id = $row["id"];
			$lastvisit = $row['visits'];
				 
			$_SESSION["id"] = $id;
			$_SESSION["phone1"] = $phone;
			$_SESSION["password"] = $password;
			$newvisit = $lastvisit + 1;
			$sqlUpdateVisitation = $db->query("UPDATE users SET visits = $newvisit, last_visit=now() WHERE id = $id")or die (mysqli_error());
			$adminname = $row['name'];
			echo '<input hidden name="adminName" value="'.$adminname.'">';
			echo $row['name'].', We will send you '.number_format($fundAmount).''.$fundCurrency.' through '.$phone.' but you can change it later';
		}
	}elseif($countPhones == 0){
		session_destroy();
		session_start();
		$_SESSION["fundPhone"] = $phone;
		echo 'Ok! We will send '.number_format($fundAmount).''.$fundCurrency.' to '.$phone.' but you can change it later';
	}
}
?>

<?php // LIKE THE FUND
// Check if the method exists
if(isset($_GET['newlikes'])){
	$newlikes 	=$_GET['newlikes'];
	$likeId 	=$_GET['likeId'];
	
	$sql = $db->query("UPDATE accounts SET likes='$newlikes' WHERE id = '$likeId'");
	echo 'yes';
}
?>

<?php // IF ITS A RETURNING CUSTOMER JUST SAVE THE FUNDRAISE AND REDIRECT
if(isset($_GET['fundName']))
{
	$accName 		= $_GET['fundName'];
	$saving 		= $_GET['fundAmount'];
	$fundCurrency 	= $_GET['fundCurrency'];
	$adminPhone 	= '0'.$_GET['raisePhone'];
	$groupDesc 		= $_GET['fundDesc'];
	$groupBank 		= 1;


	// 1 add the account with the phone
	$sql = $db->query("INSERT INTO accounts
		(accName, adminPhone, bankaccount, groupBank, groupDesc,
		groupType, saving, createdDate,level)
		VALUES
		('$accName','$adminPhone','$adminPhone','$groupBank','$groupDesc',
		'WEDDING','$saving',now(), 'private')
		") or die (mysqli_error());
		
		// 2 GRAB ACCONT ID
		$sqlid = $db->query("SELECT id FROM accounts ORDER BY id DESC LIMIT 1") or die (mysqli_error());
		$rowid = mysqli_fetch_array($sqlid);
		$lastid = $rowid['id'];
		$lastAccountName = $fetchaccountId['accName'];

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
		
	session_start();
	$userId = $_SESSION["id"];
	$sqljoin = $db->query("INSERT INTO account_user
	(acceptance, accountID, userId )
	VALUES
	('yes', '$lastid', '$userId')")or die (mysqli_error());
	header('location: ../editCont'.$lastid.'');
	exit();
}
?>

<?php // SAVE FACEBOOK DATA
if(isset($_GET['savename']))
{
	$savename 	= $_GET['savename'];
	$fbId 		= $_GET['fbId'];
	session_start();
	$fundPhone 	= $_SESSION["fundPhone"];
	$sql = $db->query("INSERT INTO users
		(phone, active, code, joinedDate, last_visit,
		name, password, visits)
		VALUES
		('$fundPhone', '1', '1234', now(), now(),
		'$savename', '1234', '1')
		") or die (mysqli_error());
	echo '<div style="text-align: center; color: #fff; font-size:20px;">
		Thanks '.$savename.', we are creating your contribution...
	<div>';
	//header('location: home');
}
?>