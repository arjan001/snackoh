<?php

echo '<a href="index.php">Home<br /></a>';

$content = file_get_contents('php://input'); // Receives the JSON Result from Safaricom
$res = json_decode($content, true); // Convert the JSON to an array

$dataToLog = array(
    date("Y-m-d H:i:s"), // Date and time
    " MerchantRequestID: " . $res['Body']['stkCallback']['MerchantRequestID'],
    " CheckoutRequestID: " . $res['Body']['stkCallback']['CheckoutRequestID'],
    " ResultCode: " . $res['Body']['stkCallback']['ResultCode'],
    " ResultDesc: " . $res['Body']['stkCallback']['ResultDesc'],
);

$data = implode(" - ", $dataToLog);
$data .= PHP_EOL;

// Logs the results to the transaction_log file
file_put_contents('transaction_log', $data, FILE_APPEND);

$result_code = $res['Body']['stkCallback']['ResultCode'];

if ($result_code !== '1032') {
    $MerchantRequestID = $res['Body']['stkCallback']['MerchantRequestID'];
    $CheckoutRequestID = $res['Body']['stkCallback']['CheckoutRequestID'];
    // Assuming you have a way to get the phone number, verification fee, and ID number
    $phone = $_SESSION['phone_number'];
    $verificationFee = $_SESSION['amount'];
    $IdNumber = $_SESSION['id_number'];

    // Log success or failure to error_log
    $logMessage = $result_code === '0' ? "Record Inserted" : "Failed to Insert Record";
    file_put_contents('error_log', $logMessage, FILE_APPEND);
}

echo "Callback processed successfully.";

?>
