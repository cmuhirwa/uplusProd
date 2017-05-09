<?php 
$serverName = "192.168.43.235\portal"; //serverName\instanceName
$connectionInfo = array( "Database"=>"uplus", "UID"=>"allied", "PWD"=>"w384cc355");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     //echo "Connection established.<br />";
	if ($_GET["query"]=="list") {
		$parentlistid = $_GET['parentlistid'];
		$sql = "exec dbo.selectlist @parentlistid='$parentlistid'";
		$stmt = sqlsrv_query( $conn, $sql);
		if( $stmt === false ) {
			 die( print_r( sqlsrv_errors(), true));
		}
		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		echo $row['listid'].", ".$row['list'].", ".$row['listdesc'].", ".$row['parent']."<br/>";
}

	 }
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>
