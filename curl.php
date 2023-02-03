<?php
$url = 'https://transact.nab.com.au/directpost/genfingerprint';
 
$curl = curl_init();
 
// EPS_MERCHANT: merchant_id, 
// EPS_PASSWORD: transaction_password, 
// EPS_REFERENCEID: doc_id, 
// EPS_AMOUNT: amt, 
// EPS_TIMESTAMP: timestamp, 
// EPS_RESULTURL: $('.EPS_RESULTURL').val()  
$doc_id=$_REQUEST['EPS_REFERENCEID'];
$amt=$_REQUEST['EPS_AMOUNT'];
// $timestamp=$_REQUEST['EPS_TIMESTAMP'];
// $timestamp = time(); 
// 20221213173043 
// 20221213103043

// $d1 = new Datetime();
$timestamp = date('YmdHis');

// echo $timestamp . ' '; 

$fields = array(
    'EPS_MERCHANT' => 'THN0010',
    'EPS_PASSWORD' => 'abcd1234',
    'EPS_REFERENCEID' => $doc_id,
    'EPS_AMOUNT' => $amt,
    'EPS_TIMESTAMP' => $timestamp,
    'EPS_RESULTURL' => 'https://ges-dev1.remotestaff.com/'
);
 
$fields_string = http_build_query($fields);
 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, TRUE);
curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);
 
$data = curl_exec($curl);
 
echo json_encode(array('timestamp' => $timestamp, 'fingerprint' => curl_exec($curl)));
// var_dump($data);
curl_close($curl);