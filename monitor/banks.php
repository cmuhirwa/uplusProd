<?php

include 'db.php';
$transactions="";
$sql =$con->query("
	select
	tv.amount, tv.status, tv.3rdpartyId, tv.operation, tv.transaction_date, tv.bankName, tv.account_id accountId, tv.bankId, tv.clientId , tv.clientName, tv.to_from_client fromClientId,tv.to_from_account fromAccountId, 
	bc.accountNumber fromAccount, tv.to_from_bank fromBankId, b.name fromBank, c.name fromClient
	from transactionsview tv
	INNER JOIN bank_client bc
	ON tv.to_from_account = bc.id
	INNER JOIN banks b
	ON tv.to_from_bank = b.id
	INNER JOIN clients c
	ON tv.to_from_client = c.id
    WHERE operation = 'debit' ORDER BY trans_id DESC
	");
$n=0;
while ($row=mysqli_fetch_array($sql)) {
	$n++;
	$transactions.= '
		<tbody>
			<tr>
				<td>'.$n.'</td>
				<td>'.number_format($row['amount']).'</td>
				<td>'.$row['status'].'</td>
				<td>'.$row['3rdpartyId'].'</td>
				<td>'.$row['transaction_date'].'</td>
				<td><a href="account.php?accountId='.$row['accountId'].'&clientId='.$row['clientId'].'&page='.$row['bankId'].'">'.$row['clientName'].' | '.$row['bankName'].'</a></td>
				<td><a href="account.php?accountId='.$row['fromAccountId'].'&clientId='.$row['fromClientId'].'&page='.$row['fromBankId'].'">'.$row['fromClient'].'| '.$row['fromBank'].'</a></td>
			</tr>
		</tbody>';
	}	
?>

<!DOCTYPE html>
<html>
<head>
	<title>BANKS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
      <span class="icon-bar"></span> 
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
      <a class="navbar-brand" href="#">RTGS</a>
    </div>
  <div class="collapse navbar-collapse" id="menu">
    <ul class="nav navbar-nav">
      <li><a href="index.php">Home</a></li>
      <li class="active"><a href="javascript:void()">Banks</a></li>
    </ul>
    </div>
  </div>
</nav>

<div class="container"> 
 	<div style="color: #fff; font-size: 20px; background-color: #007569; height: 100px;     box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);
    color: #fff;">
		<img style="margin: 15px; border: solid 2px white; " src="img/rtgs.png" height="70" >
		&nbsp;&nbsp;&nbsp;(<?php echo $n;?>) Transactions in all banks
	</div>
	<br>
  	<div class="jumbotron">
		<div class="row">
		<div class="col-xs-2">
			<div class="table-responsive">
				<table class="table table-hover table-striped table-bordered" style="float: left;">
					<thead>
						<tr>
							<th>Bank list</th>
						</tr>
					</thead>
					<?php
						include 'db.php';
						$sql =$con->query("select * from banks");
						while ($row=mysqli_fetch_array($sql)) {
							echo '<tbody><tr>
						<td><a href="bank.php?page='.$row['id'].'">'.$row['name'].'</a></td>
					</tr></tbody>';
						}
					?>
						
				</table>
			</div>
		</div>
		<div class="col-xs-10">
			<div class="table-responsive">
				<table class="table table-hover table-striped table-bordered" style="float: left;">
					<thead>
						<tr>
							<th>#</th>
							<th>Amount</th>
							<th>Status</th>
							<th>3rdpartyId</th>
							<th>Date</th>
							<th>From</th>
							<th>To</th>
						</tr>
					</thead>
					<?php echo $transactions;?>
				</table>
			</div>
		</div>
		</div>
  	</div>
  	<div class="footer">
  	</div>
</div>
</body>
</html>