<?php 
error_reporting(E_ALL);
if(isset($_GET['amount'])){
	$amount = $_GET['amount'];
	$phone1 = $_GET['phone1'];
	$phone2 = $_GET['phone2'];
// API
	$ch = curl_init(); 
	
	curl_setopt($ch, CURLOPT_URL, "http://lightapi.torque.rw/requestpayment/"); 
	//if (curl_exec($ch) === FALSE) {
   //die("Curl Failed: " . curl_error($ch));
   $post = [
	
		
		'transactionId' => 	'',
		'policyNumber' 	=> 	'Test',
		'phone'			=>	$phone1,
		'phone2'		=>	$phone2,
		'amount'		=>	$amount,
		'fname'			=>	'',
		'lname'			=>	'',
		'nationalId'	=>	'',
		'agentName'		=>	'',
		'agentId'		=>	-1,
		'information'	=>	"Waiting for status...",
		'information2'	=>	"Waiting for status...",
	];
		
	// receive server response ...
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	$server_output = curl_exec($ch); 


//} else {
//   return curl_exec($ch);
//}
	// close curl resource to free up system resources 
	curl_close($ch);
	// PUT THE RESPONSE IN SESSION SO THAT I CAN CALL IT'S STATUS
	session_start();
	$_SESSION["server_output"] = $server_output;
	// FROM JSON TO PHP
	 
	$firstcheck = json_decode($server_output);
	$status = $firstcheck->{'information'};
	// 1ST STATUS CONNECTED TO THE API WAITNING FOR MTN RESPONSE
	echo'<div id="returning">';
			echo $status;
	echo'</div>';
	// FIRE THE RECURRING CALL AFTER 5 SEC TO CHECK THE STATUS
	echo'
	<script>
		interval = setInterval(function() { checking();}, 15000);
		interval;
	</script>';
}
?>
<!--AJAX CALL THE STATUS-->
<script>
function checking(){
	var check =1;
	//alert('ChecKing Status');
	$.ajax({
		type : "GET",
		url : "backend.php",
		dataType : "html",
		cache : "false",
		data : {
			
			check : check,
		},
		success : function(html, textStatus){
			$("#returning").html(html);
			
		},
		error : function(xht, textStatus, errorThrown){
			alert("Error : " + errorThrown);
		}
	});
}
function stopit(){
	clearInterval(interval);
	document.getElementById('result').innerHTML = 'Aborted, Please Try again some more!.';
}
</script>

<?php
if(isset($_GET['check'])){
	session_start();
	$server_output = $_SESSION["server_output"];
    $cm = curl_init(); 
	curl_setopt($cm, CURLOPT_URL, "http://lightapi.torque.rw/requestpayment/"); 
	$sendJson = json_decode($server_output);
	curl_setopt($cm, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($cm, CURLOPT_POSTFIELDS, $sendJson);
	$server_results = curl_exec($cm);
		// CHANGE THE INFORMATION TO RESEND
	$_SESSION["server_output"] = $server_results;
	
	$obj = json_decode($server_results);
	$status2 = $obj->{'information'};
	$info2 = $obj->{'information2'};
	
	if($status2 == 'REQUESTED'){
		echo'<div id="status">Please approve a request on your Phone</br>
		<button class="mdl-button mdl-button--colored mdl-button--raised mdl-js-button mdl-js-ripple-effect" onclick="stopit()">ABORT</button></div>';
	}elseif($status2 == 'DECLINED'){
		echo'<script>clearInterval(interval);</script>
		Sorry you just canceled, but its okay you can try again.';
	}elseif($status2 == 'APPROVED'){
		if(!$info2 == 'COMPLETE'){
			echo'<script>clearInterval(interval);</script>Thanks for the transfer. Now '.$info2.'';
		}
		elseif($info2 == 'COMPLETE'){
			echo'<script>clearInterval(interval);</script> Thanks The money has been deposited. Status:'.$info2.'';
		}elseif($info2 == 'Error sending money.'){
			echo'<script>clearInterval(interval);</script>'.$info2;
		}else{
			echo $info2;
		}
	}else{
		echo 'Something is not right.'.$info2.' '.$status2.'<br/><button class="mdl-button mdl-button--colored mdl-button--raised mdl-js-button mdl-js-ripple-effect" onclick="stopit()">ABORT</button>';
	}
}
?>