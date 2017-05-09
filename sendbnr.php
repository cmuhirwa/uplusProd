<?PHP // save the bnr form
error_reporting(E_ALL);
ini_set('display_errors', 1);
if(isset($_GET['csdAccount']));
	echo $title		 	= $_GET['title'];
	echo $surname	    = $_GET['surname'];
	echo $otherNames	= $_GET['otherNames'];
	echo $dob		    = $_GET['dob'];
	echo $gender		= $_GET['gender'];
	echo $nidPassport	= $_GET['nidPassport'];
	echo $nationality	= $_GET['nationality'];
	echo $postalLine1	= $_GET['postalLine1'];
	echo $postalLine2	= $_GET['postalLine2'];
	echo $phyisicalLine3 = $_GET['phyisicalLine3'];
	echo $postCode		= $_GET['postCode'];
	echo $taxCode		= $_GET['taxCode'];
	echo $city			= $_GET['city'];
	echo $country		= $_GET['country'];
	echo $residentIn	= $_GET['residentIn'];
	echo $telephone		= $_GET['telephone'];
	echo $fax			= $_GET['fax'];
	echo $email         = $_GET['email'];
	echo $bankName      = $_GET['bankName'];
	echo $branch        = $_GET['branch'];
	echo $accountNumber = $_GET['accountNumber'];
	echo $attachments   = $_GET['attachments'];
	echo $userId   		= $_GET['userId'];
	
	include("db.php");
	$sql = $investdb->query("INSERT INTO 
	`clients` (
	`title`, `surname`, `otherNames`, `dob`, `gender`, 
	`nidPassport`, `nationality`, `postalLine1`, `postalLine2`, `phyisicalLine3`,
	`postCode`, `taxCode`, `city`, `country`, `residentIn`,
	`telephone`, `fax`, `e-mail`, `bankName`, `branch`,
	`accountNumber`, `attachments`)
	VALUES (
	'$title', '$surname', '$otherNames', '$dob', '$gender',
	'$nidPassport', '$nationality', '$postalLine1', '$postalLine2', '$phyisicalLine3',
	'$postCode', '$taxCode', '$city', '$country', '$residentIn',
	'$telephone','$fax', '$email', '$bankName', '$branch',
	'$accountNumber', '$attachments'
	)")or mysqli_error();
	$sql2 = $investdb->query("SELECT id FROM `clients` ORDER BY id desc limit 1");
	$row = mysqli_fetch_array($sql2);
	$lastId = $row['id'];
	$sql3 = $db->query("INSERT INTO 
	investments(userId, requestId) 
	VALUES('$userId','$lastId')")or mysqli_error();
	echo '<a href="testform.html">done</a>';
?>