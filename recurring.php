<?php include "template/header.php"?>

<link rel="stylesheet" href="assets/examples/css/widgets/weather.min3f0d.css?v2.2.0">
  <!-- Page -->
  <div class="page animsition">
   <div class="page-header">
      <h1 class="page-title">uPlus</h1>
      <ol class="breadcrumb">
        <li>
			<a href="home">Home</a></li>
				<li class="active">CONTRIBUTOINS</li>
				<li><a href="adminonce.php"><i class="icon md-accounts-list-alt"></i>Admin
			</a>
		</li>
      </ol>
      <div class="page-header-actions">
        <a href="javascript:void(0)" class="btn btn-sm btn-default btn-outline btn-round site-tour-trigger">
            <i class="icon md-info" aria-hidden="true"></i>
			<span class="hidden-xs"> I need Help </span>
        </a>
      </div>
    </div>
	
  <div class="page-content container-fluid">
    <div class="row">
    	<div class="col-lg-6">	
			<div class="panel panel-bordered panel-info" id="accounts">
				<header class="panel-heading">
				  <h3 class="panel-title">
					<i class="icon wb-folder" aria-hidden="true"></i>RECURRINGS
				  </h3> 
				</header> 
				<?php 
				$n=0;
				$sql1 = $db->query("SELECT * FROM `joined_ua` WHERE groupType = 'TIGHT' AND (`userPhone` = '$phone' AND acceptance = 'no') ");
				$count_alerts = mysqli_num_rows($sql1);
				if($count_alerts > 0){
					while($row = mysqli_fetch_array($sql1)){
						$n++;
						$invid = $row['groupId'];
						$approve="";
						$account_name = $row['groupName'];
						$acceptance = $row['acceptance'];
						if ($acceptance == 'no'){
							echo ' <div class="alert alert-danger alert-dismissible" role="alert">
									You have an invitation to join
									<a data-target="#exampleFillIn" data-toggle="modal" href="javascript:void()" onclick ="recurringInfo(group_id= '.$invid.', G_personalID='.$thisid.')">
									'.$account_name.'
									</a>
								   </div>' ;
						}
					}
				}
			?>

			<div class="panel-body">
				<div id="anouncement">
					<?php
						// GET ACCEPTED ACCOUNTS THAT I AM IN
						$sql1 = $db->query("SELECT * FROM `joined_ua` WHERE groupType = 'TIGHT' AND (`userPhone` = '$phone' AND acceptance = 'yes') ORDER BY joinid DESC ");
						$count_groups = mysqli_num_rows($sql1);
						$groupBody="";
						if($count_groups > 0)
							{
								while($row = mysqli_fetch_array($sql1))
								{
									$userId = $row['userId'];
									$joinid = $row['joinid'];
									$groupId = $row['groupId'];
									$userComitment = $row['userComitment'];
									$adminName = $row['adminName'];
									$currentAmount = $row['currentAmount'];
									$userEveryDate = $row['userEveryDate'];
									$groupName = $row['groupName'];
									$starting = $row['opening'];
									$groupBody.= '
										<tr href="javascript:void()" onclick ="get_recurring(groupId= '.$groupId.', myId='.$userId.')">
											<td>'.$groupName.'</td>
											<td>'.number_format($userComitment).' Rwf</td>
											<td>'.$userEveryDate.' th Of Month</td>
											<td>08,Jan17</td>
											<td>180,000 Rwf</td>
											<td>
												<button type="button" class="btn btn-pure btn-warning icon md-wrench waves-effect waves-circle waves-classic"></button> 
												/ 
												<a href="scripts/testlog.php?idtodelete='.$joinid.'" "type="button" class="btn btn-pure btn-danger icon md-delete waves-effect waves-circle waves-classic"></a>
											</td>
										</tr>';
								}
								echo '
									<table class="table toggle-circle" id="exampleFooAccordion">
										<thead>
											<tr>
												<th>Groups</th>
												<th>Commitment</th>
												<th>Each Date</th>
												<th data-hide="all">Since</th>
												<th data-hide="all">Total commitment</th>
												<th data-hide="all">Change</th>
											</tr>
										</thead>
										<tbody>
											'.$groupBody.'
										</tbody>
									</table>';
							}else
								{
									echo'
										<i class="icon md-mood-bad"></i> Opps!  You are in 0 group, But you can create one by clicking on 
										<button class="btn btn-xs btn-success btn-floating" data-target="#addTopicForm" data-toggle="modal" type="button" id="add"><i class="icon md-plus" aria-hidden="true"></i></button>';
								}
					?>
				</div>
			</div>
          	<div class="panel-footer">
				<?php echo $count_groups;?> Groups
			</div>
			  </div>
		</div>
		
		<div id="recurringKusanya"></div>

    </div>
  </div>
  
<?php include ("template/footer.php");?>
<script>
// Display a Group
function get_recurring(groupId, myId){
	var groupId = groupId;
	var myId = myId;
	document.getElementById('recurringKusanya').innerHTML = '<div style="text-align: center;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
	$.ajax({
			type : "GET",
			url : "scripts/kusanya.php",
			dataType : "html",
			cache : "false",
			data : {
				
				groupId : groupId,
				myId : myId,
			},
			success : function(html, textStatus){
				$("#recurringKusanya").html(html);
			},
			error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			}
	});
}

// Display a recurrunf Invitation
function recurringInfo(group_id, G_personalID){
	var group_id = group_id;
	var G_personalID = G_personalID;
	document.getElementById('group_infromation').innerHTML = '<div style="text-align: center;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
	$.ajax({
			type : "GET",
			url : "scripts/kusanya.php",
			dataType : "html",
			cache : "false",
			data : {
				
				group_id : group_id,
				G_personalID : G_personalID,
			},
			success : function(html, textStatus){
				$("#group_infromation").html(html);
			},
			error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			}
	});
}
</script>	
</body>

</html>