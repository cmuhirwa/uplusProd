<!--<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_donations">
    
	
	<input type="hidden" name="business" value="info@uplus.rw">
	<input type="hidden" name="item_name" value="Contribution of: Murekatete Ubukwe">
	<input type="hidden" name="item_number" value="123">    
-->
	

<?php
if(isset($_GET['contribut'])){
	echo'<div class="widget-body widget-content" style="background-color: #fff; height:100%;">
  <div class="example-wrap"><div class="row text-center">
	<div class="col-lg-12">
		 <div class="form-group">
			  <div class="input-group">
				<input type="number" class="form-control focus" id="contributedAmount" placeholder="Ammount">
				<span class="input-group-addon">Rwf</span>
			  </div>
			  <div id="amountError" style="color: #f44336;"></div>
			</div>
	</div>	
</div>	
<div class="row text-center">
	<a href="javascript:void()" onclick="payement2(method=1)"><div class="col-lg-3 col-xs-5" style="background-image: url(proimg/banks/1.jpg); background-size: 100% 100%; height: 90px; margin: 5px; box-shadow: 0.5px 0.5px 0.25px 0.25px #888888;"></div></a>
	<a href="javascript:void()" onclick="payement2(method=2)"><div class="col-lg-3 col-xs-5" style="background-image: url(proimg/banks/2.jpg); background-size: 100% 100%; height: 90px; margin: 5px; box-shadow: 0.5px 0.5px 0.25px 0.25px #888888;"></div></a>
	<a href="javascript:void()" onclick="payement2(method=3)"><div class="col-lg-3 col-xs-5" style="background-image: url(proimg/banks/3.jpg); background-size: 100% 100%; height: 90px; margin: 5px; box-shadow: 0.5px 0.5px 0.25px 0.25px #888888;"></div></a>
	<a href="javascript:void()" onclick="payement2(method=4)"><div class="col-lg-3 col-xs-5" style="background-image: url(proimg/banks/4.png); background-size: 100% 100%; height: 90px; margin: 5px; box-shadow: 0.5px 0.5px 0.25px 0.25px #888888;"></div></a>

	<a href="#"><div class="col-lg-3 col-xs-5" style="background-image: url(proimg/banks/6.png); background-size: 100% 100%; height: 90px; margin: 5px; box-shadow: 0.5px 0.5px 0.25px 0.25px #888888;"></div></a>
</div></div></div>




';
}
elseif(isset($_GET['method'])){
	
	session_start();
	$method = $_GET['method'];
	$contributedAmount = $_GET['contributedAmount'];
	
	$bankaccount = $_SESSION["bankaccount"];
	$groupBank = $_SESSION["groupBank"];
	
	echo'<input type="text" hidden id="amountdone" value="'.$contributedAmount.'">';
	echo'<input type="text" hidden id="sendToAccount" value="'.$bankaccount.'">';
	echo'<input type="text" hidden id="sendToBank" value="'.$groupBank.'">';
			
if($method == '1'){
	echo'
	<div class="widget-body widget-content"  style="background-color: #FFBE00; height:100%;">
			<button class="btn btn-round btn-dark btn-raised" onclick="payementOptions()">
				<i class="icon md-arrow-left"></i>
			</button>
		<div id="doneMtn" class="pull-right"></div>
		<hr/>
  <div class="example-wrap" id="donetransfer">
<div class="row text-center">
	<div class="col-lg-12" id="sendingInfo">
		<div class="form-group">
		  <div class="input-group">
			<span class="input-group-addon">+25078</span>
			<input type="number" onkeyup="handleChange(this);" id="mtnnumber" class="form-control" placeholder="MTN Phone number">
		  </div>
		</div>
		<input id="method" value="'.$method.'" hidden>
		<div id="alowMtn">
			Enter your MTN number after 078
		</div>
	</div>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
</div></div>	
</div>	
';}
elseif($method == '2'){echo'
	<div class="widget-body widget-content"  style="background-color: #002e6e; height:100%;">
	<button class="btn btn-round btn-dark btn-raised btn" onclick="payementOptions()"><i class="icon md-arrow-left"></i></button>
	<div id="doneMtn" class="pull-right"></div>
		<hr/>
  <div class="example-wrap">
<div class="row text-center">
	<div class="col-lg-12" >
		<div class="form-group">
		  <div class="input-group">
			<span class="input-group-addon">+2507'.$method.'</span>
			<input type="number" onkeyup="handleChange(this);" id="mtnnumber" class="form-control" placeholder="TIGO Phone number">
		  </div>
		</div>
		<input id="method" value="'.$method.'" hidden>
		<div id="alowMtn" style="color: #fff;">
			Enter your TIGO number after 07'.$method.'
		</div>
	</div>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
</div></div>	
</div>	
';}
elseif($method == '3'){echo'
	<div class="widget-body widget-content"  style="background-color: #db030c; height:100%;">
	<button class="btn btn-round btn-dark btn-raised btn" onclick="payementOptions()"><i class="icon md-arrow-left"></i></button>
	<div id="doneMtn" class="pull-right"></div>
		<hr/>
  <div class="example-wrap">
<div class="row text-center">
	<div class="col-lg-12" >
		<div class="form-group">
		  <div class="input-group">
			<span class="input-group-addon">+2507'.$method.'</span>
			<input type="number" onkeyup="handleChange(this);" id="mtnnumber" class="form-control" placeholder="AIRTEL Phone number">
		
		  </div>
		</div>	
		<input id="method" value="'.$method.'" hidden>
		<div id="alowMtn" style="color: #fff;">
			Enter your AIRTEL number after 07'.$method.'
		</div>
	</div>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
</div></div>	
</div>	
';}
elseif($method == '4'){echo'
<div class="panel-body container-fluid" style="background-color: #fff; height:100%;">
 <button class="btn btn-round btn-dark btn-raised btn" onclick="payementOptions()"><i class="icon md-arrow-left"></i></button>
	<div id="doneMtn" class="pull-right"></div>
		<hr/>
<div class="row">
	<div class="col-lg-12 form-group">
	  <div class="example-responsive example form-group">
		<div class="col-lg-12 col-md-12 clearfix form-group">
		  <div class="card-wrapper pull-left" id="cardContainer"></div>
		</div>
	  </div>
	  <div class="col-lg-12 col-md-12">
		<div class="example-wrap">
		  <form class="card" data-plugin="card" data-target="#cardContainer">
			<div class="form-group col-lg-6">
			  <input type="text" class="form-control" id="inputCardNumber" name="number" placeholder="Card number">
			</div>
			<div class="form-group col-lg-6">
			  <input type="text" class="form-control" id="inputFullName" name="name" placeholder="Full name">
			</div>
			<div class="form-group col-lg-6">
			  <input type="text" class="form-control" id="inputExpiry" name="expiry" placeholder="MM/YY">
			</div>
			<div class="form-group col-lg-6">
			  <input type="text" class="form-control" id="inputCVC" name="cvc" placeholder="CVC">
			</div>
		  </form>
		</div>
	  </div>
	</div>
  </div>
  <!-- End Example Card -->
</div>
';}
}
?>
<script>
  function handleChange(input) {
	  var method = document.getElementById('method').value;
	  if (method == '1') {
		  var opperator = 'MTN';
		  var errorcolor = '#9c27b0;';
		  }
	  else if (method == '2') {
		  var opperator = 'TIGO';
		  var errorcolor = '#fff;';
		  }
	  else if (method == '3') {
		  var opperator = 'AIRTEL';
		  var errorcolor = '#fff;';
		  }
    if ( input.value < 1000000) {
		document.getElementById('alowMtn').innerHTML = '<div style="color: '+errorcolor+'"> Keep typing till you get a Done button</div>';
		document.getElementById('doneMtn').innerHTML = '';
	}
    else if (input.value > 9999999) {
		document.getElementById('alowMtn').innerHTML = '<div style="color: '+errorcolor+'">Please enter a valid '+opperator+' Rwanda number</div>';
		document.getElementById('doneMtn').innerHTML = '';
	}else{
		document.getElementById('alowMtn').innerHTML = '';
		document.getElementById('doneMtn').innerHTML = '<button class="btn btn-success btn-raised btn-round" onclick="kwishura()"><i class="icon md-check"></i>Done</button>';
	}
  }
  
</script>
<script>
// Display a recurrunf Invitation
function kwishura(){
	var sentAmount			= document.getElementById('amountdone').value;
	var sendFromAccount		= document.getElementById('mtnnumber').value;
	var sendFromBank		= document.getElementById('method').value;
	var sendToBank			= document.getElementById('sendToBank').value;
	var sendToAccount		= document.getElementById('sendToAccount').value;
	var sendFromAccount = '078'+sendFromAccount;	
	document.getElementById('donetransfer').innerHTML = '<div style="text-align: center;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
	$.ajax({
			type : "GET",
			url : "3rdparty/rtgs/transfer.php",
			dataType : "html",
			cache : "false",
			data : {
				
				sentAmount		:	sentAmount,	
				sendFromAccount	:	sendFromAccount,	
				sendFromBank	:   sendFromBank,	
				sendToBank		:   sendToBank,		
				sendToAccount	:   sendToAccount,		
			},
			success : function(html, textStatus){
				$("#donetransfer").html(html);
				document.getElementById('doneMtn').innerHTML = '';
			},
			error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			}
	});
}
</script>
	
	
<!--	
</form>-->
