<?php 
$phone1 = '784848236';
$phone2 = '250784848236';
$amount = '100';
echo 'hey!';
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, "http://www.torque.rw:8989/requestpayment/"); 
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

	// close curl resource to free up system resources 
	curl_close($ch);
	echo $server_output;
?>