
<?php
if (isset($_GET['name'])){
$name = $_GET['name'];
//$fbId = $_GET['fbId'];
//$gender = $_GET['gender'];
$thisid = $_GET['thisid'];

include("../db.php");
$sql = $db->query("UPDATE `users` SET `name` = '$name' WHERE `users`.`id` = '$thisid'");

//echo $thisid.'<br>';
//echo $fbId.'<br>';
//echo $name.'<br>';
//echo $gender;
//echo'Yes Profile updated with a success click here'
}
?>

<html>
<body>
Hello
</body>
</html>