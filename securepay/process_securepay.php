<?php

require './vendor/autoload.php';

use Omnipay\Omnipay;

$gateway = Omnipay::create('SecurePay_DirectPost');

$formData = array(
    'number' => $_REQUEST['EPS_CARDNUMBER'], 
    'expiryMonth' => $_REQUEST['EPS_EXPIRYMONTH'], 
    'expiryYear' => $_REQUEST['EPS_EXPIRYYEAR'], 
    'cvv' => $_REQUEST['EPS_CCV']
);

$response = $gateway->purchase(array(
    // 'testMode' => true, //Testmode
    'merchantId' => 'TIS0030', //Testmode: ABC0001
    'transactionPassword' => 'abc123', //Testmode: abc123
    'transactionId' => $_REQUEST['EPS_REFERENCEID'],
    'amount' => $_REQUEST['EPS_AMOUNT'],
    'currency' => $_REQUEST['EPS_CURRENCY'], 
    'card' => $formData,
    'returnUrl' => 'https://gp.remotestaff.com.au/thank-you.php'
))->send();

if ($response->isRedirect()) {
    // redirect to offsite payment gateway
    $response->redirect();
} elseif ($response->isSuccessful()) {
    // payment was successful: update database
    print_r($response);
} else {
    // payment failed: display message to customer
    echo $response->getMessage();
}

// include 'xml.php';


// $timestamp = date('YmdHis');
// $EPS_AMOUNT = $_REQUEST['EPS_AMOUNT'];
// $EPS_REFERENCEID = $_REQUEST['EPS_REFERENCEID'];
// $EPS_CURRENCY = $_REQUEST['EPS_CURRENCY'];
// $timestamp = "{$timestamp}038000+480";
// $EPS_CARDNUMBER = $_REQUEST['EPS_CARDNUMBER'];
// $EPS_CCV = $_REQUEST['EPS_CCV'];
// $EPS_EXPIRYMONTH = $_REQUEST['EPS_EXPIRYMONTH'];
// $EPS_EXPIRYYEAR = $_REQUEST['EPS_EXPIRYYEAR'];
// $expiryDate = "{$EPS_EXPIRYMONTH}/$EPS_EXPIRYYEAR";

// // echo $EPS_AMOUNT;
// // echo "<br>";
// // echo $EPS_REFERENCEID;
// // echo "<br>";
// // echo $EPS_CURRENCY;
// // echo "<br>";
// // echo $timestamp;
// // echo "<br>";
// // echo $EPS_CARDNUMBER;
// // echo "<br>";
// // echo $EPS_CCV;
// // echo "<br>";
// // echo $expiryDate;
// // echo "<hr>";

// // Build XML
// $SecurePayMessage = new SimpleXMLElement($xmlstr);
// $SecurePayMessage->MessageInfo->messageID = $EPS_REFERENCEID;
// $SecurePayMessage->MessageInfo->messageTimestamp = $timestamp;

// $SecurePayMessage->Payment->TxnList->Txn->amount = $EPS_AMOUNT;
// $SecurePayMessage->Payment->TxnList->Txn->currency = $EPS_CURRENCY;
// $SecurePayMessage->Payment->TxnList->Txn->purchaseOrderNo = $EPS_REFERENCEID;

// $SecurePayMessage->Payment->TxnList->Txn->CreditCardInfo->cardNumber = $EPS_CARDNUMBER;
// $SecurePayMessage->Payment->TxnList->Txn->CreditCardInfo->cvv = $EPS_CCV;
// $SecurePayMessage->Payment->TxnList->Txn->CreditCardInfo->expiryDate = $expiryDate;

// // XML Output
// $xml = $SecurePayMessage->asXML();



// echo '<pre>', htmlentities($xml), '</pre>';
// echo "<hr>";

// // Send via Curl
// $url = "test.securepay.com.au/xmlapi/payment";

// $curl = curl_init($url);
// curl_setopt($curl, CURLOPT_URL, $url);
// curl_setopt($curl, CURLOPT_POST, true);
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// $headers = array(
//     "content-type: text/xml"
// );
// curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

// // $data = "<Request><Login>my_login</Login><Password>my_password</Password></Request>";

// curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);

// //for debug only!
// curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
// curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

// $resp = curl_exec($curl);
// curl_close($curl);
// var_dump($resp);

// Send via Curl
?>