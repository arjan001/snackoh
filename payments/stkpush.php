<?php
include_once("mpesa-config.php");
header("Content-Type:application/json");

//if(isset($_POST["phone"])){
$msisdn = "254713083924";//"254".substr($_POST["phone"],-9); 
$amount = "1";//$_POST["amount"];
$reference = "washi";//$_POST["accno"];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $authenticationurl);
curl_setopt($ch, CURLOPT_HTTPHEADER,  array('Authorization: Basic '.$credentials, 'Content-Type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close($ch);
$access_token=json_decode($result)->access_token;
// echo $result;

$timestamp = date("YmdHis");
$password = base64_encode($partybill.$passkey.$timestamp);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $stkpush_url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token));
$curl_post_data = array(
  'BusinessShortCode' => $partybill,
  'Password' => $password,
  'Timestamp' => $timestamp,
  'TransactionType' => 'CustomerPayBillOnline',
  'Amount' => $amount,
  'PartyA' => $msisdn,
  'PartyB' => $partybill,
  'PhoneNumber' => $msisdn,
  'CallBackURL' => $stkpush_callback,
  'AccountReference' => $reference,
  'TransactionDesc' => 'STK payment'
);
$data_string = json_encode($curl_post_data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
 $curl_response = curl_exec($curl);
if(json_decode($curl_response)->ResponseCode == 0){
  echo json_encode(array("status" => 200, "message" => "Success"));
 }
//}
?>