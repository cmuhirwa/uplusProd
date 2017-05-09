<?php // just test the ajax
if (isset($_GET['bank_id']))
{
	$bank_id = $_GET['bank_id'];
	$hName = $_GET['hName'];
	$accountNumber = $_GET['accountNumber'];
	include("../db.php");
	$sql_banks = $db->query("SELECT * FROM `banks_telecoms` 
	WHERE acc_id ='$bank_id' AND holder_name = '$hName' AND acc_number = '$accountNumber'");
	$n = mysqli_num_rows($sql_banks);
	if($n > 0)
	{
		WHILE ($row = mysqli_fetch_array($sql_banks))
		{
					echo 'the balance is : <br/><b>'.$row['balance'].' Rwf</b>';
		}

	}else
	{
		echo 'Starting amount:<br/><input name="balance"><br/>
		<input type="submit" value="Add New Account" name="new_account">';
	}
}
?>