<?php
include_once "./config/config.php";
include_once "email_functions.php"; // Function for sending emails

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo "<script>alert('❌ Invalid request method.'); window.history.back();</script>";
    exit;
}

// Validate selected employees
if (!isset($_POST['employees']) || !is_array($_POST['employees']) || count($_POST['employees']) === 0) {
    echo "<script>alert('❌ No employees selected.'); window.history.back();</script>";
    exit;
}

$employee_ids = $_POST['employees'];
$message = trim($_POST['message']);

try {
    // Prepare SQL statement
    $placeholders = implode(',', array_fill(0, count($employee_ids), '?'));
    $sql = "SELECT email FROM employees WHERE id IN ($placeholders)";
    
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("SQL Prepare failed: " . $conn->error);
    }

    $stmt->bind_param(str_repeat('i', count($employee_ids)), ...$employee_ids);
    $stmt->execute();
    $result = $stmt->get_result();

    $emails = [];
    while ($row = $result->fetch_assoc()) {
        if (!empty($row['email'])) {
            $emails[] = $row['email'];
        }
    }
    $stmt->close();

    if (empty($emails)) {
        throw new Exception("No valid employee emails found.");
    }

    // Send email
    $subject = "ASSET REPLACEMENT ALERT";
    $sent = sendEmail($emails, $subject, $message);

    if ($sent === true) {
        echo "<script>alert('✅ Notification emails sent successfully.'); window.location.href = document.referrer;</script>";
    } else {
        throw new Exception("Email Error: " . addslashes($sent));
    }
} catch (Exception $e) {
    echo "<script>alert('❌ " . addslashes($e->getMessage()) . "'); window.history.back();</script>";
}
exit;
