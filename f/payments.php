<style type="text/css">
.form-style-2{
    max-width: 500px;
    padding: 20px 12px 10px 20px;
    font: 13px Arial, Helvetica, sans-serif;
}
.form-style-2-heading{
    font-weight: bold;
    font-style: italic;
    border-bottom: 2px solid #ddd;
    margin-bottom: 20px;
    font-size: 15px;
    padding-bottom: 3px;
}
.form-style-2 label{
    display: block;
    margin: 0px 0px 15px 0px;
}
.form-style-2 label > span{
    width: 100px;
    font-weight: bold;
    padding-top: 8px;
    padding-right: 5px;
}
.form-style-2 span.required{
    color:red;
}
.form-style-2 .tel-number-field{
    width: 40px;
    text-align: center;
}

.form-style-2 input.input-field, 
.form-style-2 .tel-number-field, 
.form-style-2 .textarea-field, 
 .form-style-2 .select-field{
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    border: 1px solid #C2C2C2;
    box-shadow: 1px 1px 4px #EBEBEB;
    -moz-box-shadow: 1px 1px 4px #EBEBEB;
    -webkit-box-shadow: 1px 1px 4px #EBEBEB;
    border-radius: 3px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    padding: 7px;
    outline: none;
}
.form-style-2 .input-field:focus, 
.form-style-2 .tel-number-field:focus, 
.form-style-2 .textarea-field:focus,  
.form-style-2 .select-field:focus{
    border: 1px solid #0C0;
}
.form-style-2 .textarea-field{
    height:100px;
    width: 55%;
}
.form-style-2 input[type=submit],
.form-style-2 input[type=button]{
    border: none;
    padding: 8px 15px 8px 15px;
    background: #FF8500;
    color: #fff;
    box-shadow: 1px 1px 4px #DADADA;
    -moz-box-shadow: 1px 1px 4px #DADADA;
    -webkit-box-shadow: 1px 1px 4px #DADADA;
    border-radius: 3px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
}
.form-style-2 input[type=submit]:hover,
.form-style-2 input[type=button]:hover{
    background: #EA7B00;
    color: #fff;
}
</style>
<style>
.myButton {
	background-color:#007569;
	-moz-border-radius:28px;
	-webkit-border-radius:28px;
	border-radius:5px;
	border:1px solid #fff;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:15px;
	padding:5px 10px;
	text-decoration:none;
	text-shadow:0px 1px 0px #2f6627;
}
.myButton:hover {
	background-color:#5cbf2a;
}
.myButton:active {
	position:relative;
	top:1px;
}
#mtnnumber	{
	margin: 0 0 11px 0;
	width: 150px;
	font-size: 20px;
	padding: 5px 5px;
}
#mtnname {
	margin: 0 0 11px 0;
	width: 150px;
	font-size: 20px;
	padding: 5px 5px;
}
.numberSpan{   
	color: #fff;
    float: left;
    background: #009485;
	height: 33px;border-radius: 5px 0px 0 5px;
	padding: 7px 2px 7px 7px;
}
</style>
<link rel="stylesheet" href="js/style.css" media="all">
<script src="js/stripe.js"></script>
<?php
if(isset($_GET['forGroupId'])){
	$forGroupId = $_GET['forGroupId'];
	$forGroupName = $_GET['forGroupName'];
	$currencyList="";
	include "../db.php"; 
	$sql = $db->query("SELECT * FROM currency"); // query the currencies
	while($row = mysqli_fetch_array($sql)){
		$currencyList.='<option value="'.$row['CurrencyCode'].'">'.$row['CurrencyName'].'</option>';
	}

	
echo '<input id="forGroupId" hidden value="'.$forGroupId.'"/>';
echo '<input id="forGroupName" hidden value="'.$forGroupName.'"/>';
?>
	<div class="form-style-2">
<label for="field1" style="width: 100%;">
	<span style="font-size: 18px">Amount <span class="required">*</span>
	</span>
	<input placeholder="0.00" style="
    width: 45%;
" class="input-field" name="field1" type="number" id="contributedAmount">
	<span ><select style="
    width: 33%;
" class="select-field" id="currency">
		<option value="RWF">Rwandan Francs</option>
		<?php echo $currencyList;?>
	<select>
	</span>
</label>
<h6><div id="amountError" style="color: #f44336;"></div></h6>
	<div class="mdl-grid mdl-grid--no-spacing" >
		<div class="mdl-cell mdl-cell--4-col"> <a href="javascript:void()" onclick="frontpayement2(method=1)"><div style="border-radius: 3px; background-image: url(images/1.jpg); background-size: 100% 100%; height: 90px; margin: 5px; box-shadow: 0.5px 0.5px 0.25px 0.25px #888888;"></div></a></div>
		<div class="mdl-cell mdl-cell--4-col"> <a href="javascript:void()" onclick="frontpayement2(method=2)"><div style="border-radius: 3px; background-image: url(images/2.jpg); background-size: 100% 100%; height: 90px; margin: 5px; box-shadow: 0.5px 0.5px 0.25px 0.25px #888888;"></div></a></div>
		<div class="mdl-cell mdl-cell--4-col"> <a href="javascript:void()" onclick="frontpayement2(method=3)"><div style="border-radius: 3px; background-image: url(../proimg/banks/4.png); background-size: 100% 100%; height: 90px; margin: 5px; box-shadow: 0.5px 0.5px 0.25px 0.25px #888888;"></div></a></div>
	</div>
</div>
 
<?php
}
elseif(isset($_GET['method'])){
	$method = $_GET['method'];
	$forGroupId = $_GET['forGroupId1'];
	$contributedAmount = $_GET['contributedAmount'];
	$currency = $_GET['currency'];
	
	include("../db.php");
	$sqlDestination = $outCon->query("SELECT * FROM group_account WHERE groupId = '$forGroupId'");
	while($row = mysqli_fetch_array($sqlDestination)){
		$bankaccount = $row['accountNumber'];
		$groupBank = $row['bankId'];
	}
	
	echo'<input type="hidden" id="opperator" value="'.$method.'">';
	echo'<input type="number" hidden id="forGroupId" value="'.$forGroupId.'">';
	echo'<input type="text" hidden id="currency" value="'.$currency.'">';
	echo'<input type="text" hidden id="amountdone" value="'.$contributedAmount.'">';
	echo'<input type="text" hidden id="sendToAccount" value="'.$bankaccount.'">';
	echo'<input type="text" hidden id="sendToBank" value="'.$groupBank.'">';
			
if($method == '1'){
	?>
	<div class="widget-body widget-content"  style="background-color: #FFBE00; height:100%;">
	<script>document.getElementById('actionbc').innerHTML ='<button onclick="frontpayementOptions()" class="mdl-button btn-danger"><i class="fa fa-arrow-left"></i> Back</button>';
			</script>		
	<div class="mdl-card__supporting-text">
	<div class="example-wrap" id="donetransfer">
		<div class="row text-center">
			<div class="col-lg-12" id="sendingInfo" style="font-size: 15px;">
				<div class="numberSpan">
				  Name
				</div>
				<div>
					<input type="text" id="mtnname" style="width: 70%;font-size: 15px;" class="form-control" placeholder="Your Full Name"> 
				</div>
			</div>
		</div>
		<div class="row text-center">
			<div class="col-lg-12" id="sendingInfo" style="font-size: 15px;">
				<div class="numberSpan">
				  +25078
				</div>
				<div>
					<input type="number" style="font-size: 15px;width: 36.5%;" onkeyup="handleChange(this);" id="mtnnumber" class="form-control" placeholder="MTN Phone"> 
					<div id="doneMtn" style="position: absolute;margin: -43px 0px 0px 242px;"></div>
				</div>
			</div>
			<div class="col-lg-12" id="sendingInfo" style="font-size: 22px;">
				<input id="method" value="8" hidden>
				<div id="alowMtn" style="color: #fff;font-size: 18px; padding: 10px;">
					Enter your MTN number after 078
				</div>
			</div>
		</div>
	</div>
</div>	
</div>	
<?php }
elseif($method == '2'){?>
<div class="widget-body widget-content"  style="background-color: #002e6e; height:100%;">
	<div class="mdl-card__supporting-text" >
		<script>document.getElementById('actionbc').innerHTML ='<button onclick="frontpayementOptions()" class="mdl-button btn-danger"><i class="fa fa-arrow-left"></i> Back</button>';
			</script>	
		<div class="example-wrap" id="donetransfer">
			<div class="row text-center">
				<div class="col-lg-12" id="sendingInfo" style="font-size: 15px;">
					<div class="numberSpan">
					  Name
					</div>
					<div>
						<input type="text" id="mtnname" style="width: 70%;font-size: 15px;" class="form-control" placeholder="Your Full Name"> 
					</div>
				</div>
			</div>
		
			<div class="row text-center">
				<div class="col-lg-12" id="sendingInfo" style="font-size: 15px;">
					<div class="numberSpan">
					  +25072
					</div>
					<div>
						<input type="number" style="font-size: 15px;width: 36.5%;" onkeyup="handleChange(this);" id="mtnnumber" class="form-control" placeholder="TIGO Phone"> 
						<div id="doneMtn" style="position: absolute;margin: -43px 0px 0px 242px;"></div>
					</div>
				</div>
				<div class="col-lg-12" id="sendingInfo" style="font-size: 22px;">
					<div class="col-lg-12" id="sendingInfo" style="font-size: 22px;">
						<input id="method" value="2" hidden>
						<div id="alowMtn" style="color: #fff;font-size: 18px; padding: 10px;">
							Enter your TIGO number after 072
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
	
<?php }
elseif($method == '3'){?>

<div class="widget-body widget-content"  style="background-color: #FFBE00; height:100%;">
			
	<div class="mdl-card__supporting-text" >
		<button class="myButton" onclick="frontpayementOptions()">
				<i class="icon md-arrow-left">back</i>
			</button> 
		<hr/>
		
 <form action="../3rdparty/rtgs/transfer.php" method="post" id="payment-form">

  <input name="Amount" type="hidden" value="<?php echo $contributedAmount;?>">
  <input name="Currency" type="hidden" value="<?php echo $currency;?>">
  <input name="forGroupId" type="hidden" value="<?php echo $forGroupId;?>">
  <input name="sendToAccount" type="hidden" value="<?php echo $bankaccount;?>">
  <div class="form-row">
    <label for="card-element">
      <div style="font-size: 20px; text-align: center;padding-bottom:10px; color: #fff; text-shadow: 1px 1px 2px #000000;">
	  <!-- Transform into USD-->
	  
	  <?php
		function convertCurrency($contributedAmount, $from, $to){
			$data = file_get_contents("https://www.google.com/finance/converter?a=$contributedAmount&from=$from&to=$to");
			preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
			$converted = preg_replace("/[^0-9.]/", "", $converted[1]);
			return number_format(round($converted, 3),2);
		}
		echo $finalAmount = convertCurrency($contributedAmount, $currency, "USD");
		$finalAmount;
		$afterCharge = $finalAmount - ($finalAmount*2.9/100);
	
	  ?>
	  
	  <input name="finalAmount" type="hidden" value="<?php echo $finalAmount;?>">
  
	  USD
	  <!-- Before Charge Transform into Rwf-->
	  
	  <?php
		function convertCurrency1($finalAmount, $from1, $to1){
			$data1 = file_get_contents("https://www.google.com/finance/converter?a=$finalAmount&from=$from1&to=$to1");
			preg_match("/<span class=bld>(.*)<\/span>/",$data1, $converted1);
			$converted1 = preg_replace("/[^0-9.]/", "", $converted1[1]);
			return number_format(round($converted1, 3),2);
		}
		 $lastAmount = convertCurrency1($finalAmount, "USD", "RWF");
	  ?>
	  
		<input name="stripMNOAmount" type="hidden" value="<?php echo $lastAmount;?>">
		
		
		<!--The After charge into Rwf -->
	  
	  <?php
		function convertCurrency2($afterCharge, $from1, $to1){
			$data2 = file_get_contents("https://www.google.com/finance/converter?a=$afterCharge&from=$from1&to=$to1");
			preg_match("/<span class=bld>(.*)<\/span>/",$data2, $converted2);
			$converted2 = preg_replace("/[^0-9.]/", "", $converted2[1]);
			return number_format(round($converted2, 3),2);
		}
		 $rwAfterCharge = convertCurrency2($afterCharge, "USD", "RWF");
	  ?>
	  
		<input name="rwAfterCharge" type="hidden" value="<?php echo $rwAfterCharge;?>">
	
	  <br/></div>
    </label>
    <div id="card-element">
      <!-- a Stripe Element will be inserted here. -->
    </div>

    <!-- Used to display form errors -->
    <div id="card-errors"></div>
  </div>
<br>
  <button class="myButton">Submit Payment</button>
</form>
</div>	
</div>	
</div>	
<?php }
elseif($method == '4'){echo'
<div class="panel-body container-fluid" style="background-color: #fff; height:100%;">
 <button class="myButton" onclick="frontpayementOptions()"><i class="icon md-arrow-left"></i></button>
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

<script src="js/js.js"></script>
<script src="js/jquery.js"></script>


<script>
function frontpayement2(method){
	//alert(method);
	var contributedAmount =$("#contributedAmount").val();
	var currency =$("#currency").val();
	var forGroupId =$("#forGroupId").val();
	if (contributedAmount == null || contributedAmount == "") 
		{
			document.getElementById('amountError').innerHTML = 'Contributed Amount must be  out';
			return false;
		}
	if (contributedAmount < 100) 
		{
			document.getElementById('amountError').innerHTML = 'The minimum contribution allowed is 100 Rwf';
			return false;
		}
		document.getElementById('contBody').innerHTML = '<div style="margin: 100px;">Loading...</div>';
			
		//alert(forGroupId);
	$.ajax({
			type : "GET",
			url : "payments.php",
			dataType : "html",
			cache : "false",
			data : {
				method : method,
				currency : currency,
				contributedAmount : contributedAmount,
				forGroupId1 : forGroupId,
			},
			success : function(html, textStatus){
				$("#contBody").html(html);
			},
			error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			}
	});
}
</script>
<!--Give pay Button-->
<script>
  function handleChange(input) {
	  var method = document.getElementById('opperator').value;
	  if (method == '1') {
		  var opperator = 'MTN';
		  var errorcolor = '#e91e63;';
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
		document.getElementById('doneMtn').innerHTML = '<button class="myButton" onclick="kwishura()"><i class="icon md-check"></i>Done</button>';
	}
  }
  
</script>
<script>
// Display a recurrunf Invitation
function kwishura(){
	var forGroupId			= document.getElementById('forGroupId').value;
	var sentAmount			= document.getElementById('amountdone').value;
	var sendFromAccount		= document.getElementById('mtnnumber').value;
	var sendFromName		= document.getElementById('mtnname').value;
	//var sendFromBank		= document.getElementById('method').value;
	var sendToBank			= document.getElementById('sendToBank').value;
	var sendToAccount		= document.getElementById('sendToAccount').value;
	var method				= document.getElementById('method').value;
	if(method == '8'){
		var sendFromBank = 1;
	}
	else if(method == '2'){
		var sendFromBank = 2;
	}
	var sendFromAccount 	= '7'+method+''+sendFromAccount;
	var realphone1 			= sendFromAccount.substring(sendFromAccount.indexOf("7"));
	var prephone2 			= sendToAccount.substring(sendToAccount.indexOf("7"));
	var realphone2 			= '250'+prephone2;
		
	document.getElementById('donetransfer').innerHTML = '<div style="text-align: center;padding-top:10px; color: #fff; text-shadow: 1px 1px 2px #000000;"><h5>Connecting...</h5></div>';
	$.ajax({
			type : "GET",
			url : "../3rdparty/rtgs/transfer.php",
			dataType : "html",
			cache : "false",
			data : {
				
				forGroupId		:	forGroupId,	
				sentAmount		:	sentAmount,	
				sendFromAccount	:	sendFromAccount,	
				sendFromName	:	sendFromName,	
				sendFromBank	:   sendFromBank,	
				sendToBank		:   sendToBank,		
				sendToAccount	:   sendToAccount,
				phone1 			: realphone1,
				phone2 			: realphone2,		
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

<!--AJAX CALL THE STATUS-->
<script>
function checking(){
	var check =1;
	//alert('ChecKing Status');
	$.ajax({
		type : "GET",
		url : "../3rdparty/rtgs/transfer.php",
		dataType : "html",
		cache : "false",
		data : {
			
			check : check,
		},
		success : function(html, textStatus){
			//alert('incoming Status');
			$("#donetransfer").html(html);
			
		},
		error : function(xht, textStatus, errorThrown){
			alert("Error : " + errorThrown);
		}
	});
}
function stopit()
	{
		clearInterval(interval);
		document.getElementById('status').innerHTML = 'Canceled.';
	}
</script>

