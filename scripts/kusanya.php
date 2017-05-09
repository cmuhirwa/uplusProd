<?php 
// 1 Display A RECURRING
if (isset($_GET["myId"])) {
	//
	$myId = $_GET["myId"]; 
	$groupId = $_GET["groupId"]; 
	include "../db.php";
	$sqlBringGroupInfo = $db->query("SELECT * FROM `joined_ua` WHERE `groupId`='$groupId' AND userId='$myId'");
	$rowGroupInfo = mysqli_fetch_array($sqlBringGroupInfo);
		$groupName 		= $rowGroupInfo['groupName'];
		$adminName 		= $rowGroupInfo['adminName'];
		$adminPhone 	= $rowGroupInfo['adminPhone'];
		$bankaccount 	= $rowGroupInfo['bankaccount'];
		$groupBank 		= $rowGroupInfo['groupBank'];
		$groupDesc 		= $rowGroupInfo['groupDesc'];
		$userBank 		= $rowGroupInfo['userBank'];
		$userAccount 	= $rowGroupInfo['userAccount'];
		$userComitment 	= $rowGroupInfo['userComitment'];
		$userEveryDate 	= $rowGroupInfo['userEveryDate'];
	$sqlBankName = $db->query("SELECT name FROM financial_inst WHERE id ='$userBank'");
	$rowBankName = mysqli_fetch_array($sqlBankName);
	$bankName = $rowBankName['name'];
	
	$sqlGroupBankName = $db->query("SELECT name FROM financial_inst WHERE id ='$groupBank'");
	$rowGroupBankName = mysqli_fetch_array($sqlGroupBankName);
	$GroupBankName = $rowGroupBankName['name'];
	echo'<div class="col-md-6 col-xs-12 masonry-item">
          <div class="widget widget-shadow background-bottom">
            <div class="widget-header cover overlay">
				<iframe class="cover-background height-250" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3987.5216655146846!2d30.08739431429665!3d-1.944149998582609!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMcKwNTYnMzguOSJTIDMwwrAwNScyMi41IkU!5e0!3m2!1sen!2srw!4v1480524893899" frameborder="0" style="border:0" allowfullscreen></iframe>
				<div class="overlay-panel overlay-background overlay-bottom">
					<div class="row no-space">
					  <div class="col-xs-6">
						<a class="avatar avatar-lg bg-white pull-left margin-right-20 img-bordered" href="javascript:void(0)">
						  <img src="proimg/1.jpg" alt="">
						</a>
						<div>
						  <div class="font-size-18">'.$groupName.'</div>
						  <div class="font-size-12">By: '.$adminName.'</div>
						</div>
					  </div>
					  <div class="col-xs-6">
						<div class="row no-space text-center">
						 <div class="col-xs-8">
							<div class="counter counter-inverse">
							  <div class="counter-label">Amount (Rwf)</div>
							  <span class="counter-number">'.number_format($userComitment).'</span>
							</div>
						  </div>
						  <div class="col-xs-4">
							<div class="counter counter-inverse">
							  <div class="counter-label">On</div>
							  <span class="counter-number">'.$userEveryDate.'<small>th</small></span>
							</div>
						  </div>
						</div>
					  </div>
					</div>
				</div>
            </div>
			<div class="widget-body widget-content" style="background-color: #fff; padding: unset; height:100%;">
				<div class="nav-tabs-horizontal">
					<ul class="nav nav-tabs nav-tabs-line" data-plugin="nav-tabs" role="tablist">
						<li role="presentation" class="active">
							<a data-toggle="tab" href="#informations" aria-controls="informations" role="tab" aria-expanded="false">
								<i class="icon md-group-work"></i>INFO
							</a>
						</li>
						<li role="presentation" >
							<a data-toggle="tab" href="#settings" aria-controls="informations" role="tab" aria-expanded="false">
								<i class="icon md-wrench"></i>SETTINGS
							</a>
						</li>
						<li role="presentation" >
							<a data-toggle="tab" href="#stetment" aria-controls="informations" role="tab" aria-expanded="false">
								<i class="icon md-portable-wifi-changes"></i>STATMENT
							</a>
						</li>
						<li role="presentation">
							<a data-toggle="tab" href="#msgChat" aria-controls="msgChat" role="tab" aria-expanded="false">
								<i class="icon md-comments"></i>ASK!
							</a>
						</li>
					</ul>
					<div class="tab-content padding-20">
						<div class="tab-pane active" id="informations" role="tabpanel">
							<h4>'.$groupName.' <small>Admin: '.$adminName.'</small></h4>
							<p><span class="drop-cap">C</span>'.$groupDesc.'.</p>
							<div class="row">
							<!--	<div class="col-lg-3">
									Commity:
								</div>-->
								<div class="col-lg-12">
									<div class="row">
										<div class="col-lg-2 col-xs-2">
											<a class="avatar avatar" href="javascript:void(0)">
											  <img src="proimg/3.jpg" alt=""><br/><small>Pr. Gaby</small>
											</a>&nbsp;
										</div>
										<div class="col-lg-3 col-xs-5">
											<a class="avatar avatar" href="javascript:void(0)">
											  <img src="proimg/2.jpg" alt=""><br/><small>Ap. Paul Gitwaza</small>
											</a>
										</div>
										<div class="col-lg-3 col-xs-3">
											<a class="avatar avatar" href="javascript:void(0)">
											  <img src="proimg/4.jpg" alt=""><br/><small>Mrs. Viviane Caline</small>
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4">
									Physical Account:	
								</div>
								<div class="col-lg-8">
									'.$GroupBankName.' : '.$bankaccount.'
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4">
									Approved:
								</div>
								<div class="col-lg-8">
									 U+ Mutual Partners LtD
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4">
									Secured:
								</div>
								<div class="col-lg-8">
									Rswitch LTD
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4">
									Insured: 
								</div>
								<div class="col-lg-8">
									 Bank Of Kigali
								</div>
							</div>
						</div>
						<div class="tab-pane" id="stetment" role="tabpanel">
							<table class="table table-striped">
								<thead>
								  <tr>
									<th>Date</th>
									<th>Bank|Account</th>
									<th>Payment</th>
									<th>Amount</th>
									<th>Status</th>
								  </tr>
								</thead>
								<tbody>
								  <tr>
									<td>Dec 25,16</td>
									<td>MTN|0784848236</td>
									<td>
									  MOBILE
									</td>
									<td>30,000 Rwf</td>
									<td>
									<span class="badge badge-success">SUCCESS</span>
									</td>
								  </tr>
								</tbody>
							  </table>
						</div>
						<div class="tab-pane" id="settings" role="tabpanel">
							<div class="row">
								<div class="col-lg-4">COMMITED AMOUNT :</div> 
								<div class="col-lg-8 form-group">
								  <div class="input-group">
									<input class="form-control" type="text" value="'.number_format($userComitment).'" disabled>
									<span class="input-group-addon">Rwf</span>
								  </div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4">EACH DATE :</div> 
								<div class="col-lg-8 form-group">
									<div class="input-group">
										<input class="form-control" type="text" value="'.$userEveryDate.'th" disabled>
										<span class="input-group-addon">Of each month</span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4">FROM ACCOUNT :</div> 
								<div class="col-lg-8">
									<div class="row">
										<div class="col-lg-6 col-xs-6">
											<select class="form-control" disabled>
												<option >'.$bankName.'</option>
											</select>
										</div>
										<div class="col-lg-6 col-xs-6">
											<input class="form-control" type="text" value="'.$userAccount.'" disabled>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="msgChat" role="tabpanel">
							<div class="chats-wrap">
								<div class="chats">
								  <div class="chat">
									<div class="chat-body">
									  <div class="text-left">
										  <a class="avatar margin-left-0" data-toggle="tooltip" href="#" data-placement="left"
										  title="June Lane">
											<img src="proimg/1.jpg" alt="...">
										  </a>
										</div>
									  <div class="chat-content" data-toggle="tooltip" title="8:30 am">
										<p>
										  Hello. Welcome to '.$groupName.' contribution group. I`m here to help
										</p>
										
									  </div>
									</div>
								  </div>
								</div>
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
					</div>
				</div>
			 
			</div>
		  </div>
        </div>';
}

// 2 RECURRING INVITATION INFO
if (isset($_GET['group_id'])){
	$group_id = $_GET['group_id'];
	$G_personalID = $_GET['G_personalID'];
	include("../db.php");
	$sql_personel = $db->query("SELECT `name` FROM `users` WHERE `id` = '$G_personalID'");
	while($row = mysqli_fetch_array($sql_personel))
	{
		$personel_names = $row['name'];
	}
	$sql = $db->query("SELECT * FROM accounts WHERE ID = '$group_id'")or die (mysqli_error());
	$sql2 = $db->query("SELECT * FROM account_user WHERE accountID = '$group_id' AND acceptance = 'yes'")or die (mysqli_error());
	$sql3 = $db->query("SELECT id FROM account_user WHERE accountID = '$group_id' AND userID = '$G_personalID'")or die (mysqli_error());
	while($row = mysqli_fetch_array($sql3)){
		$idtodelete = $row['id'];
	}
	$n = mysqli_num_rows($sql2);
	while($row = mysqli_fetch_array($sql)){
		$groupName = $row['accName'];
		$bankaccount = $row['bankaccount'];
		$groupBank = $row['groupBank'];
		$G_ad_name = $row['adminName'];
		$groupDesc = $row['groupDesc'];
		$time = date("d-m", strtotime($row["opening"]));
	$sqlBankName = $db->query("SELECT name FROM financial_inst WHERE id ='$groupBank'");
	$rowBankName = mysqli_fetch_array($sqlBankName);
	$bankName = $rowBankName['name'];
	
	}
	echo '  
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		  </button>
		  <h4 class="modal-title" ><b>Invitation of '.$groupName.'</b></h4>
		</div>
		<div class="modal-body" >
			<div id="G_info">
			Your have been invited by '.$G_ad_name.' to join '.$groupName.'.<br/>
			
			<ul>
				<li>What is '.$groupName.'? 
					<p>'.$groupDesc.'.
					<b>'.$G_ad_name.'</b> Is the Treasure and Xname,Yname, Zname are the managers				
					</p>
				</li>
				<li>Where does your money go?
					<p>
						After your money is collected, It is automaticaly transferd
						into an account of ('.$groupName.') in ('.$bankName.') account Number: ('.$bankaccount.') 
					</p>
				</li>
				<li>What is the privacy and security of your transfer?
					<p>
						Your data are protected by an end to end encription
						provided by uplus security layers.
						And your transfer is secured by Rswitch and Insured by Bank of Kigali<br/>
						In case they could be a loss, you can claim and we shall refund you in
						24 hours
					</p>
				</li>
			</ul>
			
			<a href="javascript:void()" onclick="nextAcptRecInv(group_id= '.$group_id.', G_personalID='.$G_personalID.')" class="btn btn-success">NEXT</a>
		</div>
		</div>
	</div>
	';
}
?>
<script>
// Display a recurrunf Invitation
function nextAcptRecInv(group_id, G_personalID){
	document.getElementById('G_info').innerHTML = '<div style="text-align: center;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
	$.ajax({
			type : "GET",
			url : "scripts/kusanya.php",
			dataType : "html",
			cache : "false",
			data : {
				
				grouCompId : group_id,
				personCompId : G_personalID,
			},
			success : function(html, textStatus){
				$("#G_info").html(html);
			},
			error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			}
	});
}
</script>
<?php
// 3 RECURRING INVITATION CONNECT
if (isset($_GET['grouCompId'])){
	$groupId = $_GET['grouCompId'];
	$G_personalID = $_GET['personCompId'];
	
	include"../db.php";
	$sqlAccountUser = $db->query("SELECT id FROM account_user WHERE accountID='$groupId' AND userId='$G_personalID'");
	$rowId = mysqli_fetch_array($sqlAccountUser);
	$joinId = $rowId['id'];
	$sql_banks = $db->query("SELECT name, id FROM financial_inst");
	$disp_bank ="";
	while($row = mysqli_fetch_array($sql_banks)){
		$bank_names = $row['name'];
		$bankId = $row['id'];
		$disp_bank.='

<option value="'.$bankId.'">'.$bank_names.'</option>';
		
	}
	
	echo'<h5><u>Whats Next?</u></h5>
			<ul>	
				<li> Reminder: You can connect to this group as an auto reminder of when to pay amount X to
				 then on that date we shall remind you and give you an option to auto pay via Mobile Money or Visa Cards
				</li>
				<li>
					Auto-Collect: You can connect to this group as an Auto collector sipecifying amount, date and Account
					then on that date we shall only ask you to confirm a transfer which can be aborted in 48 hours.
				</li>
			</ul>
			<i class="icon md-cotion"></i>If you know this group you can join it, Otherwise reject the invitation.
			
			<hr/>
			<div class="row">
				<div class="col-lg-6 form-group">
					<label class="control-label">Date To Collect:</label>
					<input type="number" min="1" max="30" id="collDate" class="form-control focus">
				</div>
				<div class="col-lg-6 form-group" >
					<label class="control-label">COMMITED AMOUNT <em>(optional)</em>:</label>
					<input type="number" id="collAmount" min="200" class="form-control" placeholder="Rwf">
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 form-group">
					<label class="control-label">PULL FROM BANK/ PHONE <em>(optional)</em>:</label>
					<select class="form-control" id="collBank">
						<option>Select Bank or Mobile Money</option>
						'.$disp_bank.'
					</select>
				</div>
				<div class="col-lg-6 form-group" >
					<label class="control-label">PULL FROM ACCOUNT/ <em>(optional)</em>:</label>
					<input type="text" id="collAccount" class="form-control" placeholder="eg: 07888888 or Bank Accounr">
					<input type="text" id="collJoinId" value="'.$joinId.'" hidden>
				</div>
			</div>
		<a href="javascript:void()" onclick="connectRecurring()" class="btn btn-success">CONNECT</a>
		<a href="scripts/testlog.php?idtodelete='.$joinId.'" class="pull-right btn btn-danger">REJECT</a>
		';
}
?>
<script>
// Display a recurrunf Invitation
function connectRecurring(){
	var collDate = document.getElementById('collDate').value;
	var collAmount = document.getElementById('collAmount').value;
	var collBank = document.getElementById('collBank').value;
	var collAccount = document.getElementById('collAccount').value;
	var collJoinId = document.getElementById('collJoinId').value;
	
	document.getElementById('G_info').innerHTML = '<div style="text-align: center;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
	$.ajax({
			type : "GET",
			url : "scripts/kusanya.php",
			dataType : "html",
			cache : "false",
			data : {
				
				collDate : collDate,
				collAmount : collAmount,
				collBank : collBank,
				collAccount : collAccount,
				collJoinId : collJoinId,
			},
			success : function(html, textStatus){
				$("#G_info").html(html);
			},
			error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			}
	});
}
</script>
<?php
// 4 CONNECT THE INVITATION
if (isset($_GET['collDate'])){
	$collDate = $_GET['collDate'];
	$collAmount = $_GET['collAmount'];
	$collBank = $_GET['collBank'];
	$collAccount = $_GET['collAccount'];
	$collJoinId = $_GET['collJoinId'];
	
	include"../db.php";
	$sqlAccountUser = $db->query("UPDATE account_user SET 
	commitedDate ='$collDate',
	commitment ='$collAmount',
	bankId ='$collBank',
	bankAccount ='$collAccount',
	type ='RECURRING',
	acceptance ='YES'
	WHERE id = '$collJoinId'
	");
	
	
	echo '<H3>CONGRATULATIONS</H3>
	Your account has been connected<br/><u><b>NB:</b></u> 
	You can disconnect or modify your settings any time <a href="recurring.php">CLICK HERE</a>';
	
}
?>