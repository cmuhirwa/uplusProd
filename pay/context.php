<?php 
        
        $url = 'http://lightapi.torque.co.rw:8080/requestpayment/';
		
		//$url = 'http://torque.cloudapp.net/requestpayment/';
		//$url = 'http://localhost:9000/requestpayment/';
		//$url = 'http://localhost:8080/API/synchronizer/syncserver.php';
		$data = array();
		$data["agentName"] = "UPLUS";
		$data["agentId"] = "0784848236";
		$data["phone"] = "725594646";
        $data["phone2"] = "250725594646";
		$data["amount"] = "500";
        // use key 'http' even if you send the request to https://...
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
			)
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		if ($result === FALSE) { /* Handle error */ 
			//$this->message = "Error connecting to the server."; 
			//$this->state = "danger";
			
			//echo $data;
			
			var_dump($result);	
			//$row['information'] = "Connection error. Trying again.";
			//return (object)$row;
			//$row['information'] = "Connection error. Trying again.";
			//return $row;
		}	

		//var_dump($result);		
		
		//$this->message = "Cashier syncing success."; 
		//$this->state = "warning";
		
		//echo json_decode($result);
		echo $result;
		/*250725594646
250784848236
250782384772
725594646*/
?>
