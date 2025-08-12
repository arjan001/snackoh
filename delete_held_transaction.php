<?php
include_once './includes/session_check.php';
include_once './config/config.php';
include_once './includes/notifications.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$hold_id = trim($_POST['hold_id'] ?? '');
$employee_id = intval($_SESSION['employee_id'] ?? 0);

if (empty($hold_id) || $employee_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid data provided']);
    exit;
}

try {
    // Delete held transaction (only if it belongs to the current employee)
    $stmt = $conn->prepare("DELETE FROM held_transactions WHERE hold_id = ? AND employee_id = ?");
    $stmt->bind_param("si", $hold_id, $employee_id);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        // Add notification
        addNotification(
            "Transaction Voided",
            "Held transaction voided successfully: " . $hold_id,
            'warning'
        );
        
        echo json_encode([
            'success' => true,
            'message' => 'Transaction voided successfully'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Transaction not found or you do not have permission to void it'
        ]);
    }
    
    $stmt->close();
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error voiding transaction: ' . $e->getMessage()
    ]);
}
?> 