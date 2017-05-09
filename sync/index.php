<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

	// Check if the method exists
	if(function_exists($_POST['tablename']))
	{
		$_POST['tablename']();
	}

	// Call methods
	function items(){
		$itemId 	= 	$_POST['tableid'];
		$itemName 	=	$_POST['itemName'];	
		$kode 		=   $_POST['kode']; 		
		$unit 		=   $_POST['unit'];		
		$unityPrice =   $_POST['unityPrice'];
		$inDate 	=   $_POST['inDate']; 	
		$addedBy 	=   $_POST['addedBy']; 	
		$syncid 	=   $_POST['syncid']; 	
		
		include("db.php");
		// CHECK IF THE ITEM WAS UPDATED BEFORE AND UPDATE IT ELSE INSERT IT
		//if($syncid > 0)
		//{
			$sendsql = $db->query("INSERT INTO `items`(itemId, synced,
			itemName, kode, unit, unityPrice, inDate, addedBy
			) 
			VALUES ('$itemId', 'yes',
			'$itemName', '$kode', '$unit', '$unityPrice', '$inDate', '$addedBy')
			")or die(mysqli_error());
		/*}
		else
		{
			$callsql = $db->query("UPDATE items SET 
			itemId = '$itemId', synced = 'yes',
			itemName = '$itemName', kode = '$kode',
			unit = '$unit', unityPrice = '$unityPrice', inDate = '$inDate', 
			addedBy = '$addedBy' WHERE syncid = '$syncid'
			")or die(mysqli_error());
		}*/
		$sqlgetresults = $db->query("SELECT * FROM items WHERE itemId = $itemId ORDER BY syncid DESC limit 1");
		$items = array();
		while($item = mysqli_fetch_array($sqlgetresults))
		{
			$items = $item;
		}
		$items = json_encode($items);
		echo $items;
	}
	
	// Call methods
	function transactions(){
		$agentName		   = $_POST['agentName']; 	
		$transactionID	   = $_POST['tableid'];
		$syncid			   = $_POST['syncid'];
		
		$trUnityPrice  	   = $_POST['trUnityPrice'];   
		$qty               = $_POST['qty'];   
		$itemCode          = $_POST['itemCode'];     
		$operation         = $_POST['operation'];     
		$purchaseOrder     = $_POST['purchaseOrder']; 
		$deliverlyNote     = $_POST['deliverlyNote'];
		$docRefNumber      = $_POST['docRefNumber'];
		$customerName      = $_POST['customerName']; 
		$customerRef       = $_POST['customerRef']; 
		$operationNotes    = $_POST['operationNotes'];
		$operationStatus   = $_POST['operationStatus'];
		$doneOn            = $_POST['doneOn'];
		$doneBy            = $_POST['doneBy'];       

		include("db.php");
		// CHECK IF THE ITEM WAS UPDATED BEFORE AND UPDATE IT ELSE INSERT IT
		
		$sendsql = $db->query("INSERT INTO `transactions`
		(transactionID, `trUnityPrice`, `qty`, `itemCode`, `operation`, `purchaseOrder`, 
		`deliverlyNote`, `docRefNumber`, `customerName`, `customerRef`, `operationNotes`, 
		`operationStatus`, `doneOn`, `doneBy`, `sync`) 
			VALUES 
		('$transactionID','$trUnityPrice','$qty','$itemCode','$operation','$purchaseOrder',
		'$deliverlyNote','$docRefNumber','$customerName','$customerRef','$operationNotes',
		'$operationStatus','$doneOn','$doneBy', 'yes')
			")or die(mysqli_error());
		
		$sqlgetresults = $db->query("SELECT * FROM transactions WHERE transactionID = $transactionID ORDER BY syncid DESC limit 1");
		$transactions = array();
		while($atransaction = mysqli_fetch_array($sqlgetresults))
		{
			$transactions = $atransaction;
		}
		$transactions = json_encode($transactions);
		echo $transactions;
	}
	
?>