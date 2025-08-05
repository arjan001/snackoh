<?php
include_once './includes/session_check.php';
include_once './config/config.php';

header('Content-Type: application/json');

try {
    $query = "SELECT id, customer_name, email, phone FROM customers ORDER BY customer_name";
    $result = $conn->query($query);
    
    $customers = [];
    while ($row = $result->fetch_assoc()) {
        $customers[] = [
            'id' => $row['id'],
            'name' => $row['customer_name'],
            'email' => $row['email'],
            'phone' => $row['phone']
        ];
    }
    
    echo json_encode([
        'success' => true,
        'data' => $customers
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error fetching customers: ' . $e->getMessage()
    ]);
}
?> 