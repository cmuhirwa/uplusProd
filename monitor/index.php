<?php
	if (isset($_POST['client_name'])) {
		$clientname= $_POST['client_name'];
		$bank_id= $_POST['bank_id'];
		$accountNumber= $_POST['accountNumber'];
  	include "db.php";
  	$sql = $con->query("insert into clients(name) values('$clientname')");
  	$sqllaststu= $con->query("select id from clients order by id desc limit 1");
  	$laststu_id=$row=mysqli_fetch_array($sqllaststu);
  	$client_id=$row['id'];
  	$sqlsklstu= $con->query("insert into bank_client(client_id, bank_id, accountNumber) 
      values('$client_id','$bank_id','$accountNumber')")or mysqli_error();
    header ('location: index.php');
    exit();
    //echo 'Done';
  	}
  else{
    //echo'Not Done';
  }
	?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Transfers</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                var options = {
                    chart: {
                        renderTo: 'container',
                        type: 'area'
                    },
                    title: {
                        text: '',
                        x: -20 //center
                    },
                    xAxis: {
                        categories: [],
                        title: {
                            text: 'Days'
                        }
                    },
                    yAxis: {
                        title: {
                            text: 'Transfers'
                        },
                        plotLines: [{
                                value: 0,
                                width: 1,
                                color: '#808080'
                            }]
                    },
                    tooltip: {
                        valueSuffix: 'Transaction/Days'
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle',
                        borderWidth: 0
                    },
                    series: []
                };
                $.getJSON("data.php", function(json) {
                    options.xAxis.categories = json[0]['data']; //xAxis: {categories: []}
                    options.series[0] = json[1];
                    chart = new Highcharts.Chart(options);
                });
            });
        </script>
        <script src="js/highchats.js"></script>
       
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
      <li class="active"><a href="javascript:void()">Home</a></li>
      <li><a href="banks.php">Banks</a></li>
    </ul>
    </div>
  </div>
</nav>
  
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="jumbotron">


      <table class="table table-hover table-striped table-bordered">
<?php
    include "db.php";
    $sqlhead = $con->query("SELECT DISTINCT bankName FROM transactionsview WHERE operation='credit' ORDER by bankName ASC");
    echo'<thead><tr><th>FROM-TO</th>';
    while($row1=mysqli_fetch_array($sqlhead))
		{
			echo '<th>'.$row1['bankName'].'</th>';
		}
	echo'</tr></thead>';
    $sqlfrom =$con->query("SELECT DISTINCT bankName FROM transactionsview WHERE bankName <> '' AND operation='credit' ORDER by bankName DESC");
   	while ($row=mysqli_fetch_array($sqlfrom))
		{
            echo'<tbody><tr><td>'.$row['bankName'].'</td>';
			$sqlto =$con->query("SELECT DISTINCT to_from_bank FROM transactionsview WHERE to_from_bank <> '' AND operation='credit' ORDER by bankName DESC");
			while ($row2=mysqli_fetch_array($sqlto))
				{
					$fromAccount = $row['bankName'];
					$toAccount = $row2['to_from_bank'];
					$sqlresult =$con->query("SELECT COUNT(operation) AS nbrt FROM transactionsview WHERE bankName = '$fromAccount' AND to_from_bank = '$toAccount' AND amount > 0 AND operation='credit' ");
					while ($row3=mysqli_fetch_array($sqlresult))
					{
						$number = $row3['nbrt'];
						echo '<td>'.$row3['nbrt'].'</td>';
					}
				}
			echo'</tr></tbody>';
		}
?>
      </table>

	  <style>.highcharts-credits{
		      fill-opacity: 0;
	  }</style>
	  <div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
      <br>
      <br>
        <div class="container">
			<div class="row">
				<div class="col-md-3">
				
					<h4>Test Transfer</h4>
					Use: <select class="form-control" id="payMeth" onchange="givePay()" required>
							  <option></option>
							  <option value="phone">Phone</option>
							  <option value="card">Card</option>
							</select><br>
					  <div id="meth">
						From: 
						<input type="text" disabled class="form-control">
					  </div><br>
						To: 
						<input type="text" class="form-control">
						<br>
					  <button class="btn btn-primary">SEND</button>
				</div>
			</div>
		</div>
      </div>
    </div>
  </div>
  <div class="footer">
  </div>
</div>
<script src="js/jquery.js"></script>
<script>
function givePay()
{
	var payMeth = document.getElementById('payMeth').value;
	if(payMeth == 'phone')
	{
		document.getElementById('meth').innerHTML = 'From: <input type="text" placeholder="eg: 0788888888 or 0722222222" required class="form-control">';
	}
	else if(payMeth == 'card')
	{
		document.getElementById('meth').innerHTML = 'From: <input type="text" placeholder="eg: 424242 424242 424242" required class="form-control">';
	}
	else
	{
		document.getElementById('meth').innerHTML = 'From: <input disabled class="form-control">';
	}
}
</script>
</body>
</html>
