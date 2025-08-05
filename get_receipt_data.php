<?php
include_once './includes/session_check.php';
include_once './config/config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$transaction_id = $_GET['transaction_id'] ?? '';
$order_id = $_GET['order_id'] ?? '';

if (empty($transaction_id) || empty($order_id)) {
    echo json_encode(['success' => false, 'message' => 'Transaction ID and Order ID are required']);
    exit;
}

try {
    // Get order details
    $order_query = "
        SELECT 
            o.*,
            c.customer_name,
            c.email,
            c.phone,
            e.full_name as employee_name
        FROM orders o
        LEFT JOIN customers c ON o.customer_id = c.id
        LEFT JOIN employees e ON o.employee_id = e.id
        WHERE o.transaction_id = ? AND o.id = ?
    ";
    
    $stmt = $conn->prepare($order_query);
    $stmt->bind_param("si", $transaction_id, $order_id);
    $stmt->execute();
    $order_result = $stmt->get_result();
    $order_data = $order_result->fetch_assoc();
    $stmt->close();
    
    if (!$order_data) {
        echo json_encode(['success' => false, 'message' => 'Order not found']);
        exit;
    }
    
    // Get order items
    $items_query = "
        SELECT 
            oi.*,
            p.product_price
        FROM order_items oi
        LEFT JOIN products p ON oi.product_name = p.product_name
        WHERE oi.order_id = ?
        ORDER BY oi.id
    ";
    
    $stmt = $conn->prepare($items_query);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $items_result = $stmt->get_result();
    $order_items = [];
    
    while ($row = $items_result->fetch_assoc()) {
        $order_items[] = $row;
    }
    $stmt->close();
    
    // Calculate totals
    $subtotal = 0;
    $tax_rate = 0.16; // 16% VAT
    $tax_amount = 0;
    $discount = 0;
    $shipping = 0;
    $total = 0;
    
    foreach ($order_items as $item) {
        $item_total = $item['quantity'] * $item['unit_price'];
        $subtotal += $item_total;
    }
    
    $tax_amount = $subtotal * $tax_rate;
    $total = $subtotal + $tax_amount + $shipping - $discount;
    
    // Format customer info
    $customer_name = $order_data['customer_name'] ?? 'Walk-in Customer';
    $customer_id = $order_data['customer_id'] ? '#' . $order_data['customer_id'] : 'N/A';
    $customer_phone = $order_data['phone'] ?? 'N/A';
    $customer_email = $order_data['email'] ?? 'N/A';
    
    // Format date
    $order_date = date('d.m.Y', strtotime($order_data['created_at']));
    $order_time = date('H:i', strtotime($order_data['created_at']));
    
    // Prepare receipt data
    $receipt_data = [
        'success' => true,
        'data' => [
            'business_info' => [
                'name' => 'Snackoh Bakers',
                'phone' => '+254 700 000 000',
                'email' => 'info@snackohbakers.co.ke',
                'address' => 'Nairobi, Kenya'
            ],
            'receipt_info' => [
                'invoice_no' => $transaction_id,
                'order_id' => $order_id,
                'date' => $order_date,
                'time' => $order_time,
                'sale_number' => $order_id
            ],
            'customer_info' => [
                'name' => $customer_name,
                'customer_id' => $customer_id,
                'phone' => $customer_phone,
                'email' => $customer_email
            ],
            'items' => $order_items,
            'totals' => [
                'subtotal' => number_format($subtotal, 2),
                'tax_rate' => ($tax_rate * 100) . '%',
                'tax_amount' => number_format($tax_amount, 2),
                'discount' => number_format($discount, 2),
                'shipping' => number_format($shipping, 2),
                'total' => number_format($total, 2),
                'paid' => number_format($total, 2),
                'due' => '0.00'
            ],
            'payment_info' => [
                'method' => ucfirst($order_data['payment_type']),
                'status' => ucfirst($order_data['payment_status'])
            ],
            'employee' => $order_data['employee_name'] ?? 'System'
        ]
    ];
    
    echo json_encode($receipt_data);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false, 
        'message' => 'Error generating receipt: ' . $e->getMessage()
    ]);
}
?>