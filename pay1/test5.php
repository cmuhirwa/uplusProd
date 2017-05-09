<?php
$phone1 = '784848236';
$phone2 = '250784848236';
$amount = '100';
echo 'hey!';
$params = array (


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
	);
 
// Build Http query using params
$query = http_build_query ($params);
 
// Create Http context details
$contextData = array ( 
                'method' => 'POST',
                'header' => "Connection: close\r\n".
                            "Content-Length: ".strlen($query)."\r\n",
                'content'=> $query );
 
// Create context resource for our request
$context = stream_context_create (array ( 'http' => $contextData ));
 
// Read page rendered as result of your POST request
$result =  file_get_contents (
                  'http://www.torque.rw:8989/requestpayment/',  // page url
                  false,
                  $context);
 
// Server response is now stored in $result variable so you can process it?>