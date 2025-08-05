<?php
include_once './includes/session_check.php';
include_once './config/config.php';

header('Content-Type: application/json');

try {
    $search = $_GET['search'] ?? '';
    
    $query = "SELECT product_name, product_price, product_quantity FROM products";
    if (!empty($search)) {
        $query .= " AND product_name LIKE ?";
    }
    $query .= " ORDER BY product_name";
    
    $stmt = $conn->prepare($query);
    if (!empty($search)) {
        $search_param = "%$search%";
        $stmt->bind_param("s", $search_param);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = [
            'product_name' => $row['product_name'],
            'unit_price' => $row['product_price'],
            'available_quantity' => $row['product_quantity']
        ];
    }
    $stmt->close();
    
    echo json_encode([
        'success' => true,
        'data' => $products
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error fetching products: ' . $e->getMessage()
    ]);
}
?> 