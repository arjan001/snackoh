<?php
include_once './includes/session_check.php';
include_once './config/config.php';
include_once './includes/notifications.php';

header('Content-Type: application/json');

try {
    $employee_id = intval($_SESSION['employee_id'] ?? 0);
    
    // Get held transactions for the current employee
    $query = "
        SELECT 
            ht.*,
            e.full_name as employee_name
        FROM held_transactions ht
        LEFT JOIN employees e ON ht.employee_id = e.id
        WHERE ht.employee_id = ?
        ORDER BY ht.created_at DESC
    ";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $employee_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $held_transactions = [];
    while ($row = $result->fetch_assoc()) {
        $held_transactions[] = [
            'hold_id' => $row['hold_id'],
            'reference' => $row['reference'] ?: 'No reference',
            'total_price' => number_format($row['total_price'], 2),
            'created_at' => date('d.m.Y H:i', strtotime($row['created_at'])),
            'cart_data' => json_decode($row['cart_data'], true),
            'employee_name' => $row['employee_name'] ?? 'Unknown'
        ];
    }
    $stmt->close();
    
    echo json_encode([
        'success' => true,
        'data' => $held_transactions
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error retrieving held transactions: ' . $e->getMessage()
    ]);
}
?> 