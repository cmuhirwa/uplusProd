
<?php // 1 Get info information and go to the ACCOUNTS
session_start();
if (isset($_GET["groupType"])) {
	$groupType = $_GET["groupType"];
	$contType = $_GET["contType"];
	$groupName = $_GET["groupName"];
	$groupDesc = $_GET["groupDesc"];
	$thisId = $_GET["thisId"];
	$adminName = $_GET["adminName"];
	$adminPhone = $_GET["adminPhone"];

	$_SESSION["groupType"] = $groupType;
	$_SESSION["contType"] = $contType;
	$_SESSION["groupName"] = $groupName;
	$_SESSION["groupDesc"] = $groupDesc;
	$_SESSION["thisId"] = $thisId;
	$_SESSION["adminName"] = $adminName;
	$_SESSION["adminPhone"] = $adminPhone;

	//echo '<input id="clientname" hidden value="'.$adminName.'">';

	$bank ='';
	include "../db.php";
	$sql = $db->query ("SELECT * FROM financial_inst")or die(mysql_error);

	while($row = mysqli_fetch_array($sql))
	{
		$bank .='<option value="'.$row['id'].'">'.$row['name'].'</option>';
	}

	if($groupType == 'IKIMINA')
	{
		echo'<form enctype="multipart/form-data" name="myForm" id="myform" >
   <div class="form-group">
		   
		<div class="row">
			<div class="col-lg-6 col-sm-6">
			    <label class="control-label margin-bottom-15" for="contributionAmount">Contribution Amount:</label>
			    <input type="number" required class="form-control round" id="contributionAmount" required name="contributionAmount" placeholder=".00 Rwf"/><br/>
			</div>
			<div class="col-lg-6 col-sm-6">
			    <label class="control-label margin-bottom-15" for="Saving">Saving Amount</label>
			    <input type="number" class="form-control round" id="Saving" required name="Saving" placeholder=".00 Rwf"/><br/>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 col-sm-6">
			    <label class="control-label margin-bottom-15" for="transactionDays">Rotation Days Of Transaction:</label>
			    <input type="number" class="form-control round" id="transactionDays" required name="transactionDays" placeholder=""/><br/>
			</div>
			<div class="col-lg-6 col-sm-6">
			    <label class="control-label margin-bottom-15" for="startingDate">Starting Date</label>
			    <input type="date" class="form-control round" id="startingDate" name="startingDate"/><br/>
			</div>
		</div>
	</div>
 </form>' ;
	}
	elseif($groupType == 'CONTRIBUTOIN')
	{
		// TIGHT
		if($contType == 'periodical')
		{
		echo'<form enctype="multipart/form-data" name="myForm" id="myform" method="post">
				<div class="form-group">
					<div class="row">
						<div class="col-lg-4">
							<label class="control-label margin-bottom-15" for="bank">Bank</label>
							<select class="form-control round" id="bank" required name="bank">
								<option></option>
								'.$bank.'

							</select><br/>
						</div>
						<div class="col-lg-8">
							<label class="control-label margin-bottom-15" for="bankaccount">Account:</label>
							<input type="text" class="form-control round" id="bankaccount" required name="bankaccount" placeholder="account number / phone number"/><br/>
						</div>
					</div>
				</div>
			</form>' ;
		}
		// WEDDING
		elseif($contType = 'fixed')
		{
		echo'<form enctype="multipart/form-data" name="myForm" id="myform" method="post">
				<div class="form-group">
					<div class="row">
						<div class="col-lg-6">
							<label class="control-label margin-bottom-15" for="WeedingAmount">Needed Ammount:</label>
								<input type="number" class="form-control round" id="WeedingAmount" required name="WeedingAmount" placeholder="Rwf..."/><br/>
						<br/>
						</div>
						<div class="col-lg-6">
							<label class="control-label margin-bottom-15" for="WeddingDate">Ending Date:</label>
							<input type="date" class="form-control round" id="WeddingDate" required name="WeddingDate" placeholder="account number / phone number"/><br/>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<label class="control-label margin-bottom-15" for="bank">Bank</label>
							<select class="form-control round" id="bank" required name="bank">
								<option></option>
								'.$bank.'

							</select><br/>
						</div>
						<div class="col-lg-8">
							<label class="control-label margin-bottom-15" for="bankaccount">Account:</label>
							<input type="text" class="form-control round" id="bankaccount" required name="bankaccount" placeholder="account number / phone number"/><br/>
						</div>
					</div>
				</div>
			</form>';
		}else{
			echo'swate!';
		}
	}
	elseif($groupType == 'INVESTMENT')
	{
		echo '<div class="form-group">
					<div class="row">
						<div class="col-lg-6">
							<label class="control-label margin-bottom-15" for="investmentAmount">Needed Ammount:</label>
								<input type="text" onchange="getShares()" onkeyup="getShares()" class="form-control round" id="investmentAmount" required placeholder="....Rwf"/><br/>
						<br/>
						</div>
						<div class="col-lg-6">
							<label class="control-label margin-bottom-15" for="offerDate">Ending Date:</label>
							<input type="date" class="form-control round" id="offerDate" required placeholder=""/><br/>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<label class="control-label margin-bottom-15" for="totalShares">Total Shares:</label>
								<input type="text" onchange="getShares()" onkeyup="getShares()" class="form-control round" id="totalShares" required  placeholder="....Shares"/><br/>
						<br/>
						</div>
						<div class="col-lg-6" id="pershare">
							<label class="control-label margin-bottom-15" for="ashare">1 Share:</label>
							<input type="number" class="form-control round" id="ashare" required placeholder="...Rwf/Share" disabled><br/>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<label class="control-label margin-bottom-15" for="bank">Bank</label>
							<select class="form-control round" id="bank" required name="bank">
								<option></option>
								'.$bank.'

							</select><br/>
						</div>
						<div class="col-lg-8">
							<label class="control-label margin-bottom-15" for="bankaccount">Account:</label>
							<input type="text" class="form-control round" id="bankaccount" required name="bankaccount" placeholder="account number / phone number"/><br/>
						</div>
					</div>
				</div>';
	}
	else
	{
		echo $groupType;
	}

}
?>

<?php // 2 Get account information and go to invite

// 2.a IKIMINA Get the account information and go to invite IKIMINA
if (isset($_GET["contributionAmount"])) {

	$contributionAmount = $_GET["contributionAmount"];
	$transactionDays = $_GET["transactionDays"];
	$startingDate = $_GET["startingDate"];
	$Saving = $_GET["Saving"];
	
	$_SESSION["contributionAmount"] = $contributionAmount;
	$_SESSION["transactionDays"] = $transactionDays;
	$_SESSION["startingDate"] = $startingDate;
	$_SESSION["Saving"] = $Saving;
	

	if(!$contributionAmount == 0)
	{
		echo'<div class="form-group">
			<div class="row">
				<div id="ghostphone"></div>
				<div class="col-lg-5" id="status">
					<label class="control-label margin-bottom-15" for="invitePhone">Invite Someone into '.$_SESSION["groupName"].':</label>
					<div class="form-group">
					  <div class="input-group">
						<input type="number" class="form-control" id="invitePhone" name="invitePhone" required value="" placeholder="Type a phone and hit enter">
						<span class="input-group-btn">
						  <button type="button" class="btn btn-primary waves-effect waves-light">+</button>
						</span>
					  </div>
					</div>
				</div>
				<div class="col-lg-2" id="excelOr" style="text-align: center;">
					<br/><br/>OR
				</div>
				<div class="col-lg-5">
					<label class="control-label margin-bottom-15"  for="invitePhone">Import Excel Document:</label>
					<div class="input-group input-group-file" >
						<span class="input-group-btn" >
							<span class="btn btn-success btn-file btn waves-effect waves-light ladda-button" data-style="expand-left" data-plugin="ladda">
								<i class="icon md-upload" aria-hidden="true"></i>
								<input type="file" name="file1" id="file1" onchange="uploadFile()">
								Upload Excel
							</span>
						</span>
						 <div class="hidden" id="examplePopoverTable">
                    
					 </div>
					
				</div>
			</div>
		
		</div>
		
		<div class="row" id="excelTemplate">
			<div class="col-lg-12">
			<h6 style="text-align: center;">For Excel use this Template:</h6>
				<a href="docs/template.xls"><img src="assets/images/excelcontacts.jpg" style="display: block; border: 1px solid black; margin: auto; width: 60%;"></a>
			</div>
		</div>' ;
	}else{
		echo'dint work try again.';
	}

}

// 2.b TITHE Get the account information and go to invite TIGHT
if (isset($_GET["tightbank"])) {

	$tightbank = $_GET["tightbank"];
	$bankaccount = $_GET["bankaccount"];

	$_SESSION["tightbank"] = $tightbank;
	$_SESSION["bankaccount"] = $bankaccount;
	echo'  <div class="form-group">
			<div class="row">
				<div id="ghostphone"></div>
				<div class="col-lg-5" id="status">
					<label class="control-label margin-bottom-15" for="invitePhone">Invite Someone into '.$_SESSION["groupName"].':</label>
					<div class="form-group">
					  <div class="input-group">
						<input type="number" class="form-control" id="invitePhone" name="invitePhone" required value="" placeholder="Type a phone and hit enter">
						<span class="input-group-btn">
						  <button type="button" class="btn btn-primary waves-effect waves-light">+</button>
						</span>
					  </div>
					</div>
				</div>
				<div class="col-lg-2" style="text-align: center;">
					<br/><br/>OR
				</div>
				<div class="col-lg-5">
					<label class="control-label margin-bottom-15"  for="invitePhone">Import Excel Document:</label>
					<div class="input-group input-group-file" >
						<span class="input-group-btn" >
							<span class="btn btn-success btn-file btn waves-effect waves-light ladda-button" data-style="expand-left" data-plugin="ladda">
								<i class="icon md-upload" aria-hidden="true"></i>
								<input type="file" name="file1" id="file1" onchange="uploadFile()">
								Upload Excel
							</span>
						</span>
						 <div class="hidden" id="examplePopoverTable">
                    
					 </div>
					
				</div>
			</div>
		
		</div>
		
		<div class="row" >
			<div class="col-lg-12">
			<h6 style="text-align: center;">For Excel use this Template:</h6>
				<a href="docs/template.xls"><img src="assets/images/excelcontacts.jpg" style="display: block; border: 1px solid black; margin: auto; width: 80%;"></a>
			</div>
		</div>
		<div class="row" >
			<div class="col-lg-12">
				<div class="form-group">
					<label class="control-label" for="custommessage">Custom Invitation Message:</label>
					<textarea class="form-control" style="height: 80px;" id="custommessage" required placeholder="Eg: please contribut for me or This is the official curch tithe..."></textarea>
				</div>
			</div>
		</div>';
}

// 2.C WEDDING Get the account information and go to invite WEDDING
if (isset($_GET["WeedingAmount"])) {

	$_SESSION['WeedingAmount']		= $_GET["WeedingAmount"];
	$_SESSION['WeddingDate'] 		= $_GET["WeddingDate"];
	$_SESSION['Weddingbank'] 		= $_GET["Weddingbank"];
	$_SESSION['Weddingbankaccount'] = $_GET["Weddingbankaccount"];

	if(!$_SESSION['WeedingAmount'] == 0)
	{
		$GroupAidentif =rand(10,99);
		$GroupBidentif = rand(1,9);
		$groupCode = '#u+'.$GroupAidentif.'mv'.$GroupBidentif.'';
		echo'<div class="form-group">
			<div class="row">
				<div id="ghostphone"></div>
				<div class="col-lg-5" id="status">
					<label class="control-label margin-bottom-15" for="invitePhone">Invite '.$_SESSION["groupName"].' contributors:</label>
					<div class="form-group">
					  <div class="input-group">
						<input type="text" class="form-control" id="invitePhone" name="invitePhone" value="" placeholder="Type a phone and hit enter">
						<span class="input-group-btn">
						  <button type="button" class="btn btn-primary waves-effect waves-light">+</button>
						</span>
					  </div>
					</div>
				</div>
				<div class="col-lg-2" id="excelOr" style="text-align: center;">
					<br/><br/>OR
				</div>
				<div class="col-lg-5">
					<label class="control-label margin-bottom-15"  for="invitePhone">Import Excel Document:</label>
					<div class="input-group input-group-file" >
						<span class="input-group-btn" >
							<span class="btn btn-success btn-file btn waves-effect waves-light ladda-button" data-style="expand-left" data-plugin="ladda">
								<i class="icon md-upload" aria-hidden="true"></i>
								<input type="file" name="file1" id="file1" onchange="uploadFile()">
								Upload Excel
							</span>
						</span>
						 <div class="hidden" id="examplePopoverTable">
                    
					 </div>
					
				</div>
			</div>
		
		</div>
		
		<div class="row" id="excelTemplate">
			<div class="col-lg-12">
			<h6 style="text-align: center;">For Excel use this Template:</h6>
				<a href="docs/template.xls"><img src="assets/images/excelcontacts.jpg" style="display: block; border: 1px solid black; margin: auto; width: 60%;"></a>
			</div>
		</div><br>
		<div class="row" >
			<div class="col-lg-6">
				<div class="form-group">
					<label class="control-label" for="custommessage">Custom Invitation SMS:   <i class="icon md-phone"></i></label>
					<textarea class="maxlength-textarea form-control" data-plugin="maxlength" 
					data-placement="bottom-right-inside" maxlength="160" rows="5" id="custommessage"
					required >'.$_SESSION["groupName"].' needs your help, we are raising : '.number_format($_SESSION['WeedingAmount']).'Rwf.
To contribute dail *182*1*8# and use '.$groupCode.'. For more info visit uplus.rw or call '.$_SESSION["adminPhone"].'.</textarea>
                
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label class="control-label" for="custommessage">Custom thanks SMS:   <i class="icon md-phone"></i></label>
					<textarea class="maxlength-textarea form-control" data-plugin="maxlength" 
					data-placement="bottom-right-inside" maxlength="160" rows="5" id="replymessage" required">Thank you {{contributorName}} for your significant contribution which supported '.$_SESSION["groupName"].' up to {{CurrentAmount}} Rwf out of '.number_format($_SESSION['WeedingAmount']).'Rwf.</textarea>
				</div>
			</div>
		</div>' ;
	}else{
		echo'dint work try again.';
	}
}

// 2.D INVESTMENT Get the account information and go to invite INVESTMENT
if (isset($_GET["investmentAmount"])) {

	$_SESSION['investmentAmount']	= $_GET["investmentAmount"];
	$_SESSION['offerDate'] 			= $_GET["offerDate"];
	$_SESSION['totalShares'] 		= $_GET["totalShares"];
	$_SESSION['ashare']				= $_GET["ashare"];
	$_SESSION['invesTbankaccount'] 	= $_GET["bankaccount"];
	$_SESSION['investmentAccount'] 	= $_GET["investmentAccount"];

	if(!$_SESSION['investmentAmount'] == 0)
	{
		echo'<div class="form-group">
				<label class="control-label margin-bottom-15" for="inviteWeddingPhone">Invite Someone to invest in '.$_SESSION["groupName"].':</label>
                <div class="form-group">
				  <div class="input-group">
					<input type="text" class="form-control" id="inviteInvestorPhone" value="" placeholder="Type a phone and hit enter">
					<span class="input-group-btn">
					  <button type="button" class="btn btn-primary waves-effect waves-light">+</button>
					</span>
				  </div>
				</div>
		   </div>' ;
	}else{
		echo'dint work try again.';
	}
}

?>

<?PHP // 3 Get the phones to be invited and save in the db

// 3.a IKIMINA  Get the phones and submit in the db IKIMINA
if (isset($_GET["invitePhone"]))
{
	
	$phones = $_GET["invitePhone"];
	
	$groupDesc = $_SESSION["groupDesc"];
	$groupType = $_SESSION["groupType"];
	$groupName = $_SESSION["groupName"];
	$contAmmount = $_SESSION["contributionAmount"];
	$transPeriode = $_SESSION["transactionDays"];
	$defaultPhone = $_SESSION["adminPhone"];
	$thisid = $_SESSION['thisId'];
	$starting = $_SESSION["startingDate"];
	$adminName = $_SESSION["adminName"];
	$Saving = $_SESSION["Saving"];
	
	include "../db.php";
	
	if($phones == 0000)
	{	
		// 1 add the account with the phone
		$sql = $db->query("INSERT INTO accounts(groupType, accName, adminPhone, adminName, periodes, contribution, opening, transactionDate, groupDesc, saving)
		VALUES ('$groupType', '$groupName','$defaultPhone','$adminName','$transPeriode','$contAmmount','$starting', '$starting', '$groupDesc', '$Saving')")or die (mysqli_error());
		
		// 2 GRAB ACCONT ID
		$sqlgetlstaccount = $db->query("SELECT id, accName FROM accounts order by id desc limit 1")or die (mysqli_error());
		$fetchaccountId = mysqli_fetch_array($sqlgetlstaccount);
		$lastAccountId = $fetchaccountId['id'];
		$lastAccountName = $fetchaccountId['accName'];

		// ADMIN FIRST (Send me an invitation first)
		$sqladmininvitation = $db->query("INSERT INTO `account_user`(`accountID`, `userID`) VALUES ('$lastAccountId','$thisid')") or die (mysqli_error());

		// EXCEL BULK INVITATIONS
		include ("../Classes/PHPExcel/IOFactory.php");
		$objPHPExcel = PHPExcel_IOFactory::load('../docs/contacts.xls');
		$n=0;
		$nsms=0;
		$nofexcelcontacts=0;
		echo"<h4>Status</h4>";
		
		// LOOP BULK CONTACTS: 1.INSERTING NEW, 2.CONNECTING TO THE ACCOUNT, 3.SENDING EMAILS 
		foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
	{
		$highestRow = $worksheet->getHighestRow();
		for ($row=2; $row<=$highestRow; $row++)
		{

		   $names = mysqli_real_escape_string($db, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
		   $phone = mysqli_real_escape_string($db, $worksheet->getCellByColumnAndRow(1, $row)->getValue());

			// 2 Check if the inveted user is new
			$sqlcheckifuserexists = $db->query("SELECT id, name FROM users WHERE phone = '$phone'")or die (mysqli_error());
			$checkuser = mysqli_num_rows($sqlcheckifuserexists);
		if($checkuser > 0)
		{
			$fetchCheckedUser = mysqli_fetch_array($sqlcheckifuserexists);
			$userId = $fetchCheckedUser['id'];
			$userName = $fetchCheckedUser['name'];
		}
		else
		{
			$sqlsaveexcel = $db->query ("INSERT INTO users (phone, name) VALUES ('$phone', '$names')")or die (mysqli_error());

			// 2.1 grab that id
			$sqlgetuserId = $db->query("SELECT id, name from users where phone = '$phone'");
			$fetchuserId = mysqli_fetch_array($sqlgetuserId);
			$userId = $fetchuserId['id'];
			$userName = $fetchuserId['name'];
		}
		$sqlCheckAccount_User = $db->query("SELECT * FROM account_user WHERE accountID ='$lastAccountId' and userId='$userId'");
		$countIfAccUserExists = mysqli_num_rows($sqlCheckAccount_User);
		if($countIfAccUserExists > 0)
		{
			echo'Opps! user '.$userName.' with '.$phone.' is already in group '.$lastAccountName.'<br/>';
		}
		else
		{

			// 3 join the user with an account
			$sql7 = $db->query("INSERT INTO `account_user`(`accountID`, `userID`)
							VALUES ('$lastAccountId','$userId')") or die (mysqli_error());

							$n++;
			//// START SMS ////
		require_once('../classes/sms/AfricasTalkingGateway.php');
		$username   = "cmuhirwa";
		$apikey     = "17700797afea22a08117262181f93ac84cdcd5e43a268e84b94ac873a4f97404";
		$recipients = '+25'.$phone;
		$message    = 'Hello! You have been invited by '.$adminName.' to join Ikimina called: '.$groupName.' on U+. To Join/Reject or more info visit: http://uplus.16mb.com';
		// Specify your AfricasTalking shortCode or sender id
		$from = "uplus";

		$gateway    = new AfricasTalkingGateway($username, $apikey);
		$nsms;
		try
		{

		   $results = $gateway->sendMessage($recipients, $message, $from);

		  foreach($results as $result) {
		   // echo " Number: " .$result->number;
		   // echo " Status: " .$result->status;
		   // echo " MessageId: " .$result->messageId;
		   // echo " Cost: "   .$result->cost."\n";
		   $nofexcelcontacts++;
		  }
		}
		catch ( AfricasTalkingGatewayException $e )
		{
		  echo "Encountered an error while sending invitation to ".$phone."<br> ".$e->getMessage();
		}
		//// END SMS ////


		}
	  }
	  $nn=$n+1;
	  echo "<a href='home'>Done, Connection established for ".$nn." members and 
	  SMS Invitation sent to ".$nsms." contacts
	  out of ".$nofexcelcontacts." click here.</a>";
	}
	
	// DELETE UPLOADED EXCEL CONTACT FILE
	$data="contacts.xls";    
	$dir = "../docs";    
	$dirHandle = opendir($dir);    
	while ($file = readdir($dirHandle)) {    
		if($file==$data) {
			unlink($dir."/".$file);//give correct path,
		}
	}    
	closedir($dirHandle);
	// END DELETE UPLOADED EXCEL CONTACT FILE
}
	else{
		// 1 add the account with the phone
		$sql = $db->query("INSERT INTO accounts(groupType, accName, adminPhone, adminName, periodes, contribution, opening, transactionDate, groupDesc, saving)
		VALUES ('$groupType', '$groupName','$defaultPhone','$adminName','$transPeriode','$contAmmount','$starting', '$starting', '$groupDesc', '$Saving')")or die (mysqli_error());

		// 2 GRAB ACCONT ID
		$sqlgetlstaccount = $db->query("SELECT id, accName FROM accounts order by id desc limit 1")or die (mysqli_error());
		$fetchaccountId = mysqli_fetch_array($sqlgetlstaccount);
		$lastAccountId = $fetchaccountId['id'];
		$lastAccountName = $fetchaccountId['accName'];

		
		// 2 Check if the inveted user is new
		$sqlcheckifuserexists = $db->query("SELECT id, name FROM users WHERE phone = '$phones'")or die (mysqli_error());
		$checkuser = mysqli_num_rows($sqlcheckifuserexists);
		if($checkuser > 0)
		{
			$fetchCheckedUser = mysqli_fetch_array($sqlcheckifuserexists);
			$userId = $fetchCheckedUser['id'];
			$userName = $fetchCheckedUser['name'];
		}
		else
		{
			$sqlsaveexcel = $db->query ("INSERT INTO users (phone) VALUES ('$phones')")or die (mysqli_error());

			// 2.1 grab that id
			$sqlgetuserId = $db->query("SELECT id, name from users where phone = '$phones'");
			$fetchuserId = mysqli_fetch_array($sqlgetuserId);
			$userId = $fetchuserId['id'];
			$userName = $fetchuserId['name'];
		}
		// Check if the user is not already in the group
		$sqlCheckAccount_User = $db->query("SELECT * FROM account_user WHERE accountID ='$lastAccountId' and userId='$userId'");
		$countIfAccUserExists = mysqli_num_rows($sqlCheckAccount_User);
		// Join ADMIN FIRST (Send me an invitation first)
		$sqladmininvitation = $db->query("INSERT INTO `account_user`(`accountID`, `userID`) VALUES ('$lastAccountId','$thisid')") or die (mysqli_error());
		
		if($countIfAccUserExists > 0 or $defaultPhone == $phones)
		{
			echo'Opps! user '.$userName.' with '.$phones.' is already in group '.$lastAccountName.'<br/>';
		}
		else
		{

			// 3 join the user with an account
			$sql7 = $db->query("INSERT INTO `account_user`(`accountID`, `userID`)
							VALUES ('$lastAccountId','$userId')") or die (mysqli_error());
			//// START SMS ////
		require_once('../classes/sms/AfricasTalkingGateway.php');
		$username   = "cmuhirwa";
		$apikey     = "17700797afea22a08117262181f93ac84cdcd5e43a268e84b94ac873a4f97404";
		$recipients = '+25'.$phones;
		$message    = 'Hello! You have been invited by '.$adminName.' to join Ikimina called: '.$groupName.' on U+. To Join/Reject or more info visit: http://uplus.16mb.com';
		// Specify your AfricasTalking shortCode or sender id
		$from = "uplus";

		$gateway    = new AfricasTalkingGateway($username, $apikey);
		try
		{

		   $results = $gateway->sendMessage($recipients, $message, $from);

		  foreach($results as $result) {
		   // echo " Number: " .$result->number;
		   // echo " Status: " .$result->status;
		   // echo " MessageId: " .$result->messageId;
		   // echo " Cost: "   .$result->cost."\n";
		  }
		}
		catch ( AfricasTalkingGatewayException $e )
		{
		  echo "Encountered an error while sending SMS invitation to ".$phones."<br> ".$e->getMessage();
		}
		
	  echo "<a href='home'>Done, Connection established for ".$phones." click here.</a>";
	  //// END SMS ////

	  }
	 
	}


}

// 3.b TIGHT Get the phones and submit in the db TIGHT
if (isset($_GET["inviteTightPhone"]))
{
	$groupDesc 		= $_SESSION["groupDesc"];
	$groupName 		= $_SESSION["groupName"];
	$custommessage	= $_GET["custommessage"];
	$defaultPhone	= $_SESSION["adminPhone"];
	$thisid 		= $_SESSION['thisId'];
	$phones 		= $_GET["inviteTightPhone"];
	$adminName 		= $_SESSION["adminName"];
	$bankaccount 	= $_SESSION["bankaccount"];
	$tightBank 	= $_SESSION["tightbank"];
	$groupType 	= $_SESSION["groupType"];
	
	
	include "../db.php";

	if($phones == 0000)
	{	
		// 1 add the account with the phone
		$sql = $db->query("INSERT INTO accounts(groupType, accName, adminPhone, adminName, groupDesc, bankaccount)
		VALUES ('TIGHT', '$groupName','$defaultPhone','$adminName', '$groupDesc', '$bankaccount')")or die (mysqli_error());
	
		// 2 GRAB ACCONT ID
		$sqlgetlstaccount = $db->query("SELECT id, accName FROM accounts order by id desc limit 1")or die (mysqli_error());
		$fetchaccountId = mysqli_fetch_array($sqlgetlstaccount);
		$lastAccountId = $fetchaccountId['id'];
		$lastAccountName = $fetchaccountId['accName'];

		
		
		// 3 START GO TO ADD THE ACCOUNT TO RTGS 3//////////////////////////////////////////////3
			//////////////////////////////////////////////////////////////////////
				$outCon = mysqli_connect("localhost", "uplus_uplus", "clement123" , "uplus_rtgs");
				//START CHECK IF THE SENDER IS NOT NEW
					$sqlCheckExist = $outCon -> query("SELECT * FROM bank_accounts WHERE accountNumber ='$Weddingbankaccount' AND bankId ='$Weddingbank' limit 1");
					$countExistAccount = mysqli_num_rows($sqlCheckExist);
					if(!$countExistAccount > 0){
					// START INSERT THE ACCOUNT  	
						$sql = $outCon->query("insert into clients(name) values('$groupName')");
						$sqllaststu= $outCon->query("select id from clients order by id desc limit 1");
						$laststu_id=$row=mysqli_fetch_array($sqllaststu);
						$client_id=$row['id'];
						$sqlsklstu= $outCon->query("insert into bank_client(client_id, bank_id, accountNumber) 
						  values('$client_id','$Weddingbank','$Weddingbankaccount')")or mysqli_error();
					// END INSERT THE ACCOUNT
					$conectGroupBank = $outCon->query("insert into group_bank (accountNumber, groupId) VALUES ('$Weddingbankaccount','$lastAccountId')");
					echo'Collection Account created<br/>';
					}
					else{
						echo'
						accountNumber: '.$Weddingbankaccount.' <br/>
						bankName: '.$Weddingbank.'<br/>
						Cleint: '.$groupName;
					}
		
			/////////////////////////////////////////////////////////////////
		//3 END GO TO ADD THE ACCOUNT TO RTGS 3///////////////////////////////////////////////////
		
		
		
		// ADMIN FIRST (Send me an invitation first)
		$sqladmininvitation = $db->query("INSERT INTO `account_user`(`accountID`, `userID`) VALUES ('$lastAccountId','$thisid')") or die (mysqli_error());

		// EXCEL BULK INVITATIONS
		include ("../classes/PHPExcel/IOFactory.php");
		$objPHPExcel = PHPExcel_IOFactory::load('../docs/contacts.xls');
		$n=0;
		$nsms=0;
		$nofexcelcontacts=0;
		echo"<h4>Status</h4>";
		
		// LOOP BULK CONTACTS: 1.INSERTING NEW, 2.CONNECTING TO THE ACCOUNT, 3.SENDING EMAILS 
		foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
	{
		$highestRow = $worksheet->getHighestRow();
		for ($row=2; $row<=$highestRow; $row++)
		{

		$nofexcelcontacts++;
		   $names = mysqli_real_escape_string($db, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
		   $phone = mysqli_real_escape_string($db, $worksheet->getCellByColumnAndRow(1, $row)->getValue());

			// 2 Check if the inveted user is new
			$sqlcheckifuserexists = $db->query("SELECT id, name FROM users WHERE phone = '$phone'")or die (mysqli_error());
			$checkuser = mysqli_num_rows($sqlcheckifuserexists);
		if($checkuser > 0)
		{
			$fetchCheckedUser = mysqli_fetch_array($sqlcheckifuserexists);
			$userId = $fetchCheckedUser['id'];
			$userName = $fetchCheckedUser['name'];
		}
		else
		{
			$sqlsaveexcel = $db->query ("INSERT INTO users (phone, name) VALUES ('$phone', '$names')")or die (mysqli_error());

			// 2.1 grab that id
			$sqlgetuserId = $db->query("SELECT id, name from users where phone = '$phone'");
			$fetchuserId = mysqli_fetch_array($sqlgetuserId);
			$userId = $fetchuserId['id'];
			$userName = $fetchuserId['name'];
		}
		
		//2.2 Check if the user is not already in the group
		$sqlCheckAccount_User = $db->query("SELECT * FROM account_user WHERE accountID ='$lastAccountId' and userId='$userId'");
		$countIfAccUserExists = mysqli_num_rows($sqlCheckAccount_User);
		if($countIfAccUserExists > 0)
		{
			echo'Opps! user '.$userName.' with '.$phone.' is already in group '.$lastAccountName.'<br/>';
		}
		else
		{

			// 3 join the user with an account
			$sql7 = $db->query("INSERT INTO `account_user`(`accountID`, `userID`)
							VALUES ('$lastAccountId','$userId')") or die (mysqli_error());

							$n++;
			//// START SMS ////
		require_once('../classes/sms/AfricasTalkingGateway.php');
		$username   = "cmuhirwa";
		$apikey     = "17700797afea22a08117262181f93ac84cdcd5e43a268e84b94ac873a4f97404";
		$recipients = '+25'.$phone;
		$message    = 'From '.$groupName.', '.$custommessage.' (http://uplus.16mb.com)';
		
		
		// Specify your AfricasTalking shortCode or sender id
		$from = "uplus";

		$gateway    = new AfricasTalkingGateway($username, $apikey);
		$nsms;
		try
		{

		   $results = $gateway->sendMessage($recipients, $message, $from);

		  foreach($results as $result) {
		   // echo " Number: " .$result->number;
		   // echo " Status: " .$result->status;
		   // echo " MessageId: " .$result->messageId;
		   // echo " Cost: "   .$result->cost."\n";
		  }
		}
		catch ( AfricasTalkingGatewayException $e )
		{
		  echo "Encountered an error while sending invitation to ".$phone."<br> ".$e->getMessage();
		}
		//// END SMS ////


		}
	  }
	  echo "<a href='editCont".$lastAccountId."'>Done, Connection established for ".$n." members and 
	  SMS Invitation sent to ".$nsms." contacts
	  out of ".$nofexcelcontacts." click here.</a>";
	}
	
	// DELETE UPLOADED EXCEL CONTACT FILE
	$data="contacts.xls";    
	$dir = "../docs";    
	$dirHandle = opendir($dir);    
	while ($file = readdir($dirHandle)) {    
		if($file==$data) {
			unlink($dir."/".$file);//give correct path,
		}
	}    
	closedir($dirHandle);
	// END DELETE UPLOADED EXCEL CONTACT FILE
}
	else{
		
		// 1 add the account with the phone
		$sql = $db->query("INSERT INTO accounts(groupType, accName, adminPhone, adminName, groupDesc, bankaccount, groupBank)
		VALUES ('TIGHT', '$groupName','$defaultPhone','$adminName', '$groupDesc', '$bankaccount', '$tightBank')")or die (mysqli_error());
	
		// 2 GRAB ACCONT ID
		$sqlgetlstaccount = $db->query("SELECT id, accName FROM accounts order by id desc limit 1")or die (mysqli_error());
		$fetchaccountId = mysqli_fetch_array($sqlgetlstaccount);
		$lastAccountId = $fetchaccountId['id'];
		$lastAccountName = $fetchaccountId['accName'];

		// 3 START GO TO ADD THE ACCOUNT TO RTGS 3//////////////////////////////////////////////3
			//////////////////////////////////////////////////////////////////////
				$outCon = mysqli_connect("localhost", "uplus_uplus", "clement123" , "uplus_rtgs");
				//START CHECK IF THE SENDER IS NOT NEW
					$sqlCheckExist = $outCon -> query("SELECT * FROM bank_accounts WHERE accountNumber ='$Weddingbankaccount' AND bankId ='$Weddingbank' limit 1");
					$countExistAccount = mysqli_num_rows($sqlCheckExist);
					if(!$countExistAccount > 0){
					// START INSERT THE ACCOUNT  	
						$sql = $outCon->query("insert into clients(name) values('$groupName')");
						$sqllaststu= $outCon->query("select id from clients order by id desc limit 1");
						$laststu_id=$row=mysqli_fetch_array($sqllaststu);
						$client_id=$row['id'];
						$sqlsklstu= $outCon->query("insert into bank_client(client_id, bank_id, accountNumber) 
						  values('$client_id','$Weddingbank','$Weddingbankaccount')")or mysqli_error();
					// END INSERT THE ACCOUNT
					$conectGroupBank = $outCon->query("insert into group_bank (accountNumber, groupId) VALUES ('$Weddingbankaccount','$lastAccountId')");
					echo'Collection Account created<br/>';
					}
					else{
						echo'
						accountNumber: '.$Weddingbankaccount.' <br/>
						bankName: '.$Weddingbank.'<br/>
						Cleint: '.$groupName;
					}
		
			/////////////////////////////////////////////////////////////////
		//3 END GO TO ADD THE ACCOUNT TO RTGS 3///////////////////////////////////////////////////


		// 2 Check if the inveted user is new
		$sqlcheckifuserexists = $db->query("SELECT id, name FROM users WHERE phone = '$phones'")or die (mysqli_error());
		$checkuser = mysqli_num_rows($sqlcheckifuserexists);
		if($checkuser > 0)
		{
			$fetchCheckedUser = mysqli_fetch_array($sqlcheckifuserexists);
			$userId = $fetchCheckedUser['id'];
			$userName = $fetchCheckedUser['name'];
		}
		else
		{
			$sqlsaveexcel = $db->query ("INSERT INTO users (phone) VALUES ('$phones')")or die (mysqli_error());

			// 2.1 grab that id
			$sqlgetuserId = $db->query("SELECT id, name from users where phone = '$phones'");
			$fetchuserId = mysqli_fetch_array($sqlgetuserId);
			$userId = $fetchuserId['id'];
			$userName = $fetchuserId['name'];
		}
		// 2.2 Join ADMIN FIRST (Send me an invitation first)
		$sqladmininvitation = $db->query("INSERT INTO `account_user`(`accountID`, `userID`) VALUES ('$lastAccountId','$thisid')") or die (mysqli_error());
		// 2.3 
		$sql7 = $db->query("INSERT INTO `account_user`(`accountID`, `userID`)
						VALUES ('$lastAccountId','$userId')") or die (mysqli_error());
		//// START SMS ////
		require_once('../classes/sms/AfricasTalkingGateway.php');
		$username   = "cmuhirwa";
		$apikey     = "17700797afea22a08117262181f93ac84cdcd5e43a268e84b94ac873a4f97404";
		$recipients = '+25'.$phones;
		$message    = 'From '.$groupName.', '.$custommessage.' (http://uplus.16mb.com)';
		// Specify your AfricasTalking shortCode or sender id
		$from = "uplus";

		$gateway    = new AfricasTalkingGateway($username, $apikey);
		try
		{

		   $results = $gateway->sendMessage($recipients, $message, $from);

		  foreach($results as $result) {
		   // echo " Number: " .$result->number;
		   // echo " Status: " .$result->status;
		   // echo " MessageId: " .$result->messageId;
		   // echo " Cost: "   .$result->cost."\n";
		  }
		}
		catch ( AfricasTalkingGatewayException $e )
		{
		  echo "Encountered an error while sending SMS invitation to ".$phones."<br> ".$e->getMessage();
		}
		
	  echo "<a href='editgroup'>Done, Connection established for ".$phones." click here.</a>";
	  //// END SMS ////

	}

}

// 3.c WEDDING Get the phones and submit in the db WEDDING
if (isset($_GET["inviteWeddingPhone"]))
{

	$phones 			= $_GET["inviteWeddingPhone"];
	$replymessage 		= $_GET["replymessage"];
	$custommessage 		= $_GET["custommessage"];
	$groupDesc 			= $_SESSION["groupDesc"];
	$groupName 			= $_SESSION["groupName"];
	$defaultPhone		= $_SESSION["adminPhone"];
	$thisid 			= $_SESSION['thisId'];
	$adminName 			= $_SESSION["adminName"];
	$WeedingAmount 		= $_SESSION["WeedingAmount"];
	$WeddingDate 		= $_SESSION["WeddingDate"];
	$Weddingbank 		= $_SESSION["Weddingbank"];
	$Weddingbankaccount = $_SESSION["Weddingbankaccount"];
	
	
	
	include "../db.php";

	// 1 add the account with the phone
	$sql = $db->query("INSERT INTO accounts
	
	(groupType, accName, adminPhone, adminName, groupDesc, 
		bankaccount, groupBank, opening, saving, custommessage, replymessage, createdDate)
		VALUES 
	('WEDDING', '$groupName','$defaultPhone','$adminName', '$groupDesc',
		'$Weddingbankaccount', '$Weddingbank', '$WeddingDate', '$WeedingAmount', '$custommessage', '$replymessage',now())
	")or die (mysqli_error());

		// 2 GRAB ACCONT ID
		$sqlgetlstaccount = $db->query("SELECT id, accName FROM accounts order by id desc limit 1")or die (mysqli_error());
		$fetchaccountId = mysqli_fetch_array($sqlgetlstaccount);
		$lastAccountId = $fetchaccountId['id'];
		$lastAccountName = $fetchaccountId['accName'];

		// 3 START GO TO ADD THE ACCOUNT TO RTGS 3//////////////////////////////////////////////3
			//////////////////////////////////////////////////////////////////////
				$outCon = mysqli_connect("localhost", "uplus_uplus", "clement123" , "uplus_rtgs");
				//START CHECK IF THE SENDER IS NOT NEW
					$sqlCheckExist = $outCon -> query("SELECT * FROM bank_accounts WHERE accountNumber ='$Weddingbankaccount' AND bankId ='$Weddingbank' limit 1");
					$countExistAccount = mysqli_num_rows($sqlCheckExist);
					if(!$countExistAccount > 0){
					// START INSERT THE ACCOUNT  	
						$sql = $outCon->query("insert into clients(name) values('$groupName')");
						$sqllaststu= $outCon->query("select id from clients order by id desc limit 1");
						$laststu_id=$row=mysqli_fetch_array($sqllaststu);
						$client_id=$row['id'];
						$sqlsklstu= $outCon->query("insert into bank_client(client_id, bank_id, accountNumber) 
						  values('$client_id','$Weddingbank','$Weddingbankaccount')")or mysqli_error();
					// END INSERT THE ACCOUNT
					$conectGroupBank = $outCon->query("insert into group_bank (accountId, groupId) VALUES ('$Weddingbankaccount','$lastAccountId')");
					echo 'accountNumber: '.$Weddingbankaccount.' and bankName: '.$lastAccountId.', Collection Account created<br/>';
					}
					else{
						echo'
						accountNumber: '.$Weddingbankaccount.' <br/>
						bankName: '.$Weddingbank.'<br/>
						Cleint: '.$groupName;
					}
		
			/////////////////////////////////////////////////////////////////
		//3 END GO TO ADD THE ACCOUNT TO RTGS 3///////////////////////////////////////////////////
	
	//2.3 Join ADMIN FIRST (Send me an invitation first)
		$sqladmininvitation = $db->query("INSERT INTO `account_user`(`accountID`, `userID`, acceptance) VALUES ('$lastAccountId','$thisid', 'yes')") or die (mysqli_error());
		

	if($phones == 0000)
	{	
		// EXCEL BULK INVITATIONS
		include ("../classes/PHPExcel/IOFactory.php");
		$objPHPExcel = PHPExcel_IOFactory::load('../docs/contacts.xls');
		$n=0;
		$nsms=0;
		$nofexcelcontacts=0;
		echo"<h4>Status</h4>";
		
		// LOOP BULK CONTACTS: 1.INSERTING NEW, 2.CONNECTING TO THE ACCOUNT, 3.SENDING EMAILS 
		foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
	{
		$highestRow = $worksheet->getHighestRow();
		for ($row=2; $row<=$highestRow; $row++)
		{

		$nofexcelcontacts++;
		   $names = mysqli_real_escape_string($db, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
		   $phone = mysqli_real_escape_string($db, $worksheet->getCellByColumnAndRow(1, $row)->getValue());

			// 2 Check if the inveted user is new
			$sqlcheckifuserexists = $db->query("SELECT id, name FROM users WHERE phone = '$phone'")or die (mysqli_error());
			$checkuser = mysqli_num_rows($sqlcheckifuserexists);
		if($checkuser > 0)
		{
			$fetchCheckedUser = mysqli_fetch_array($sqlcheckifuserexists);
			$userId = $fetchCheckedUser['id'];
			$userName = $fetchCheckedUser['name'];
		}
		else
		{
			$sqlsaveexcel = $db->query ("INSERT INTO users (phone, name) VALUES ('$phone', '$names')")or die (mysqli_error());

			// 2.1 grab that id
			$sqlgetuserId = $db->query("SELECT id, name from users where phone = '$phone'");
			$fetchuserId = mysqli_fetch_array($sqlgetuserId);
			$userId = $fetchuserId['id'];
			$userName = $fetchuserId['name'];
		}
		
		//2.2 Check if the user is not already in the group
		$sqlCheckAccount_User = $db->query("SELECT * FROM account_user WHERE accountID ='$lastAccountId' and userId='$userId'");
		$countIfAccUserExists = mysqli_num_rows($sqlCheckAccount_User);
		if($countIfAccUserExists > 0)
		{
			echo'Opps! user '.$userName.' with '.$phone.' is already in group '.$lastAccountName.'<br/>';
		}
		else
		{

			// 3 join the user with an account
			$sql7 = $db->query("INSERT INTO `account_user`(`accountID`, `userID`, acceptance)
							VALUES ('$lastAccountId','$userId', 'yes')") or die (mysqli_error());

				$n++;			
			//// START SMS ////
		require_once('../classes/sms/AfricasTalkingGateway.php');
		$username   = "cmuhirwa";
		$apikey     = "17700797afea22a08117262181f93ac84cdcd5e43a268e84b94ac873a4f97404";
		$recipients = '+25'.$phone;
		$message    = $custommessage;
		
		
		// Specify your AfricasTalking shortCode or sender id
		$from = "uplus";

		$gateway    = new AfricasTalkingGateway($username, $apikey);
		try
		{

		   $results = $gateway->sendMessage($recipients, $message, $from);

		  foreach($results as $result) {
		   // echo " Number: " .$result->number;
		   // echo " Status: " .$result->status;
		   // echo " MessageId: " .$result->messageId;
		   // echo " Cost: "   .$result->cost."\n";
		   $nsms;
		
		  }
		}
		catch ( AfricasTalkingGatewayException $e )
		{
		  echo "Encountered an error while sending invitation to ".$phone."<br> ".$e->getMessage();
		}
		//// END SMS ////


		}
	  }
	  $nn = $n+1;
	  echo "<br/><a href='editCont".$lastAccountId."'><h4>Done, Connection established for ".$nn." members and 
	  SMS Invitation sent to <mark>".$nsms." contacts
	  out of ".$nofexcelcontacts."</mark> click here.</h4></a>";
	}
	
	// DELETE UPLOADED EXCEL CONTACT FILE
	$data="contacts.xls";    
	$dir = "../docs";    
	$dirHandle = opendir($dir);    
	while ($file = readdir($dirHandle)) {    
		if($file==$data) {
			unlink($dir."/".$file);//give correct path,
		}
	}    
	closedir($dirHandle);
	// END DELETE UPLOADED EXCEL CONTACT FILE
}
else{
		
		// 2 Check if the inveted user is new
		$sqlcheckifuserexists = $db->query("SELECT id, name FROM users WHERE phone = '$phones'")or die (mysqli_error());
		$checkuser = mysqli_num_rows($sqlcheckifuserexists);
		if($checkuser > 0)
		{
			$fetchCheckedUser = mysqli_fetch_array($sqlcheckifuserexists);
			$userId = $fetchCheckedUser['id'];
			$userName = $fetchCheckedUser['name'];
		}
		else
		{
			$sqlsaveexcel = $db->query ("INSERT INTO users (phone) VALUES ('$phones')")or die (mysqli_error());

			// 2.1 grab that id
			$sqlgetuserId = $db->query("SELECT id, name from users where phone = '$phones'");
			$fetchuserId = mysqli_fetch_array($sqlgetuserId);
			$userId = $fetchuserId['id'];
			$userName = $fetchuserId['name'];
		}
		
		// 3
		$sql7 = $db->query("INSERT INTO `account_user`(`accountID`, `userID`, acceptance)
						VALUES ('$lastAccountId','$userId', 'yes')") or die (mysqli_error());
			//// START SMS ////
		require_once('../classes/sms/AfricasTalkingGateway.php');
		$username   = "cmuhirwa";
		$apikey     = "17700797afea22a08117262181f93ac84cdcd5e43a268e84b94ac873a4f97404";
		$recipients = '+25'.$phones;
		$message    = $custommessage;
		// Specify your AfricasTalking shortCode or sender id
		$from = "uplus";

		$gateway    = new AfricasTalkingGateway($username, $apikey);
		try
		{

		   $results = $gateway->sendMessage($recipients, $message, $from);

		  foreach($results as $result) {
		   // echo " Number: " .$result->number;
		   // echo " Status: " .$result->status;
		   // echo " MessageId: " .$result->messageId;
		   // echo " Cost: "   .$result->cost."\n";
		  }
		}
		catch ( AfricasTalkingGatewayException $e )
		{
		  echo "Encountered an error while sending SMS invitation to ".$phones."<br> ".$e->getMessage();
		}
		
	  echo "<a href='editCont".$lastAccountId."'>Done, Connection established for ".$phones." click here.</a>";
	  //// END SMS ////

	}
}


// 3.d INVESTMENT Get the phones and submit in the db WEDDING
if (isset($_GET["inviteInvestorPhone"]))
{
	$groupName 			= $_SESSION["groupName"];
	$defaultPhone		= $_SESSION["adminPhone"];
	$adminName 			= $_SESSION["adminName"];
	$groupDesc 			= $_SESSION["groupDesc"];
	$bankaccount 		= $_SESSION["invesTbankaccount"];
	$contribution   	= $_SESSION['totalShares'];
	$transactionDate	= $_SESSION['offerDate'];
	$ashare				= $_SESSION['ashare'];
	$thisid 			= $_SESSION['thisId'];
	$phones 			= $_GET["inviteInvestorPhone"];

	include "../db.php";

	// 1 add the account with the phone
	$sql = $db->query("INSERT INTO accounts(groupType, accName, adminPhone, adminName, groupDesc, bankaccount, contribution, transactionDate, periodes)
	VALUES ('INVESTMENT', '$groupName','$defaultPhone','$adminName', '$groupDesc', '$bankaccount', '$contribution', '$transactionDate', '$ashare')")or die (mysqli_error());

	// 1.2 grab that id
	$sql2 = $db->query("SELECT * FROM accounts order by id desc limit 1")or die (mysqli_error());
	while($row = mysqli_fetch_array($sql2)){
		$lastId = $row['id'];
	}
	// 2 add the user
	$sql3 = $db->query("SELECT * FROM users WHERE phone = '$phones'")or die (mysqli_error());
	$sql4 = mysqli_num_rows($sql3);
	if($sql4 > 0)
	{
		while($row = mysqli_fetch_array($sql3))
		{
			$userId = $row['id'];
		}
	}
	else
	{
		// 2.0.1 Add the invited member
		$sql5 = $db->query("INSERT INTO `users`(phone) VALUES ('$phones')")or die (mysqli_error());
		// 2.1 grab that id
		$sql6 = $db->query("SELECT * FROM accounts order by id desc limit 1")or die (mysqli_error());
		while($row = mysqli_fetch_array($sql6))
		{
			$userId = $row['id'];
		}
	}
	// 3 join the user with an account
	$sql7 = $db->query("INSERT INTO `account_user`(`accountID`, `userID`) VALUES ('$lastId','$userId')") or die (mysqli_error());
	$sql8 = $db->query("INSERT INTO `account_user`(`accountID`, `userID`) VALUES ('$lastId','$thisid')") or die (mysqli_error());


	echo'Done click <a href="test.php">Here!</>';

}
?>



<script>
// 3 Get the phones to be invited Pass them to Be Inserted in the DB and Return Done	
function finishGroup(){	
	var step = document.getElementById('step').value;
	//alert (step);
	// 3.a IKIMINA  Get the phones, Pass them and Return Done IKIMINA
	if(step == '3aIkiminaInvite')
	{
		var invitePhone = document.getElementById('invitePhone').value;
		  if (invitePhone == null || invitePhone == "") 
		  {
				alert("invitePhone must be filled out");
				return false;
			}
			
		document.getElementById('stepFill').innerHTML = '<input id="step" hidden value="done">';
		document.getElementById('invite').innerHTML = '<div style="padding-left:40%;padding-bottom:40px;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
		  $.ajax({
			  type : "GET",
			  url : "scripts/newgroup.php",
			  dataType : "html",
			  cache : "false",
			  data : {
				invitePhone : invitePhone
			  },
			  success : function(html, textStatus){
				$("#invite").html(html);
			  },
			  error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			  }
		  });
	}

	
	// 3.b TIGHT Get the phones, pass them and in the db TIGHT
	else if(step == '3bTitheInvite')
	{
		var inviteTightPhone = document.getElementById('invitePhone').value;
	  if (inviteTightPhone == null || inviteTightPhone == "") 
	  {
		  //  alert("inviteTightPhone must be filled out");
		   // return false;
		}
		var custommessage = document.getElementById('custommessage').value;
	  if (custommessage == null || custommessage == "") 
	  {
		    alert("custommessage must be filled out");
		   return false;
		}
	document.getElementById('stepFill').innerHTML = '<input id="step" hidden value="done">';
	document.getElementById('invite').innerHTML = '<div style="padding-left:40%;padding-bottom:40px;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
	   $.ajax({
		  type : "GET",
		  url : "scripts/newgroup.php",
		  dataType : "html",
		  cache : "false",
		  data : {
			
			inviteTightPhone : inviteTightPhone,
			custommessage : custommessage,
		  },
		  success : function(html, textStatus){
			$("#invite").html(html);
		  },
		  error : function(xht, textStatus, errorThrown){
			alert("Error : " + errorThrown);
		  }
	  });

	}

	// 3.c Wedding Get the phones, pass them and in the db TIGHT
	else if(step == '3cWeedingInvite')
	{
		//alert('working on it');
		var inviteWeddingPhone = document.getElementById('invitePhone').value;
		  if (inviteWeddingPhone == null || inviteWeddingPhone == "") 
		  {
				alert("inviteWeddingPhone must be filled out");
				return false;
			}
		//alert(inviteWeddingPhone);
		var custommessage = document.getElementById('custommessage').value;
		  if (custommessage == null || custommessage == "") 
		  {
				alert("custommessage must be filled out");
				return false;
			}
		//alert(inviteWeddingPhone);
		var replymessage = document.getElementById('replymessage').value;
		  if (replymessage == null || replymessage == "") 
		  {
				alert("replymessage must be filled out");
				return false;
			}
		
		
		
		//alert(replymessage);
		document.getElementById('stepFill').innerHTML = '<input id="step" hidden value="done">';
		document.getElementById('invite').innerHTML = '<div style="padding-left:40%;padding-bottom:40px;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
		  
		  $.ajax({
			  type : "GET",
			  url : "scripts/newgroup.php",
			  dataType : "html",
			  cache : "false",
			  data : {
				
				inviteWeddingPhone : inviteWeddingPhone,
				replymessage : replymessage,
				custommessage : custommessage
			  },
			  success : function(html, textStatus){
				$("#invite").html(html);
			  },
			  error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			  }
		  });
	}

	// 3.d INVESTMENT Get the phones, pass them and in the db TIGHT
	else if(step == '3dInvestmentInvite')
	{
		 var inviteInvestorPhone = document.getElementById('inviteInvestorPhone').value;
		  if (inviteInvestorPhone == null || inviteInvestorPhone == "") 
		  {
				alert("inviteInvestorPhone must be filled out");
				return false;
			}
		document.getElementById('stepFill').innerHTML = '<input id="step" hidden value="done">';
		document.getElementById('invite').innerHTML = '<div style="padding-left:40%;padding-bottom:40px;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
		  
		  $.ajax({
			  type : "GET",
			  url : "scripts/newgroup.php",
			  dataType : "html",
			  cache : "false",
			  data : {
				
				inviteInvestorPhone : inviteInvestorPhone
			  },
			  success : function(html, textStatus){
				$("#invite").html(html);
			  },
			  error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			  }
		  });
	}

	else if(step == 'done')
	{
		document.getElementById('invite').innerHTML = 'Thanks! you have already finished creating your Group, and members have seen your invitation on their phones through SMS, We wish you all the success with your group members on U+.<br>Now <a href="test.php"> click here to get started</a>';
		 function Redirect() {
		   window.location="test.php";
		}
		setTimeout('Redirect()', 5000);
	}
}
/////////////////////////////////////////////////////////////	

	
function backtoaccounts(){
	var step = document.getElementById('step').value;
	//alert (step);
	if(step == 'info')
	{
		document.getElementById('stepFill').innerHTML = '<input id="step" hidden value="info">';
	}
	else if(step == '2aIkiminaFinance')
	{
		document.getElementById('stepFill').innerHTML = '<input id="step" hidden value="info">';
	}
	else if(step == '2bContributionTitheFinance')
	{
		document.getElementById('stepFill').innerHTML = '<input id="step" hidden value="info">';
	}
	else if(step == '2cContributionWedding')
	{
		document.getElementById('stepFill').innerHTML = '<input id="step" hidden value="info">';
	}
	else if(step == '2dInvestmentFinance')
	{
		document.getElementById('stepFill').innerHTML = '<input id="step" hidden value="info">';
	}
	else if(step == '3aIkiminaInvite')
	{
		document.getElementById('stepFill').innerHTML = '<input id="step" hidden value="2aIkiminaFinance">';
	}
	else if(step == '3bTitheInvite')
	{
		document.getElementById('stepFill').innerHTML = '<input id="step" hidden value="2bContributionTitheFinance">';
	}
	else if(step == '3cWeedingInvite')
	{
		document.getElementById('stepFill').innerHTML = '<input id="step" hidden value="2cContributionWedding">';
	}
	else if(step == '3dInvestmentInvite')
	{
		document.getElementById('stepFill').innerHTML = '<input id="step" hidden value="2dInvestmentFinance">';
	}

	
}	
	
// Change the shares
	function getShares(){
		var investmentAmount = document.getElementById('investmentAmount').value;
		var totalShares = document.getElementById('totalShares').value;
		var newshare = investmentAmount / totalShares;
		
		document.getElementById('pershare').innerHTML = '<label class="control-label margin-bottom-15" for="ashare">1 Share:</label><input type="number" class="form-control round" id="ashare"  value="'+newshare+'" disabled><br/>';
 
	}

</script>