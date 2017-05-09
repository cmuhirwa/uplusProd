<?php include "template/header.php"?>


  <!-- Page -->
  <div class="page animsition">
   <div class="page-header">
      <h1 class="page-title">uPlus 
	  
	 
	  
	  
	  </h1>
      <ol class="breadcrumb">
        <li><a href="home">Home</a></li>
        <li class="active">Groups</li>
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
        <div class="col-lg-4">
          <!-- Panel Row Toggler -->
          <div class="panel panel-bordered panel-success"  id="accounts">
		  
            <header class="panel-heading">
              <h3 class="panel-title">
				<i class="icon wb-folder" aria-hidden="true"></i>My Groups
				
			  </h3>
			  
            </header> 
			<?php 
				$n=0;
				$sql1 = $db->query("SELECT * FROM `joined_ua` WHERE groupType = 'IKIMINA' and (`userPhone` = '$phone' and acceptance='no')");
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
									<a data-target="#exampleFillIn" data-toggle="modal" href="javascript:void()" onclick ="group_info(group_id= '.$invid.', G_personalID='.$thisid.')">
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
						$sql1 = $db->query("SELECT * FROM `joined_ua` WHERE groupType = 'IKIMINA' AND (`userPhone` = '$phone' AND acceptance = 'yes') ");
						$count_groups = mysqli_num_rows($sql1);
						$groupBody="";
						if($count_groups > 0)
							{
								while($row = mysqli_fetch_array($sql1))
								{
									$uesrId = $row['userId'];
									$accountID = $row['groupId'];
									$contribution = $row['contribution'];
									$adminName = $row['adminName'];
									$currentAmount = $row['currentAmount'];
									$approve="";
									$account_name = $row['groupName'];
									$starting = $row['opening'];
									// COUNT MEMBERS WE ARE IN THE SAME GROUP
									$sqlGroupMember = $db->query("SELECT * FROM account_user 
																	WHERE accountID = '$accountID' 
																	AND acceptance = 'yes' ");
									$countGroupMember = mysqli_num_rows ($sqlGroupMember);
									$savings = $contribution*$countGroupMember;
									$date = Rand(1,31);
									$groupBody.= '
										<tr href="javascript:void()" onclick ="page(pageID= '.$accountID.'); get_info(infoID= '.$accountID.', myID='.$uesrId.'); count_u(groupID= '.$accountID.', myID='.$uesrId.'); clear_info()">
											<td>'.$account_name.' </td>
											<td>'.$adminName.'</td>
											<td>'.$contribution.' Rwf</td>
											<td>'.$savings.' Rwf</td>
											<td>'.$currentAmount.' Rwf</td>
											<td>$date Feb 2016</td>
											<td>'.$starting.'</td>
										</tr>';
								}
								echo '
									<table class="table toggle-circle" id="exampleFooAccordion">
										<thead>
											<tr>
												<th>Groups</th>
												<th>Admin</th>
												<th data-hide="all">My Contribution</th>
												<th data-hide="all">Amount to recieve</th>
												<th data-hide="all">Group Sevings</th>
												<th data-hide="all">My Turn</th>
												<th data-hide="all">Opening on</th>
											</tr>
										</thead>
										<tbody>
											'.$groupBody.'
										</tbody>
									</table>';
							}else
								{
									echo'
										You have no group, create one by clicking on <i class="icon wb-plus" aria-hidden="true"></i>';
								}
					?>
				</div>
			</div>
          	<div class="panel-footer">
				<?php echo $count_groups;?> Groups
			</div>
		  </div>
          <!-- End Panel Row Toggler -->
        </div>

        <div class="col-lg-4">
          <!-- Panel Accordion -->
          <div class="panel panel-bordered panel-info" id="members">
            <header class="panel-heading">
              <h3 class="panel-title"><div id="account_name"><i class="icon wb-user" aria-hidden="true"></i>Members </div></h3>
			</header>
            
				
              <div id="users">
			  <div class="panel-body">Click on the group to see the list of members!
</div>
            </div>
			
				<div class="panel-footer"><div id="counted">0 member </div></div>
          </div>
          <!-- End Panel Accordion -->
        </div>

		<div class="col-lg-4" id="transactions"></div>
	</div>

<?php include ("template/footer.php");?>
</body>

</html>



                