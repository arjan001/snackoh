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

$cart_data = $_POST['cart'] ?? '[]';
$total_price = floatval($_POST['total_price'] ?? 0);
$reference = trim($_POST['reference'] ?? '');
$employee_id = intval($_SESSION['employee_id'] ?? 0);

if (empty($cart_data) || $total_price <= 0 || $employee_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid data provided']);
    exit;
}

$carts = json_decode($cart_data, true);

if (!$carts || count($carts) == 0) {
    echo json_encode(['success' => false, 'message' => 'No items in cart']);
    exit;
}

try {
    // Generate hold ID
    $hold_id = 'HOLD_' . date('YmdHis') . '_' . rand(1000, 9999);
    
    // Insert into held_transactions table
    $stmt = $conn->prepare("INSERT INTO held_transactions (hold_id, employee_id, cart_data, total_price, reference, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("sidsd", $hold_id, $employee_id, $cart_data, $total_price, $reference);
    $stmt->execute();
    $stmt->close();
    
    // Add notification
    addNotification(
        "Transaction Held",
        "Order held successfully with reference: " . ($reference ?: $hold_id),
        'info'
    );
    
    echo json_encode([
        'success' => true,
        'message' => 'Transaction held successfully',
        'hold_id' => $hold_id
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error holding transaction: ' . $e->getMessage()
    ]);
}
?> 