<?php
require 'AfricasTalking.php';
include_once "./config/config.php"; // Ensure database connection

$username = "eboard";
$apiKey = "c83e6a8a02b740383c85ff37e94d76c8242b4ddb418ecb8b2b150562df64a348";
$logFile = "sms_log.txt";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
    exit;
}

if (empty($_POST['employees']) || empty($_POST['message'])) {
    echo json_encode(["status" => "error", "message" => "Employees or message field is empty"]);
    exit;
}

$sms = new AfricasTalkingSMS($username, $apiKey);
$errors = [];
$successes = [];

foreach ($_POST['employees'] as $employeeID) {
    $query = "SELECT contact_number FROM employees WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $employeeID);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row && !empty($row['contact_number'])) {
        $phone = trim($row['contact_number']);
        $phone = preg_replace('/\D/', '', $phone); // Remove non-numeric characters

        // Validate phone format
        if (!preg_match('/^(?:\+254|254|07|011)\d{7}$/', $phone)) { 
            $errors[] = "Invalid phone format: $phone";
            continue;
        }

        // Normalize to +254 format
        if (preg_match('/^07|^011/', $phone)) {
            $phone = "+254" . substr($phone, 1);
        } elseif (preg_match('/^254/', $phone)) {
            $phone = "+$phone";
        } // If already in +254 format, leave as is

        $response = $sms->sendSMS($phone, $_POST['message']);

        if (isset($response['SMSMessageData']['Recipients'][0]['status']) && 
            $response['SMSMessageData']['Recipients'][0]['status'] === "Success") {
            $successes[] = "SMS sent to $phone";
        } else {
            $errorMsg = "Failed to send SMS to $phone";
            if (isset($response['SMSMessageData']['Recipients'][0]['message'])) {
                $errorMsg .= " - " . $response['SMSMessageData']['Recipients'][0]['message'];
            }
            $errors[] = $errorMsg;
        }
    }
}

// Log final status
file_put_contents($logFile, date("Y-m-d H:i:s") . " - Success: " . implode(", ", $successes) . "\n", FILE_APPEND);
file_put_contents($logFile, date("Y-m-d H:i:s") . " - Errors: " . implode(", ", $errors) . "\n", FILE_APPEND);

echo json_encode([
    "status" => empty($errors) ? "success" : "error",
    "message" => empty($errors) ? "SMS sent successfully" : implode(", ", $errors)
]);

?>
