<?php
include_once './includes/session_check.php';
include_once './config/config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$quotation_id = intval($_GET['id'] ?? 0);

if ($quotation_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid quotation ID']);
    exit;
}

try {
    // Get quotation details
    $stmt = $conn->prepare("
        SELECT 
            q.*,
            DATE_FORMAT(q.quotation_date, '%Y-%m-%d') as quotation_date_formatted,
            DATE_FORMAT(q.expiry_date, '%Y-%m-%d') as expiry_date_formatted
        FROM quotations q
        WHERE q.id = ?
    ");
    $stmt->bind_param("i", $quotation_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $quotation = $result->fetch_assoc();
    $stmt->close();
    
    if (!$quotation) {
        echo json_encode(['success' => false, 'message' => 'Quotation not found']);
        exit;
    }
    
    // Get quotation items
    $stmt = $conn->prepare("
        SELECT 
            qi.*
        FROM quotation_items qi
        WHERE qi.quotation_id = ?
        ORDER BY qi.id
    ");
    $stmt->bind_param("i", $quotation_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $items = [];
    while ($row = $result->fetch_assoc()) {
        $items[] = [
            'product_name' => $row['product_name'],
            'product_description' => $row['product_description'],
            'quantity' => intval($row['quantity']),
            'unit_price' => floatval($row['unit_price']),
            'discount' => floatval($row['discount']),
            'tax_rate' => floatval($row['tax_rate']),
            'tax_amount' => floatval($row['tax_amount']),
            'total_amount' => floatval($row['total_amount'])
        ];
    }
    $stmt->close();
    
    echo json_encode([
        'success' => true,
        'data' => [
            'quotation' => $quotation,
            'items' => $items
        ]
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error fetching quotation: ' . $e->getMessage()
    ]);
}
?> 