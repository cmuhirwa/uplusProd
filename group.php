<?php
if (isset($_GET['groupInfo']))
	{	
		$groupID = $_GET['groupInfo'];
		include "db.php"; 
		$sql2 = $db->query("SELECT * FROM accounts WHERE id='$groupID'"); 
		while($row = mysqli_fetch_array($sql2)){ 
			$groupName = $row["accName"];
		}
	}
else{
	echo 'nothig isset';
}
?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<?php include"template/header.php"?>



  <div class="page animsition">
    <!-- Notebook Sidebar -->
    <div class="page-aside">
      <div class="page-aside-switch">
        <i class="icon wb-chevron-left" aria-hidden="true"></i>
        <i class="icon wb-chevron-right" aria-hidden="true"></i>
      </div>
      <div class="page-aside-inner">
        <div class="list-scrollable">
          <div class="list-scrollable-body">
            <div>
              <div>
                <div class="list-group">
                 <?php

                $sqlhaoenings = $db->query("
                  SELECT u.name, t.amount, t.donedate, t.points, t.action
                  FROM transactions t
                  INNER JOIN users u ON t.accountowner = u.id
                  WHERE t.action = 'debit'
                  ORDER BY t.id desc");
                $n=0;
                while($row = mysqli_fetch_array($sqlhaoenings))
                  {
                    $n++;
                  echo' <a class="list-group-item" href="javascript:void(0)" data-toggle="context" data-target="#contextMenu">
                    <h5 class="list-group-item-heading">'.$n.' '.$row['name'].'</h5>
                    <p class="list-group-item-text">Mr '.$row['name'].' received '.$row['amount'].' Rwf</p>
                    <div class="info">
                      <i class="icon md-info"></i>
                       <span class="time">'.$row['donedate'].'</span>
                    </div>
                  </a>';
                }

                  ?>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Notebook Sidebar -->
	<div class="page-main">
      <div class="page-header">
        <h1 class="page-title"><?php echo $groupName;?></h1><h6 class="visible-xs">Slide on the side to check on the groupe activities</h6>
      </div>
    <div class="page-content">
		<div class="row">
		<div class="col-lg-12">
			<div class="panel"> 
				<div class="panel-body">
					<div class="example-wrap">
						<h4 class="example-title"><?php echo $groupName;?> Performance</h4>
						<p>This shows the progress of <?php echo $groupName;?>, The more it goes high the better it becomes.</p>
							  <div class="example">
                  <div id="exampleMorrisLine"></div>
                </div>
              
					</div>
				</div>
			</div>
		</div>
	   </div>
		  <div class="row">
			<div class="col-lg-12">
				<div class="panel">
				<div class="panel-heading">
				  <h3 class="panel-title">Contributions</h3>
				</div>
				<table class="table table-hover">
				  <thead>
					<tr>
					  <th>#</th>
					  <th>Contributor</th>
					  <th>Operation</th>
					  <th>Account</th>
					  <th>Amount</th>
					  <th>On</th>
					  <th>Points</th>
					</tr>
				  </thead>
				  <tbody>
					<?php
          $sqltransactions = $db->query("
            SELECT banks.bankName, banks.acc_number, banks.holder_name, u.name uplusUserName,
			t.amount, t.donedate, t.points, t.action
			FROM transactions t
			INNER JOIN users u
			ON u.id = t.accountowner
			INNER JOIN 
				(SELECT b.id, f.name bankName, b.acc_number, b.holder_name
					FROM financial_inst f
					INNER JOIN banks_telecoms b
					ON b.acc_id = f.id
					) banks
			ON t.frombank = banks.id
            ORDER BY t.id desc
            limit 10");
          $n=0;
          while($row = mysqli_fetch_array($sqltransactions))
            {
              $n++;
              echo'<tr>
                <td>'.$n.'</td>
                <td>'.$row['uplusUserName'].'</td>
                <td>'.$row['action'].'</td>
			<td>'.$row['bankName'].' | '.$row['acc_number'].'</td>
                <td>'.$row['amount'].' Rwf</td>
                <td>'.$row['donedate'].'</td>
                <td>'.$row['points'].'</td>
              </tr>';
            }
?>

				  </tbody>
				</table>
			  </div>
			</div>
		   </div>
      </div>
	</div>
  
  </div>

<?php include ("template/footer.php");?>

</body>

</html>