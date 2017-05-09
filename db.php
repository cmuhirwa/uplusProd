<?php  
	$db = new mysqli("localhost", "root", "clement123" , "uplus");
	
	if($db->connect_errno){
		die('Sorry we have some problem with the General Database!');
	}
	
	$investdb = new mysqli("localhost", "root", "clement123" , "commerce_db");
	
	if($investdb->connect_errno){
		die('Sorry we have some problem with the Investment Database!');
	}

	$outCon  = new mysqli("localhost", "root", "clement123" , "rtgs");
	if($outCon->connect_errno){
		die('Sorry we have some problem with the RTGS Database!');
	}
?>



