<?php
if (isset($_GET['accID']))
{
	$accID = $_GET['accID'];
	
	 
	include "db.php";
	$sqlnone = $db->query("SELECT * from accounts where id = '$accID'")or die (mysqli_error());
	WHILE($row = mysqli_fetch_array($sqlnone))
	{
		$contribution = $row['contribution'];
	}
	
	$sql = $db->query("SELECT * from account_user where accountID = '$accID' and acceptance='yes' ")or die (mysqli_error());
	$count = mysqli_num_rows($sql);
	WHILE($row = mysqli_fetch_array($sql))
	{
		$bank_account_id = $row['bank_account_id'];
		$userID = $row['userId'];
			//echo $bank_account_id;
		$sql1 = $db->query("SELECT * FROM banks_telecoms WHERE id='$bank_account_id'")or die (mysqli_error());
		WHILE($row = mysqli_fetch_array($sql1))
		{
			$idb = $row['id'];
			$oldbalance = $row['balance'];
			$newbalance = $oldbalance - $contribution;
			$sql2 = $db->query("UPDATE `banks_telecoms` SET `balance`='$newbalance' WHERE `id` =  '$idb'")or die (mysqli_error());
			// Save the transaction for debitors
			$sqltransaction1 = $db->query
			("
				INSERT INTO transactions
				(
				accountowner, groupid, amount, action, frombank, points
				) 
				VALUES 
				(
				'$userID','$accID','$contribution','credit','$idb','10'
				)
			")or die (mysqli_error());

			echo ''.$newbalance.'<br/>';
		}
	}
	$newAmount = $contribution * $count;
	$sql3 = $db->query("UPDATE accounts SET currentAmount='$newAmount' WHERE id ='$accID'")or die (mysqli_error());
	
	// Get the user to send money to
	$sql4 = $db->query("SELECT * from account_user where accountID = '$accID' and `listing` != 0 ORDER By listing ASC LIMIT 1")or die (mysqli_error());
	WHILE($row = mysqli_fetch_array($sql4))
		{
			$id_to_change = $row['id'];
			$accountowner = $row['userId'];
			$bank_account_id2 = $row['bank_account_id'];
			$sql5 = $db->query("SELECT * FROM banks_telecoms WHERE id='$bank_account_id2'");
			WHILE($row = mysqli_fetch_array($sql5))
				{
					$id_to_add = $row['id'];
					$balance_to_add = $row['balance'];
					$added_balance = $balance_to_add + $newAmount;
					
					// Send money to the selected user
					$sql6 = $db->query("UPDATE banks_telecoms SET balance='$added_balance' WHERE id ='$id_to_add'")or die (mysqli_error());
					
					// Save the creditor transaction
					$sqltransaction1 = $db->query
					("
						INSERT INTO transactions
						(
						accountowner, groupid, amount, action, frombank, points
						) 
						VALUES 
						(
						'$accountowner','$accID','$newAmount','debit','$bank_account_id2','0'
						)
					")or die (mysqli_error());

					echo '<br/>'.$added_balance.'<br/><br/>';
				}
			// Get the last one to be lifted up
			$sql_b7	= $db->query("SELECT * from account_user where accountID = '$accID' and `listing` != 0 ORDER By listing DESC LIMIT 1")or die (mysqli_error());
			WHILE($row = mysqli_fetch_array($sql_b7))
				{
					$lastOnList = $row['listing'];
					$toBeLast = $lastOnList + 1;
				}
			// List the one who recieved money as the last
			$sql7 = $db->query("UPDATE account_user SET listing='$toBeLast' WHERE id ='$id_to_change'")or die (mysqli_error());
		}
	
	// change the order of recieving money
	$sql8 = $db->query("UPDATE account_user SET listing = listing - 1 WHERE accountID ='$accID' and `listing` != 0")or die (mysqli_error());
	
	// change the date to transact and set it to the next date
	$sql9 = $db->query("SELECT * FROM `accounts` WHERE id ='$accID'");
	WHILE($row = mysqli_fetch_array($sql9))
		{
			$periodes = $row['periodes'];
		}
	$sql10 = $db->query("UPDATE accounts SET transactionDate = now() + INTERVAL '$periodes' DAY WHERE id ='$accID'")or die (mysqli_error());
header ("location: ikimina.php");
}
?>