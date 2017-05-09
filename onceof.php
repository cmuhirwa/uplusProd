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
			<div class="panel panel-bordered panel-dark" id="accounts">
				<header class="panel-heading">
				  <h3 class="panel-title">
					<i class="icon wb-folder" aria-hidden="true"></i>Following
				  </h3> 
				</header> 
				<div class="tab-content">
					<div class="tab-pane active">
						<ul class="list-group bg-inherit list-group-full">
							<?php
								$sql2 = $db->query("SELECT * FROM `joined_ua` WHERE groupType = 'WEDDING' AND (`userPhone` = '$phone' AND acceptance = 'yes')"); 
								while($row = mysqli_fetch_array($sql2)){ 
									$groupName = $row["groupName"];
									$groupID = $row["groupId"];
									$saving = round($row['saving']);
									$adminPhone = $row['adminPhone'];
									$adminName = $row['adminName'];
									$currentAmount = round($row['currentAmount']);
									$contributionDate = $row["opening"];
									if($saving > 0){
										$prog = $currentAmount*100/$saving;
										}
									else{$prog = 0;}
									$progressing=''.$prog.'%';
									
										$sqladminID = $db->query("SELECT id adminID FROM users WHERE phone = '$adminPhone'");
										$fetchAdminID = $rowAdminID = mysqli_fetch_array($sqladminID);
										$adminID = $rowAdminID["adminID"];
							/*danger*/		if($prog < 30){echo'<li class="list-group-item waves-effect waves-classic" style="padding-left: 10px;">
																		<div class="media">
																		  <div class="media-left">
																			<a class="avatar" href="javascript:void()" data-target="#examplePositionSidebar" data-toggle="modal" onclick ="getonceof(groupID='.$groupID.')">
																			  <img class="img-responsive" src="proimg/'.$adminID.'.jpg" alt="...">
																			</a>
																		  </div>
																		  <div class="media-body">
																		   <h4 class="media-heading">'.$groupName.' <small> Organised by:'.$adminName.': </small><span class="pull-right" id="countDown"></span></h4>
																			<div class="progress progress-xs" style="margin-bottom: 0px;">
																			  <div class="progress-bar progress-bar-danger progress-bar-indicating active" style="width: '.$progressing.';" role="progressbar">
																				<span class="sr-only">'.$progressing.' Complete</span>
																			  </div>
																			</div>
																			<div>
																				<h4><small>'.number_format($currentAmount).'/</small>'.number_format($saving).' Rwf
																					<span class="pull-right" id="countDown"></span>
																				</h4>
																			</div>
																		  </div>
																		  <div class="media-right">
																		  </div>
																		</div>
																	</li>
																';}
							/*warning*/		elseif($prog < 50){echo'<li class="list-group-item waves-effect waves-classic" style="padding-left: 10px;">
																		<div class="media">
																		  <div class="media-left">
																			<a class="avatar" href="javascript:void()" data-target="#examplePositionSidebar" data-toggle="modal" onclick ="getonceof(groupID='.$groupID.')">
																			  <img class="img-responsive" src="proimg/'.$adminID.'.jpg" alt="...">
																			</a>
																		  </div>
																		  <div class="media-body">
																		   <h4 class="media-heading">'.$groupName.' <small> Organised by:'.$adminName.': </small><span class="pull-right" id="countDown">12 Days</span></h4>
																			<div class="progress progress-xs" style="margin-bottom: 0px;">
																			  <div class="progress-bar progress-bar-warning progress-bar-indicating active" style="width: '.$progressing.';" role="progressbar">
																				<span class="sr-only">'.$progressing.' Complete</span>
																			  </div>
																			</div>
																			<div>
																				<h4><small>'.number_format($currentAmount).'/</small>'.number_format($saving).' Rwf
																					<span class="pull-right" id="countDown"></span>
																				</h4>
																			</div>
																		  </div>
																		  <div class="media-right">
																		  </div>
																		</div>
																	</li>
																';}
							/*info*/		elseif($prog < 80){echo'<li class="list-group-item waves-effect waves-classic" style="padding-left: 10px;">
																		<div class="media">
																		  <div class="media-left">
																			<a class="avatar" href="javascript:void()" data-target="#examplePositionSidebar" data-toggle="modal" onclick ="getonceof(groupID='.$groupID.')">
																			  <img class="img-responsive" src="proimg/'.$adminID.'.jpg" alt="...">
																			</a>
																		  </div>
																		  <div class="media-body">
																		   <h4 class="media-heading">'.$groupName.' <small> Organised by:'.$adminName.': </small><span class="pull-right" id="countDown">12 Days</span></h4>
																			<div class="progress progress-xs" style="margin-bottom: 0px;">
																			  <div class="progress-bar progress-bar-info progress-bar-indicating active" style="width: '.$progressing.';" role="progressbar">
																				<span class="sr-only">'.$progressing.' Complete</span>
																			  </div>
																			</div>
																			<div>
																				<h4><small>'.number_format($currentAmount).'/</small>'.number_format($saving).' Rwf
																					<span class="pull-right" id="countDown"></span>
																				</h4>
																			</div>
																		  </div>
																		  <div class="media-right">
																		  </div>
																		</div>
																	</li>
																';}
							/*success*/		elseif($prog < 99){echo'<li class="list-group-item waves-effect waves-classic" style="padding-left: 10px;">
																		<div class="media">
																		  <div class="media-left">
																			<a class="avatar" href="javascript:void()" data-target="#examplePositionSidebar" data-toggle="modal" onclick ="getonceof(groupID='.$groupID.')">
																			  <img class="img-responsive" src="proimg/'.$adminID.'.jpg" alt="...">
																			</a>
																		  </div>
																		  <div class="media-body">
																		   <h4 class="media-heading">'.$groupName.' <small> Organised by:'.$adminName.': </small><span class="pull-right" id="countDown">12 Days</span></h4>
																			<div class="progress progress-xs" style="margin-bottom: 0px;">
																			  <div class="progress-bar progress-bar-success progress-bar-indicating active" style="width: '.$progressing.';" role="progressbar">
																				<span class="sr-only">'.$progressing.' Complete</span>
																			  </div>
																			</div>
																			<div>
																				<h4><small>'.number_format($currentAmount).'/</small>'.number_format($saving).' Rwf
																					<span class="pull-right" id="countDown"></span>
																				</h4>
																			</div>
																		  </div>
																		  <div class="media-right">
																		  </div>
																		</div>
																	</li>
																';}
							/*done*/		elseif($prog > 99){echo'<li class="list-group-item waves-effect waves-classic" style="padding-left: 10px;">
																		<div class="media">
																		  <div class="media-left">
																			<a class="avatar" href="javascript:void()" data-target="#examplePositionSidebar" data-toggle="modal" onclick ="getonceof(groupID='.$groupID.')">
																			  <img class="img-responsive" src="proimg/'.$adminID.'.jpg" alt="...">
																			</a>
																		  </div>
																		  <div class="media-body">
																		   <h4 class="media-heading">'.$groupName.' <small> Organised by:'.$adminName.': </small><span class="pull-right" id="countDown">12 Days</span></h4>
																			<div class="progress progress-xs" style="margin-bottom: 0px;">
																			  <div class="progress-bar progress-bar-dark progress-bar-indicating active" style="width: '.$progressing.';" role="progressbar">
																				<span class="sr-only">'.$progressing.' Complete</span>
																			  </div>
																			</div>
																			<div>
																				<h4><small>'.number_format($currentAmount).'/</small>'.number_format($saving).' Rwf
																					<span class="pull-right" id="countDown"></span>p
																				</h4>
																			</div>
																		  </div>
																		  <div class="media-right">
																		  </div>
																		</div>
																	</li>
																';}
								}
							?>
						</ul>
					</div>
				</div>
			  </div>
		</div>
		
    </div>
  </div>


    <!-- Modal -->
                        <div class="modal fade" id="examplePositionSidebar" aria-hidden="true" role="dialog" tabindex="-21">
							<div class="modal-dialog modal-sidebar modal-md masonry-item" style=" -webkit-justify-content: unset;">
								<div class="widget widget-article widget-shadow" id="widgetUserList">
									<div id="onceofInfo">  </div>
								</div>
							</div>
						</div>
                        <!-- End Modal -->
<?php include ("template/footer.php");?>

<?php 
	$nowthis = date_create($contributionDate);
	$year = date_format($nowthis, "Y");
	$month = date_format($nowthis, "n");
	$day = date_format($nowthis, "j");
?>
  <script>
  $(document).ready(function(){
	  var year1 = " <?php echo $year ?> ";
	  var month2 = " <?php echo $month ?> ";
	  var day3 = " <?php echo $day ?> ";
		$('#countDown').revolver({
			year : year1,	
			month : month2,	
			day : day3,	
		});
	});
	</script>
	<script type="text/javascript" src="assets/js/timer.js"></script>
	
</body>

</html>