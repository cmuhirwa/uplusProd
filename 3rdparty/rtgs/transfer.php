<div style="text-align: center;padding-top:10px; color: #fff; text-shadow: 1px 1px 2px #000000;">

<h5>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
	
include "db.php";
if (isset($_GET['sentAmount'])) {
	$forGroupId		= 	$_GET['forGroupId'];		// COmpanyID
	$sentAmount		= 	$_GET['sentAmount'];		// Amount
	$sendFromAccoun = 	$_GET['sendFromAccount'];	// From Phone1
	$sendFromName	= 	$_GET['sendFromName'];		// From Name
	$sendFromBank	= 	$_GET['sendFromBank'];		// To Bank
	$sendToBank		=	$_GET['sendToBank'];		// To Bank
	$sendToAccoun	=	$_GET['sendToAccount'];		// To Phone1
	$sendFromAccount=	'0'.$sendFromAccoun.'';		// Add 0
	$sendToAccount	=	$sendToAccoun;
	
	// For API
	$amount = $sentAmount;
	$phone1 = $_GET['phone1'];
	$phone2 = $_GET['phone2'];
	// For API

	
	//echo 'sentAmount:'.$sentAmount.'<br>forGroupId:'.$forGroupId.'<br>sendFromAccount:
	//'.$sendFromAccount.'<br>sendFromBank:'.$sendFromBank.'<br>sendToBank:'.$sendToBank.'<br>sendToAccount:'.$sendToAccount.'';
	

//START GET RECIEVER'S INFO
	$sqlGetReceiverInfo = $con -> query("SELECT * FROM bank_accounts WHERE accountNumber ='$sendToAccount' AND bankId ='$sendToBank' limit 1");
	$rowSendTo		= 	mysqli_fetch_array($sqlGetReceiverInfo);
	$sendToBankId 	= 	$rowSendTo['bankId'];
	$sendToAccountId= 	$rowSendTo['accountId'];
	$sendToClientId = 	$rowSendTo['clientId'];
// END GET RECIEVER'S INFO

//START CHECK IF THE SENDER IS NOT NEW
	$sqlCheckSenderExist = $con -> query("SELECT * FROM bank_accounts WHERE accountNumber ='$sendFromAccount' AND bankId ='$sendFromBank' limit 1");
	$countExistSenderAccount = mysqli_num_rows($sqlCheckSenderExist);
  //START IF SENDER EXISTS
	if($countExistSenderAccount > 0){
	//START GET SENDER'S INFO
		$rowSendFrom 		= 	mysqli_fetch_array($sqlCheckSenderExist);
		$sendFromBankId		= 	$rowSendFrom['bankId'];
		$sendFromAccountId	=	$rowSendFrom['accountId'];
		$sendFromClientId 	= 	$rowSendFrom['clientId'];
	//END GET SENDER'S INFO
	
	
	// START DEBIT THE SENDER
		$sqlRemoveAmount= $con->query("INSERT INTO transactions(forGroupId,amount,account_id,bank_id,client_id,operation,to_from_client,to_from_bank,to_from_account, status, 3rdparty) 
										VALUES('$forGroupId','$sentAmount','$sendFromAccountId','$sendFromBankId','$sendFromClientId','debit','$sendToClientId','$sendToBankId','$sendToAccountId', 'called', 'TORQUE')") or mysqli_error();
		$sqlRemovedId= $con->query("select id from transactions order by id desc limit 1");
		$remId = mysqli_fetch_array($sqlRemovedId);
		$fromTransactionId =$remId['id'];
		
	// END DEBIT THE SENDER	
	
	// START CREDIT THE RECIEVER
		$sqlAddAmount= $con->query("INSERT INTO transactions(forGroupId,amount,account_id,bank_id,client_id,operation,to_from_client,to_from_bank,to_from_account, status, 3rdparty) 
										VALUES('$forGroupId','$sentAmount','$sendToAccountId','$sendToBankId','$sendToClientId','credit','$sendFromClientId','$sendFromBankId','$sendFromAccountId', 'called', 'TORQUE')") or mysqli_error();
		$sqlAddId= $con->query("select id from transactions order by id desc limit 1");
		$AddId =mysqli_fetch_array($sqlAddId);
		$ToTransactionId =$AddId['id'];
	// END CREDIT THE RECIEVER
	 
	}	
	//START ELSE SENDER IS NEW
	else{
		$sql = $con->query("insert into clients(name) values('$sendFromName')");
		$sqllaststu= $con->query("select id from clients order by id desc limit 1");
		$laststu_id=$row=mysqli_fetch_array($sqllaststu);
		$client_id=$row['id'];
		$sqlsklstu= $con->query("insert into bank_client(client_id, bank_id, accountNumber) 
		  values('$client_id','$sendFromBank','$sendFromAccount')")or mysqli_error();
		
		$sqllastAccount= $con->query("SELECT * FROM bank_accounts WHERE accountNumber ='$sendFromAccount' AND bankId ='$sendFromBank' limit 1");
		$laststa_id= $rowSendFrom = mysqli_fetch_array($sqllastAccount);
		$sendFromBankId		= 	$rowSendFrom['bankId'];
		$sendFromAccountId	=	$rowSendFrom['accountId'];
		$sendFromClientId 	= 	$rowSendFrom['clientId'];

		
	// START DEBIT THE SENDER
		$sqlRemoveAmount= $con->query("INSERT INTO transactions(forGroupId,amount,account_id,bank_id,client_id,operation,to_from_client,to_from_bank,to_from_account, status, 3rdparty) 
										VALUES('$forGroupId','$sentAmount','$sendFromAccountId','$sendFromBankId','$sendFromClientId','debit','$sendToClientId','$sendToBankId','$sendToAccountId', 'called', 'TORQUE')") or mysqli_error();
		$sqlRemovedId= $con->query("select id from transactions order by id desc limit 1");
		$remId = mysqli_fetch_array($sqlRemovedId);
		$fromTransactionId =$remId['id'];
		
	// END DEBIT THE SENDER
	
		
	// START CREDIT THE RECIEVER
		$sqlAddAmount= $con->query("INSERT INTO transactions(forGroupId,amount,account_id,bank_id,client_id,operation,to_from_client,to_from_bank,to_from_account, status, 3rdparty) 
										VALUES('$forGroupId','$sentAmount','$sendToAccountId','$sendToBankId','$sendToClientId','credit','$sendFromClientId','$sendFromBankId','$sendFromAccountId', 'called', 'TORQUE')") or mysqli_error();
		$sqlAddId= $con->query("select id from transactions order by id desc limit 1");
		$AddId =mysqli_fetch_array($sqlAddId);
		$ToTransactionId =$AddId['id'];
	// END CREDIT THE RECIEVER
	}
// STRAT API HERE //////////////////////////
			
			$url = 'http://51.141.48.174:9000/requestpayment/';
	
	$data = array();
	$data["agentName"] = "UPLUS";
	$data["agentId"] = "0784848236";
	$data["phone"] = $phone1;
    $data["phone2"] = $phone2;
	$data["amount"] = $amount;
    $options = array(
		'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'POST',
			'content' => http_build_query($data)
		)
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	if ($result === FALSE) 
	{ 
		//var_dump($result);
		echo 'We are having some connectivity issue connecting to the 3rdparty.<br>
		Please try again.';	
	}else{
		$server_output = $result;
	
			// FROM JSON TO PHP
			$firstcheck = json_decode($server_output);
			$agentName = $firstcheck->{'agentName'};
			$balance = $firstcheck->{'balance'};
			$check1 = $firstcheck->{'information'};
			$check2 = $firstcheck->{'information2'};
			$transactionId1 = $firstcheck->{'transactionId'};
			
			// PUT THE RESPONSE IN SESSION SO THAT I CAN CALL IT'S STATUS
			session_start();
			$_SESSION["server_output"] 		= $server_output;
			$_SESSION["fromTransactionId"] 	= $fromTransactionId;
			$_SESSION["forGroupId"]			= $forGroupId;
			$_SESSION["ToTransactionId"] 	= $ToTransactionId;
	
			if($check1 == 'You sent invalid amounts. Error: 404.'){
				echo $agentName.' pull balance at Torque is: '.$balance;
			}
			else{
				$Update1= $con->query("UPDATE `transactions` SET status='$check1', 3rdpartyId='$transactionId1' WHERE id = '$fromTransactionId'");
				$Update2= $con->query("UPDATE `transactions` SET status='$check2', 3rdpartyId='$transactionId1' WHERE id = '$ToTransactionId'");
				// 1ST STATUS CONNECTED TO THE API WAITNING FOR MTN RESPONSE
			
				echo'<div id="returning">'.$check1.' <button class="btn btn-danger">Cancel</button></div>';
				
				// FIRE THE RECURRING CALL AFTER 5 SEC TO CHECK THE STATUS
				echo'
				<script>
					interval = setInterval(function() { checking();}, 10000);
					interval;
					stopcall = setInterval(
						function() { 
							stopit();
						}, 50000);
					stopcall;
				</script>';}
			
	}

}
// END API HERE /////////////////////////


// CHECK IF THE RESPONSE IS BACK
if(isset($_GET['check']))
{
	
	session_start();
	$server_output = $_SESSION["server_output"];
    $fromTransactionId 	= $_SESSION["fromTransactionId"];
	$ToTransactionId 	= $_SESSION["ToTransactionId"];
	$forGroupId			= $_SESSION["forGroupId"];

    $data = json_decode($server_output);
	$url = 'http://51.141.48.174:9000/requestpayment/';
	$options = array(
		'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'POST',
			'content' => http_build_query($data)
		)
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	if ($result === FALSE) 
	{ 
		var_dump($result);	
	}
	$server_results = $result;
	

		// CHANGE THE INFORMATION TO RESEND
	$_SESSION["server_output"] = $server_results;
		// DECODE THE RETURNED STATUS FROM PHONE 1 AND 2
	$obj = json_decode($server_results);
	$info1 	= $obj->{'information'};
	$info2 	= $obj->{'information2'};
	$amount	= $obj->{'amount'};
	$phone	= $obj->{'phone'};
	$phone2	= $obj->{'phone2'};
	$tosendtransid	= $obj->{'transactionId'};
	$Update1= $con->query("UPDATE `transactions` SET status='$info1' WHERE id = '$fromTransactionId'");
	$Update2= $con->query("UPDATE `transactions` SET status='$info2' WHERE id = '$ToTransactionId'");
	
	require_once('../../classes/sms/AfricasTalkingGateway.php');
	$username   = "cmuhirwa";
	$apikey     = "17700797afea22a08117262181f93ac84cdcd5e43a268e84b94ac873a4f97404";
	$recipients = '+250'.$phone;
	$from = "uplus";
	$sqlsmsget = $db->query("SELECT replymessage FROM accounts WHERE `id` = '$forGroupId'");
	$rowsms = mysqli_fetch_array($sqlsmsget);
	$tosendsms = $rowsms['replymessage'];
	
	
	if($info1 == 'REQUESTED')
		{
			echo'Please approve a request on your Phone</br>';
		}
	elseif($info1 == 'DECLINED')
		{
			?>
		<script>clearInterval(interval);</script>
					Sorry you just canceled, but its okay you can try again.</br>
					<button class="button" onClick="document.location.href='i<?php echo $forGroupId;?>'">Try Again</button>
				
		<?php
			$message    = 'You have just canceled a transfer of '.$amount.' to '.$phone2.', but you can still try again';// Specify your AfricasTalking shortCode or sender id
			$gateway    = new AfricasTalkingGateway($username, $apikey);
			try 
			{
				$results = $gateway->sendMessage($recipients, $message, $from);	
				foreach($results as $result) {}
			}
			catch ( AfricasTalkingGatewayException $e )
			{
				$results.="Encountered an error while sending: ".$e->getMessage();
			}
		}
	elseif($info1 == 'APPROVED')
		{
			$message    = $tosendsms.' with transaction id of '.tosendtransid;// Specify your AfricasTalking shortCode or sender id
			$gateway    = new AfricasTalkingGateway($username, $apikey);
			try 
			{
				$results = $gateway->sendMessage($recipients, $message, $from);	
				foreach($results as $result) {}
			}
			catch ( AfricasTalkingGatewayException $e )
			{
				$results.="Encountered an error while sending: ".$e->getMessage();
			}
			if($info2 == 'COMPLETE')
				{
					echo'<script>clearInterval(interval);</script> 
						Thanks The money has been received by '.$phone2.'. Status:'.$info2.'';
				}
			elseif($info2 == 'Error sending money.')
				{
					echo'<script>clearInterval(interval);</script>
						'.$info2.'
						<form action="feedback.php">
							The mobile destination you provided might not be in mobile money, 
							so we are going to return back your money after some fiew tries.  
							Please send us your feadback
							<textarea name="feadback"></textarea><br/>
							<input class="button" type="submit" value="send"/>
						</form>
						';
				}
			else{
					echo'<script>clearInterval(interval);</script>
						'.$info2;
				}
		}
	else
		{
			echo'<script>clearInterval(interval);</script>
				Something is not right.<br> 
				You might not have '.number_format($amount).' Rwf on your phone
				or, This 0'.$phone.'';?>
				is not registred in MTN Mobile Money Rwanda
				 <br>Try again if you think you made a mistake <br><button class="myButton" onClick="document.location.href='i<?php echo $forGroupId;?>'">Try again</button>
		<?php 
		}

}
?>

</h5>
</div>

<?php // VISA AND MASTER CARDS
if(isset($_POST['bkVisa'])){
	require __DIR__ . '/function.php';
	$amount = $_POST['field1'];
	$currency = $_POST['currency'];
	$orderInfo = 'ORDER34525';
	
	$accountData = array(
		'merchant_id' => 'TESTBOK000009',
		'access_code' => '325B081C',
		'secret'      => 'D566F4162F2D922E0B882BB551E11F7D'
	);
	if($currency=="RWF"){
		// $_PDT['vpc_Currency']=646;
		$mult = 1;
	}elseif($currency=="USD"){
		// $_PDT['vpc_Currency']=840;
		$mult = 100;
	}
	$queryData = array(
		'vpc_AccessCode' => $accountData['access_code'],
		'vpc_Merchant' => $accountData['merchant_id'],

		'vpc_Amount' => ($amount * $mult), // Multiplying by 100 to convert to the smallest unit
		'vpc_OrderInfo' => $orderInfo,

		'vpc_MerchTxnRef' => generateMerchTxnRef(), // See functions.php file

		'vpc_Command' => 'pay',
		'vpc_Currency' => $currency,
		'vpc_Locale' => 'en',
		'vpc_Version' => 1,
		'vpc_ReturnURL' => 'http://localhost/payments/bk/return_url.php',

		'vpc_SecureHashType' => 'SHA256'
	);

	// Add secure secret after hashing
	$queryData['vpc_SecureHash'] = generateSecureHash($accountData['secret'], $queryData); // See functions.php file

	// 
	$migsUrl = 'https://migs.mastercard.com.au/vpcpay?'.http_build_query($queryData);

	// Redirect to the bank website to continue the 
	header("Location: " . $migsUrl);

}
	
if(isset($_POST['stripeToken'])){
	session_start();
	$originalPhone = '784848236';
	$finalAmount = $_POST['Amount'];
	$rwAfterCharge = $_POST['rwAfterCharge'];
	$stripMNOAmount = $_POST['stripMNOAmount'];
	$Amount = $_POST['finalAmount'];
	$Currency = $_POST['Currency'];
	$forGroupId = $_POST['forGroupId'];
	$sendToAccount = $_POST['sendToAccount'];
	if($Currency == 'RWF'){
		$doneAmount = $finalAmount;
	}else{
		$doneAmount = $finalAmount*100;
	}
	$stripeFee = 2.9;
	$afterCharge 	= $Amount - ($Amount*$stripeFee/100);
	$usFee 	= $Amount*$stripeFee/100;
	
	
	require_once 'vendor/autoload.php';
	$stripe = [
		'publishable' => 'pk_test_2q9HFDV2QZ4dmmqYrBMJt6rW',
		'private' => 'sk_test_HTazixSC6RN8nUgQCUeqddmW',
	];
	Stripe::setApiKey($stripe['private']);

	$token = $_POST['stripeToken'];
	
	try{
		
		Stripe_Charge::create([
		  "amount" => $doneAmount,
		  "currency" => $Currency,
		  "source" => $token, 
		  "description" => "Take ".$finalAmount."".$Currency." Convert it into USD = $".$Amount." take out (".$stripeFee." Stripe Fee) = $".$usFee." giving ".$afterCharge.", And Rwf convert it into Rwf = ".$rwAfterCharge."Rwf , Then send it to ".$sendToAccount.""
		]);
		
		require_once('../../classes/sms/AfricasTalkingGateway.php');
		$username   = "cmuhirwa";
		$apikey     = "17700797afea22a08117262181f93ac84cdcd5e43a268e84b94ac873a4f97404";
		$recipients = '+250784848236';
		$message    = "Take ".number_format($finalAmount)."".$Currency." Convert it into USD = $".number_format(($Amount),2)." take out ".$stripeFee."% Stripe Fee($".number_format(($usFee),2).") giving $".round($afterCharge, 2).", And convert it into Rwf = ".$rwAfterCharge."Rwf , Then send it to ".$sendToAccount."";// Specify your AfricasTalking shortCode or sender id
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
			$results.="Encountered an error while sending: ".$e->getMessage();
		  }
		
		
	} catch(Stripe_CardError $e){
		// Do something with the error here
	}
	
	header('Location: ../../f/i'.$forGroupId.'');
	exit();
}
?>



