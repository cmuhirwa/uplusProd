<div style="text-align: center;padding-top:10px; color: #fff; text-shadow: 1px 1px 2px #000000;">

<h5>

<?php
include "db.php";
if (isset($_GET['sentAmount'])) {
	$forGroupId		= 	$_GET['forGroupId'];
	$sentAmount		= 	$_GET['sentAmount'];
	$sendFromAccoun = 	$_GET['sendFromAccount'];
	$sendFromBank	= 	$_GET['sendFromBank'];
	$sendToBank		=	$_GET['sendToBank'];
	$sendToAccoun	=	$_GET['sendToAccount'];
	$sendFromAccount=	'0'.$sendFromAccoun.'';
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
		$sql = $con->query("insert into clients(name) values('VISITOR')");
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
			
			$ch = curl_init(); 
			curl_setopt($ch, CURLOPT_URL, "http://41.186.31.51:8080/requestpayment/"); 
			$post = [
			
				
				'transactionId' => 	'',
				'policyNumber' 	=> 	'Test',
				'phone'			=>	$phone1,
				'phone2'		=>	$phone2,
				'amount'		=>	$amount,
				'fname'			=>	'',
				'lname'			=>	'',
				'nationalId'	=>	'',
				'agentName'		=>	'UPLUS',
				'agentId'		=>	-1,
				'information'	=>	"Waiting for status...",
				'information2'	=>	"Waiting for status...",
			];
				
			// receive server response ...
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			$server_output = curl_exec($ch); 

			// close curl resource to free up system resources 
			curl_close($ch);
			// PUT THE RESPONSE IN SESSION SO THAT I CAN CALL IT'S STATUS
			session_start();
			$_SESSION["server_output"] 		= $server_output;
			$_SESSION["fromTransactionId"] 	= $fromTransactionId;
			$_SESSION["ToTransactionId"] 	= $ToTransactionId;
			$_SESSION["forGroupId"]	= 	$forGroupId;
	
			// FROM JSON TO PHP
			$firstcheck = json_decode($server_output);
			$check1 = $firstcheck->{'information'};
			$check2 = $firstcheck->{'information2'};
			$transactionId1 = $firstcheck->{'transactionId'};
			
			$Update1= $con->query("UPDATE `transactions` SET status='$check1', 3rdpartyId='$transactionId1' WHERE id = '$fromTransactionId'");
			$Update2= $con->query("UPDATE `transactions` SET status='$check2', 3rdpartyId='$transactionId1' WHERE id = '$ToTransactionId'");
			// 1ST STATUS CONNECTED TO THE API WAITNING FOR MTN RESPONSE
			echo'<div id="returning">'.$check1.'</div>';
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
				</script>';

}
// END API HERE /////////////////////////

  //END IF SENDER EXISTS	
 

// CHECK IF THE RESPONSE IS BACK
if(isset($_GET['check']))
{
	session_start();
	$server_output 		= $_SESSION["server_output"];
	$fromTransactionId 	= $_SESSION["fromTransactionId"];
	$ToTransactionId 	= $_SESSION["ToTransactionId"];
	$forGroupId			= $_SESSION["forGroupId"];
	$cm = curl_init(); 
	curl_setopt($cm, CURLOPT_URL, "http://41.186.31.51:8080/requestpayment/"); 
	$sendJson = json_decode($server_output);
	curl_setopt($cm, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($cm, CURLOPT_POSTFIELDS, $sendJson);
	$server_results = curl_exec($cm);
		// CHANGE THE INFORMATION TO RESEND
	$_SESSION["server_output"] = $server_results;
		// DECODE THE RETURNED STATUS FROM PHONE 1 AND 2
	$obj = json_decode($server_results);
	$info1 	= $obj->{'information'};
	$info2 	= $obj->{'information2'};
	$amount	= $obj->{'amount'};
	$phone	= $obj->{'phone'};
	$Update1= $con->query("UPDATE `transactions` SET status='$info1' WHERE id = '$fromTransactionId'");
	$Update2= $con->query("UPDATE `transactions` SET status='$info2' WHERE id = '$ToTransactionId'");
	
	
	if($info1 == 'REQUESTED')
		{
			echo'Please approve a request on your Phone</br>
				<button class="button" onclick="stopit()">cancel</button>
				';
		}
	elseif($info1 == 'DECLINED')
		{
			?>
		<script>clearInterval(interval);</script>
					Sorry you just canceled, but its okay you can try again.</br>
					<button class="button" onClick="document.location.href='i<?php echo $forGroupId;?>'">Try Again</button>
				
		<?php
		}
	elseif($info1 == 'APPROVED')
		{
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

<?php
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
		$message    = "Take ".number_format($finalAmount)."".$Currency." Convert it into USD = $".number_format(($Amount),2)." take out ".$stripeFee."% Stripe Fee($".number_format(($usFee),2).") giving $".round($afterCharge, 2).", And convert it into Rwf = ".number_format(($rwAfterCharge),2)."Rwf , Then send it to ".$sendToAccount."";// Specify your AfricasTalking shortCode or sender id
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



