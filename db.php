<?php  
	$db = new mysqli("localhost", "root", "" , "uplus");
	
	if($db->connect_errno){
		die('Sorry we have some problem with the General Database!');
	}
	
	$investdb = new mysqli("localhost", "root", "" , "commerce_db");
	
	if($investdb->connect_errno){
		die('Sorry we have some problem with the Investment Database!');
	}

	$outCon  = new mysqli("localhost", "root", "" , "rtgs");
	if($outCon->connect_errno){
		die('Sorry we have some problem with the RTGS Database!');
	}
?>



