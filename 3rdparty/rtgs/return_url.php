<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
/**
 * A sample code to illustrate how a payment response will be handled.
 *
 * This sample is only for illustration and hasn't been tested yet.
 * 
 * @author Kareem Mohamed <kareem3d.a@gmail.com> 
 */

require __DIR__ . '/function.php';
include('db.php');
$transaction['status'] = getInput('vpc_TxnResponseCode');
$transaction['key']    = getInput('vpc_TransactionNo');
$transaction['message'] = getInput('vpc_Message');
$transaction['currency'] = getInput('vpc_Currency');
$transaction['merchant'] = getInput('vpc_Merchant');
$transaction['amount'] = getInput('vpc_Amount');
$transaction['orderInfo'] = getInput('vpc_OrderInfo');

// $reference = getInput('vpc_MerchTxnRef');
// Get order from the database by the `$reference` generated random number in the request process

if($transaction['status'] == "0" && $transaction['message'] == "Approved") 
{
	$amount = $transaction['amount'];
	$transaction['currency'];
	$check1 = $transaction['message'];
	$transaction['merchant'];
	$transactionId1 = $transaction['key'];
	 $transaction['orderInfo'];
	session_start();
	 $fromTransactionId	= $_SESSION['fromTransactionId'];
	 $ToTransactionId	= $_SESSION['ToTransactionId'];
	$phone2				= '25'.$_SESSION['phone2'];
	$Update1= $con->query("UPDATE `transactions` SET status='$check1', 3rdpartyId='$transactionId1' WHERE id = '$fromTransactionId'");
}

else 
{

    // Display error
	//echo $transaction['status'] = getInput('vpc_TxnResponseCode') .'<br>';
	//echo $transaction['key']    = getInput('vpc_TransactionNo') .'<br>';
	echo $transaction['message'] = getInput('vpc_Message');
}

?>
<div id="result"></div>
<div id="status"></div>
<script src="js/jquery.min.js"></script>
<script>
    (function pay(){
        var amount = <?php echo $amount;?>;
        var phone = '';
        var phone2 = <?php echo $phone2;?>;
		
        document.getElementById('result').innerHTML = 'Contacting MTN...';
        $.ajax({
            type : "GET",
            url : "mno.php",
            dataType : "html",
            cache : "false",
            data : {
                amount : amount,
                phone : phone,
                phone2 : phone2,
            },
            success : function(html, textStatus){
                $("#result").html(html);

            },
            error : function(xht, textStatus, errorThrown){
                alert("Error : " + errorThrown);
            }
        });
    })();
</script>

<!--AJAX CALL THE STATUS-->
<script>
function checking(){
	var check =1;
	//alert('ChecKing Status');
	$.ajax({
		type : "GET",
		url : "mno.php",
		dataType : "html",
		cache : "false",
		data : {
			
			check : check,
		},
		success : function(html, textStatus){
			//alert('incoming Status');
			$("#result").html(html);
			
		},
		error : function(xht, textStatus, errorThrown){
			alert("Error : " + errorThrown);
		}
	});
}
function stopit()
	{
		clearInterval(interval);
		//document.getElementById('status').innerHTML = 'Canceled.';
	}
</script>
