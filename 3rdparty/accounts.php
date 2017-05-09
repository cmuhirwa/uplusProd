<?php // Add financial accounts
$disp_bank ='';
include "../db.php";
$sql = $db->query("SELECT * FROM financial_inst ORDER BY type ASC")or die (mysqli_error());
while($row = mysqli_fetch_array($sql))
{
		$bank_names = $row['name'];
		$bank_id = $row['id'];
		$disp_bank.='<option value="'.$bank_id.'">'.$bank_names.'</option>';
}
if (isset($_POST['new_account']))
{
	$bank_id = $_POST['bank_id'];
	$hName = $_POST['hName'];
	$accountNumber = $_POST['accountNumber'];
	$balance = $_POST['balance'];
	include "../db.php";
	$sql1 = $db->query("INSERT INTO `banks_telecoms`(`acc_id`, `holder_name`, `acc_number`, `balance`)
						VALUES ('$bank_id','$hName','$accountNumber','$balance')")or die (mysqli_error());
}

?>
<?php
if(isset($_POST['addition']))
{
	$addition = $_POST['addition'];
	$balance = $_POST['balance'];
	$idtoadd = $_POST['idtoadd'];
	$newBalance = $addition + $balance;
	include("../db.php");
	$sql = $db->query ("UPDATE `banks_telecoms` SET balance='$newBalance' WHERE id='$idtoadd'")or die (mysqli_error());
}
?>
<html>
<head>
<script src="../assets/js/jquery.js"></script>
<form method="post" action="accounts.php">
<table cellpadding="10">
<tr>
<td>
Chose an account:<br/>
<select name="bank_id" id="bank_id" onchange="check_account()">
<option></option>
<?php echo $disp_bank;?>
</select>
</td><td>
account holder name:<br/>
<input name="hName" id="hName" onkeyup="check_account()"/>
</td>
</tr>
<tr>
<td>
account number:<br/>
<input name="accountNumber"  id="accountNumber" onkeyup="check_account()"/>
</td>
<td>
<div id="checked"></div>
</td>
</tr>
</table>

</form>
<br/>
<br/><hr/>
<h2>List of Sample Accounts<h2/>
<table border="1">
<tr>
	<td>N/S</td>
	<td>Name</td>
	<td>Account</td>
	<td>Acc_Number</td>
	<td>Balance</td>
	<td>Add</td>
<tr>
<?php
include "../db.php";
$n=0;
$sql2 = $db->query("
SELECT f.name, b.acc_id, b.holder_name, b.acc_number, b.balance, b.id
		FROM banks_telecoms b
		INNER JOIN financial_inst f ON b.acc_id = f.id")or die (mysqli_error());
		while($row = mysqli_fetch_array($sql2))
		{
			$n++;
			echo"<form action='accounts.php' method='post'>
			<tr>
				<td>".$n."</td>
				<td>".$row['name']."</td>
				<td>".$row['holder_name']."</td>
				<td>".$row['acc_number']."</td>
				<td>".$row['balance']."</td>
				<td><input type='number' name='balance' value='".number_format($row['balance'])."' hidden/><input type='number' name='idtoadd' value='".$row['id']."' hidden/><input type='number' name='addition'><input type='submit' value='add'></td>
			<tr></form>";
		}
?>
</table>
<script>
//Add bank account
function check_account(){
	//alert('hey');
	var bank_id =$("#bank_id").val();
	var hName =$("#hName").val();
	var accountNumber =$("#accountNumber").val();
	$.ajax({
			type : "GET",
			url : "bank.php",
			dataType : "html",
			cache : "false",
			data : {
				bank_id : bank_id,
				hName : hName,
				accountNumber : accountNumber,
			},
			success : function(html, textStatus){
				$("#checked").html(html);
			},
			error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			}
	});
 }
</script>
</body>
</html>