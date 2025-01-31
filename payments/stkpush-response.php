<?php
  include_once("../config/index.php");
header("Content-Type:application/json");
$request = file_get_contents('php://input');

$_resp_obj = json_decode($request);
//result code
$result_code = $_resp_obj->Body->stkCallback->ResultCode;

$requestid = $_resp_obj->Body->stkCallback->CheckoutRequestID;

//message
$message = $_resp_obj->Body->stkCallback->ResultDesc;
//amount
$amount=$_resp_obj->Body->stkCallback->CallbackMetadata->Item[0]->Value;
//txncode
$txncode=$_resp_obj->Body->stkCallback->CallbackMetadata->Item[1]->Value;
//phone
 $phone = $_resp_obj->Body->stkCallback->CallbackMetadata->Item[4]->Value;
 
 if($phone==""){
   //phone
 $phone = $_resp_obj->Body->stkCallback->CallbackMetadata->Item[3]->Value;  
 }else{
    $phone=$phone; 
 }
 
//mysqli_query($con,"UPDATE stkresponse SET result='$request',refcode='$result_code' WHERE requestid='$requestid'");

mysqli_query($con,"INSERT INTO stkresponse(result,phone,amount,requestid,txncode) VALUES('$request','$phone','$amount','$requestid','$txncode')");

//if(json_decode($curl_response)->ResponseCode == 0){
  echo json_encode(array("status" => 200, "message" => $result_code));
// }



?>