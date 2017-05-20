<?php

/**
 * A sample code to illustrate how a payment response will be handled.
 *
 * This sample is only for illustration and hasn't been tested yet.
 * 
 * @author Kareem Mohamed <kareem3d.a@gmail.com> 
 */

require __DIR__ . '/function.php';

$transaction['status'] = getInput('vpc_TxnResponseCode');
$transaction['key']    = getInput('vpc_TransactionNo');
$transaction['message'] = getInput('vpc_Message');
$transaction['currency'] = getInput('vpc_Currency');
$transaction['merchant'] = getInput('vpc_Merchant');
$transaction['amount'] = getInput('vpc_Amount');
$transaction['orderInfo'] = getInput('vpc_OrderInfo');

// $reference = getInput('vpc_MerchTxnRef');
// Get order from the database by the `$reference` generated random number in the request process

if($transaction['status'] == "0" && $transaction['message'] == "Approved") {

  echo $transaction['amount'].'<br/>';
  echo $transaction['currency'].'<br/>';
  echo $transaction['message'].'<br/>';
  echo $transaction['merchant'].'<br/>';
  echo $transaction['key'].'<br/>';
  echo $transaction['orderInfo'].'<br/>';
  session_start();
  echo $_SESSION['orderInfo'].'<br/>';

} else {

    // Display error
	//echo $transaction['status'] = getInput('vpc_TxnResponseCode') .'<br>';
	//echo $transaction['key']    = getInput('vpc_TransactionNo') .'<br>';
	echo $transaction['message'] = getInput('vpc_Message');
}
