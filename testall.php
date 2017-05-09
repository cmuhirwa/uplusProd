<?php
if(isset($_FILES['contactsFile'])){
$filename = basename($_FILES['contactsFile']['name']);
$path = '../docs/'.$filename;
move_uploaded_file($_FILES['contactsFile']['tmp_name'], $path);
//echo $filename;

include "../db.php";

$sqlgetlstaccount = $db->query("SELECT id, accName FROM accounts order by id desc limit 1")or die (mysqli_error());
$fetchaccountId = mysqli_fetch_array($sqlgetlstaccount);
$lastAccountId = $fetchaccountId['id'];
$lastAccountName = $fetchaccountId['accName'];
		
// EXCEL BULK INVITATIONS
include ("../Classes/PHPExcel/IOFactory.php");  
$objPHPExcel = PHPExcel_IOFactory::load($path);  
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)   
{  
  $highestRow = $worksheet->getHighestRow();  
  for ($row=2; $row<=$highestRow; $row++)  
  {  
	   $names = mysqli_real_escape_string($db, $worksheet->getCellByColumnAndRow(0, $row)->getValue());  
	   $phone = mysqli_real_escape_string($db, $worksheet->getCellByColumnAndRow(1, $row)->getValue());  
	  
		// 2 Check if the inveted user is new
		$sqlcheckifuserexists = $db->query("SELECT id, name FROM users WHERE phone = '$phone'")or die (mysqli_error());
		$checkuser = mysqli_num_rows($sqlcheckifuserexists);
	if($checkuser > 0)
	{
		$fetchCheckedUser = mysqli_fetch_array($sqlcheckifuserexists);
		$userId = $fetchCheckedUser['id'];
		$userName = $fetchCheckedUser['name'];
	}
	else
	{
		$sqlsaveexcel = $db->query ("INSERT INTO users (phone, name) VALUES ('$phone', '$names')")or die (mysqli_error());
		
		// 2.1 grab that id
		$sqlgetuserId = $db->query("SELECT id, name from users where phone = '$phone'");
		$fetchuserId = mysqli_fetch_array($sqlgetuserId);
		$userId = $fetchuserId['id'];
		$userName = $fetchuserId['name'];
	} 
	$sqlCheckAccount_User = $db->query("SELECT * FROM account_user WHERE accountID ='$lastAccountId' and userId='$userId'");
	$countIfAccUserExists = mysqli_num_rows($sqlCheckAccount_User);
	if($countIfAccUserExists > 0)
	{
		echo'sorry user '.$userName.' with '.$phone.' is already in group '.$lastAccountName.'<br/>';
	}
	else
	{
		// 3 join the user with an account
		$sql7 = $db->query("INSERT INTO `account_user`(`accountID`, `userID`) 
						VALUES ('$lastAccountId','$userId')") or die (mysqli_error());
		
	}
  }
  echo "<a href='test.php'> done click here.</a>";
 }
}
// END EXCEL BULK INVITATIONS
?>



<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
<form action="testsms.php" id="form" method="post" enctype="multipart/form-data">
  <input type="file" id ="file" name="contactsFile">
</form>
<script>
document.getElementById("file").onchange = function() {
    document.getElementById("form").submit();
}
</script>
</body>
</html>