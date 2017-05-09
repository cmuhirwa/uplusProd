<?php
if (isset($_GET['groupID'])){	
		$groupID = $_GET['groupID'];
		include "../db.php"; 
		$sql2 = $db->query("SELECT * FROM accounts WHERE id='$groupID'"); 
		while($row = mysqli_fetch_array($sql2)){ 
			$groupName = $row["accName"];
			$saving = round($row['saving']);
			$adminPhone = $row['adminPhone'];
			$adminName = $row['adminName'];
			//$currentAmount = round($row['currentAmount']);
			$groupDescription = $row["groupDesc"];
			$custommessage = $row["custommessage"];
			$replymessage = $row["replymessage"];
			$contributionDate = $row["opening"];
			
			session_start();
			$bankaccount = $row["bankaccount"];
			$_SESSION["bankaccount"] = $bankaccount;
			$groupBank = $row["groupBank"];
			$_SESSION["groupBank"] = $groupBank;
		}
		$sqladminID = $db->query("SELECT id adminID FROM users WHERE phone = '$adminPhone'");
		$fetchAdminID = $rowAdminID = mysqli_fetch_array($sqladminID);
		$adminID = $rowAdminID["adminID"];
		
		
		$outCon = mysqli_connect("localhost","root","","rtgs");
		$sqlbalance = $outCon->query("SELECT * FROM balance WHERE accountNumber = '$bankaccount'");
		$rowbalance = mysqli_fetch_array($sqlbalance);
		$balance = $rowbalance['Balance'];
		
		$prog = $balance*100/$saving;
		$progressing=''.$prog.'%';
		if($balance == ''){
			$balance = 0;
		}
			
	}
else{
	echo 'nothig isset';
}
?>

<div class="widget-header cover overlay text-center" style="padding:unset;">
	<div class="cover-background" style="background-image: url(proimg/groupimg/<?php echo $groupID;?>.jpg)">
	<div class="vertical-align padding-horizontal-0">
	  <div class="vertical-align-bottom width-full">
		<br/>
		<br/>
		<br/>
		<br/><h3 class="white"><?php echo $groupName;?></h3>
		<div id="contributNow"><button type="button" class="btn btn-primary btn-round btn-raised btn" onclick="payementOptions()">CONTRIBUTE NOW</button>
		</div><br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<div class="overlay-panel overlay-background overlay-bottom">
                <div class="row no-space">
                  <div class="col-xs-6">
                    <a class="avatar avatar-lg bg-white pull-left margin-right-20 img-bordered" href="javascript:void(0)" data-dismiss="modal">
                      <img src="proimg/<?php echo $adminID;?>.jpg" alt="">
                    </a>
                    <div>
                      <div class="font-size-20"><?php echo $adminName;?></div>
                      <div class="font-size-14">Organizer</div>
                    </div>
                  </div>
                  <div class="col-xs-6">
                    <div class="row no-space text-center">
                      <div class="col-xs-6">
                        <div class="counter counter-inverse">
                          <div class="counter-label">Raised</div>
                          <span class="counter-number"><?php echo number_format($balance);?><small>Rwf</small></span>
                        </div>
                      </div>
                      <div class="col-xs-6">
                        <div class="counter counter-inverse">
                          <div class="counter-label">Target</div>
                          <span class="counter-number"><?php echo number_format($saving);?><small>Rwf</small></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
	  
	  </div>
	</div>
  </div>
 
	<?php 
	/*danger*/		if($prog < 30){echo' 
	<div class="progress progress-sm" style="margin-bottom: 0px;">
		<div class="progress-bar progress-bar-danger progress-bar-indicating active" style="width:'.$progressing.';" role="progressbar">
			<span class="sr-only">'.$progressing.' Complete</span>
		</div>
	</div>
	';}
	/*danger*/		elseif($prog < 50){echo'
	 <div class="progress progress-sm" style="margin-bottom: 0px;">
	 <div class="progress-bar progress-bar-warning progress-bar-indicating active" style="width: '.$progressing.';" role="progressbar">
		<span class="sr-only">'.$progressing.' Complete</span>
	</div>
	</div>
	';}
	/*danger*/		elseif($prog < 80){echo'
	 <div class="progress progress-sm" style="margin-bottom: 0px;">
	 <div class="progress-bar progress-bar-info progress-bar-indicating active" style="width: '.$progressing.';" role="progressbar">
		<span class="sr-only">'.$progressing.' Complete</span>
	</div>
	</div>
	';}
	/*danger*/		elseif($prog < 99){echo'
	 <div class="progress progress-sm" style="margin-bottom: 0px;">
	 <div class="progress-bar progress-bar-success progress-bar-indicating active" style="width: '.$progressing.';" role="progressbar">
		<span class="sr-only">'.$progressing.' Complete</span>
	</div>
	</div>
	';}
	/*danger*/		elseif($prog > 99){echo'
	 <div class="progress progress-sm" style="margin-bottom: 0px;">
	 <div class="progress-bar progress-bar-dark progress-bar-indicating active" style="width: '.$progressing.';" role="progressbar">
		<span class="sr-only">'.$progressing.' Complete</span>
	</div>
	</div>
	';}
	
	?>
	



</div>
<div  id="contBody">
<div class="widget-body widget-content" style="background-color: #fff; height:100%;">
  <div class="example-wrap">
				<div class="nav-tabs-horizontal nav-tabs-inverse nav-tabs-animate">
				  <ul class="nav nav-tabs" data-plugin="nav-tabs" role="tablist">
					<li role="presentation" class="active">
						<a data-toggle="tab" href="#informations" aria-controls="informations" role="tab" aria-expanded="false">
							<i class="icon md-group-work"></i>Info
						</a>
					</li>
					<li role="presentation">
						<a data-toggle="tab" href="#msgChat" aria-controls="msgChat" role="tab" aria-expanded="false">
							<i class="icon md-comments"></i>Chat
						</a>
					</li>
					<li role="presentation">
						<a data-toggle="tab" href="#exampleTabsInverseTwo" aria-controls="exampleTabsInverseTwo" role="tab" aria-expanded="false">
						  <span class="badge badge-danger"><?php 
							include "../db.php"; 
							$sqlTotalJoin = $db->query("SELECT * FROM joined_ua WHERE groupId='$groupID' and acceptance='yes'")or mysqli_error();
							$noTotalJoin = mysqli_num_rows($sqlTotalJoin);
							echo $noTotalJoin;
							?></span> Joined
						</a>
					</li>
					<li role="presentation">
					   <a data-toggle="tab" href="#exampleTabsInverseOne" aria-controls="exampleTabsInverseOne" role="tab" aria-expanded="true">
						<span class="badge badge-default">
						  <?php 
							include "../db.php"; 
							$sqlTotalInv = $db->query("SELECT * FROM joined_ua WHERE groupId='$groupID'")or mysqli_error();
							$noTotalInv = mysqli_num_rows($sqlTotalInv);
							echo $noTotalInv;
							?>
						</span> Invited
					   </a>
					</li>
				  </ul>
				  <div class="tab-content padding-20">
					<div class="tab-pane animation-slide-left active" id="informations" role="tabpanel">
						<h4><?php echo $groupName;?> </h4>
						<h5>Contribution Description:</h5><?php echo $groupDescription;?>
						
								<address>
								Location : Kigali/ Kimironko Isangano
								<br>
								<abbr title="Account where the money is sent">Physical Account</abbr>&nbsp;&nbsp;<?php echo ''.$bankaccount.' in '.$groupBank;?>
								<br>
								<abbr title="Phone">Phone:</abbr>&nbsp;&nbsp;<?php echo $adminPhone;?>
							  </address>
					</div>
					<div class="tab-pane animation-slide-left" id="msgChat" role="tabpanel">
						<div class="chats-wrap">
							<div class="chats">
							  <div class="chat">
								<div class="chat-body">
								  <div class="text-left">
									  <a class="avatar margin-left-0" data-toggle="tooltip" href="#" data-placement="left"
									  title="June Lane">
										<img src="proimg/<?php echo $adminID;?>.jpg" alt="...">
									  </a>
									</div>
								  <div class="chat-content" data-toggle="tooltip" title="8:30 am">
									<p>
									  Hello. Wellcome to the <?php echo$groupName;?> chat.
									  share your thoughts with the group member here.
									</p>
									
								  </div>
								</div>
							  </div>
							 <!-- <div class="chat chat-right">
								<div class="chat-body">
									<div class="text-right">
									  <a class="avatar margin-left-15" data-toggle="tooltip" href="#" data-placement="left"
									  title="June Lane">
										<img src="proimg/4.jpg" alt="...">
									  </a>
									</div>
								  <div class="chat-content" data-toggle="tooltip" title="8:35 am">
									<p>
									  I'm just looking around.
									</p>
									<p>Will you tell me something about yourself? </p>
								  </div>
								</div>
							  </div>
							--></div>
						</div>
						<!-- Message Input-->
						<hr/>
						<div class="app-message-input">
							<div class="input-group form-material">
							  <span class="input-group-btn">
								<a href="javascript: void(0)" class="btn btn-pure btn-default icon md-camera"></a>
							  </span>
							  <input class="form-control" type="text" placeholder="Type message here ...">
							  <span class="input-group-btn">
								<button type="button" class="btn btn-pure btn-default icon md-mail-send"></button>
							  </span>
							</div>
						</div>
						<!-- End Message Input-->
					</div>
					<div class="tab-pane animation-slide-left" id="exampleTabsInverseTwo" role="tabpanel">
						
						  <div class="input-search input-search-dark">
							<i class="input-search-icon md-search" aria-hidden="true"></i>
							<input type="text" class="form-control" name="" placeholder="Search...">
						  </div>
						
						<br>
						<ul class="list-group list-group-dividered list-group-full">
						   <?php 
							include "../db.php"; 
							$sqljioned = $db->query("SELECT * FROM joined_ua WHERE groupId='$groupID' AND acceptance ='yes'")or mysqli_error();
							$no_joined = mysqli_num_rows($sqljioned);
							if($no_joined > 0){
									while($row2 = mysqli_fetch_array($sqljioned)){ 
										echo'<li class="list-group-item">
									<div class="media">
									  <div class="media-left">
										<a class="avatar" href="javascript:void(0)">
										  <img class="img-responsive" src="proimg/'.$row2['userId'].'.jpg" alt="...">
										</a>
									  </div>
									  <div class="media-body">
										<h4 class="media-heading">'.$row2['userName'].'</h4>
										<small>'.$row2['userPhone'].'</small>
									  </div>
									  <div class="media-right">
										
									  </div>
									</div>
								  </li>
								 ';
								}
							}else{
								echo'no one has contributed yet';
							}
						  ?>
						</ul>
					</div>
					<div class="tab-pane animation-slide-right" id="exampleTabsInverseOne" role="tabpanel">
					
						  <div class="input-search input-search-dark">
							<i class="input-search-icon md-search" aria-hidden="true"></i>
							<input type="text" class="form-control" name="" placeholder="Search...">
						  </div>
						
						<br>
					  <ul class="list-group list-group-dividered list-group-full">
					  <?php 
						include "../db.php"; 
						$sqlinvited = $db->query("SELECT * FROM joined_ua WHERE groupId='$groupID' AND acceptance ='no'")or mysqli_error();
						$no_invited = mysqli_num_rows($sqlinvited);
						$ninvited = 0;
						if($no_invited >0){
						while($row1 = mysqli_fetch_array($sqlinvited)){ 
							$status = rand(1,2);
						if($status == 1){	
								$printStatus ='online';
							}elseif($status == 2){	
								$printStatus ='away';
							}
						
							$ninvited++;
							echo'<li class="list-group-item">
									<div class="media">
									  <div class="media-left">
										'.$ninvited.' 
									  </div>
									  <div class="media-body">
										<h4 class="media-heading">'.$row1['userPhone'].'</h4>
									  </div>
									  <div class="media-right">
										<span class="status status-lg status-'.$printStatus.'"></span>
									  </div>
									</div>
								</li>';
						}}else{
							echo'Cool! all the invities have contributed';
						}
					  ?>
					</ul>
					</div>
				  </div>
				</div>
			  </div>
</div>
</div>