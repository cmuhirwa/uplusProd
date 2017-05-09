<?php  
	$db = new mysqli("localhost", "root", "clement123" , "centralsitoke");
	
	if($db->connect_errno){
		die('Sorry we have some problem with the General Database!');
	}
	
?>
