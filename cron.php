<?php
require_once('classes/sms/AfricasTalkingGateway.php');
$username   = "cmuhirwa";
$apikey     = "17700797afea22a08117262181f93ac84cdcd5e43a268e84b94ac873a4f97404";
$recipients = '+250784848236';
$message    = 'Welcome to uPlus, this is a test of Cron Job.';// Specify your AfricasTalking shortCode or sender id
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
 ?>