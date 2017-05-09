
<?php
include 'db.php';
	if (isset($_GET['clientId'])) {
		$clientId1 = $_GET['clientId'];
		$sqlclient = $con ->query("SELECT name FROM clients WHERE id='$clientId1'");
		$fetchClientName = mysqli_fetch_array($sqlclient);
		$ClientName = $fetchClientName['name'];
	}else{
		echo 'no cleint to show the transactions';
	}

if (isset($_GET['page'])) {
	$page = $_GET['page'];
	$sqlgetbank= $con->query("SELECT * FROM banks WHERE id ='$page'");
	$countBanks = mysqli_num_rows($sqlgetbank);
	$fetchname = mysqli_fetch_array($sqlgetbank);
	$bankName = $fetchname['name'];
	$bankcolor = $fetchname['bankcolor'];
	$transactions="";
	$sql =$con->query("select * from transactionsview where bankId = '$page' AND clientId = '$clientId1'");
	$n=0;
	while ($row=mysqli_fetch_array($sql)) {
		$n++;
		$transactions.= '
			<tbody>
				<tr>
					<td>'.$n.'</td>
					<td>'.$row['amount'].'</td>
					<td>'.$row['operation'].'</td>
					<td>'.$row['transaction_date'].'</td>
					<td>'.$row['clientName'].'</td>
					<td><a href="bankClient.php?page='.$row['to_from_bank'].'&clientId='.$row['to_from_client'].'">'.$row['bankName'].'</a></td>
				</tr>
			</tbody>';
		}
	
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $bankName;?></title>
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
      <li><a href="banks.php">Banks</a></li>
      <li ><a href="bank.php?page=<?php echo $page;?>"><?php echo $bankName;?></a></li>
      <li class="active"><a href="javascript:void()"><?php echo $ClientName;?></a></li>
    </ul>
    </div>
  </div>
</nav>

<div class="container">
	<?php
		if ($countBanks == 1) {
			echo '  <div style="    box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);
    color: #fff; color: #fff; font-size: 20px; background-color: '.$bankcolor.'; height: 100px;">
						<img style="margin: 15px; border: solid 2px white; " src="img/'.$bankName.'.png" height="70" >
						&nbsp;&nbsp;&nbsp;('.$n.') transactions from '.$ClientName.' in '.$bankName.'
					</div>';
		}else{
			echo $countBanks.'You are trying to access a bank which does not exist';
		}
	}

	?><br>
  	<div class="jumbotron">
		<div class="row">
		<div class="col-xs-2">
			<div class="table-responsive">
				<table class="table table-hover table-striped table-bordered" style="float: left;">
					<thead>
						<tr>
							<th>Accounts list
							</th>
						</tr>
					</thead>
					<?php
						include 'db.php';
						$sqlAccount =$con->query("select * from bank_client where bank_id = '$page' and client_id = '$clientId1'");
						while ($row=mysqli_fetch_array($sqlAccount)) {
							echo '<tbody><tr>
						<td><a href="account.php?accountId='.$row['id'].'&clientId='.$clientId1.'&page='.$page.'">'.$row['accountNumber'].'</a></td>
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
							<th>amount</th>
							<th>action</th>
							<th>date</th>
							<th>user name</th>
							<th>bank name</th>
						</tr>
					</thead>
					<?php
						echo $transactions;
					?>
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