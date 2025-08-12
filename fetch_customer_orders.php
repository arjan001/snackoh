<?php
include_once './config/config.php';

header('Content-Type: application/json');

if (!isset($_GET['customer_id']) || empty($_GET['customer_id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Customer ID is required'
    ]);
    exit;
}

$customer_id = intval($_GET['customer_id']);

try {
    // Fetch orders for the specific customer
    $query = "
        SELECT 
            o.id,
            o.transaction_id,
            o.total_price,
            o.payment_status,
            o.payment_type,
            o.created_at,
            COUNT(oi.id) as item_count
        FROM orders o
        LEFT JOIN order_items oi ON o.id = oi.order_id
        WHERE o.customer_id = ?
        GROUP BY o.id
        ORDER BY o.created_at DESC
        LIMIT 50
    ";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $orders = [];
    while ($row = $result->fetch_assoc()) {
        $orders[] = [
            'id' => $row['id'],
            'transaction_id' => $row['transaction_id'],
            'total_price' => number_format($row['total_price'], 2),
            'payment_status' => $row['payment_status'],
            'payment_type' => $row['payment_type'],
            'created_at' => date('d.m.Y H:i', strtotime($row['created_at'])),
            'item_count' => $row['item_count']
        ];
    }
    $stmt->close();
    
    echo json_encode([
        'success' => true,
        'orders' => $orders,
        'count' => count($orders)
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error fetching customer orders: ' . $e->getMessage()
    ]);
}
?> 