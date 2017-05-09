<?php
error_reporting(E_ALL);
    ini_set('display_errors', 1);

if (isset($_GET['groupName'])){	
		include "../db.php";$groupName = mysqli_real_escape_string($db, $_GET['groupName']);
		$groupStory = mysqli_real_escape_string($db, $_GET['groupStory']);
		$groupDesc = mysqli_real_escape_string($db, $_GET['groupDesc']);
		$groupID = mysqli_real_escape_string($db, $_GET['groupID']);
		$sql = $db->query("UPDATE accounts 
			SET accName='$groupName', groupStory = '$groupStory', groupDesc = '$groupDesc' WHERE id = '$groupID'"); 
		 echo $groupName.' is up to date <a href="editCont'.$groupID.'">Click Here!</a>';
		}
if (isset($_GET['level'])){
	$level = $_GET['level'];
	$groupID = $_GET['groupID'];
	include "../db.php"; 
	$sql = $db->query("UPDATE accounts SET level='$level' WHERE id = '$groupID'");
}
if (isset($_POST['newupdate'])){
	$newupdate = $_POST['newupdate'];
	$groupId = $_POST['groupId'];
	$adminId = $_POST['adminId'];
	include "../db.php"; 
	$sql = $db->query("INSERT INTO updatestransaction(body, picture, video, groupId, byId) 
	VALUES ('$newupdate', 'no', 'no', '$groupId','$adminId')")or die (mysqli_error());
	header('location: ../editCont'.$groupId);
}
?>