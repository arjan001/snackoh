<?php
include_once './includes/session_check.php';
include_once './config/config.php';

header('Content-Type: application/json');

try {
    $current_year = date('Y');
    
    // Fetch sales data for the current year by month
    $sales_query = "
        SELECT 
            MONTH(o.created_at) as month,
            SUM(oi.quantity * oi.unit_price) as total_sales
        FROM orders o
        JOIN order_items oi ON o.id = oi.order_id
        WHERE YEAR(o.created_at) = ? 
        AND o.status != 'cancelled'
        GROUP BY MONTH(o.created_at)
        ORDER BY month
    ";
    
    $stmt = $conn->prepare($sales_query);
    $stmt->bind_param('i', $current_year);
    $stmt->execute();
    $sales_result = $stmt->get_result();
    
    $sales_data = array_fill(1, 12, 0);
    
    while ($row = $sales_result->fetch_assoc()) {
        $sales_data[$row['month']] = (float)$row['total_sales'];
    }
    
    // Fetch purchase data for the current year by month
    $purchase_query = "
        SELECT 
            MONTH(po.created_at) as month,
            SUM(poi.quantity * poi.unit_price) as total_purchases
        FROM purchase_orders po
        JOIN purchase_order_items poi ON po.id = poi.purchase_order_id
        WHERE YEAR(po.created_at) = ? 
        AND po.status != 'cancelled'
        GROUP BY MONTH(po.created_at)
        ORDER BY month
    ";
    
    $stmt = $conn->prepare($purchase_query);
    $stmt->bind_param('i', $current_year);
    $stmt->execute();
    $purchase_result = $stmt->get_result();
    
    $purchase_data = array_fill(1, 12, 0);
    
    while ($row = $purchase_result->fetch_assoc()) {
        $purchase_data[$row['month']] = (float)$row['total_purchases'];
    }
    
    $sales_array = array_values($sales_data);
    $purchase_array = array_values($purchase_data);
    
    $month_labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    
    $response = [
        'success' => true,
        'data' => [
            'series' => [
                [
                    'name' => 'Sales',
                    'data' => $sales_array
                ],
                [
                    'name' => 'Purchase',
                    'data' => array_map(function($value) {
                        return -$value;
                    }, $purchase_array)
                ]
            ],
            'categories' => $month_labels,
            'year' => $current_year
        ]
    ];
    
    echo json_encode($response);
    
} catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => 'Error fetching chart data: ' . $e->getMessage(),
        'data' => [
            'series' => [
                [
                    'name' => 'Sales',
                    'data' => [130, 210, 300, 290, 150, 50, 210, 280, 105, 200, 180, 220]
                ],
                [
                    'name' => 'Purchase',
                    'data' => [-150, -90, -50, -180, -50, -70, -100, -90, -105, -120, -80, -110]
                ]
            ],
            'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'year' => $current_year
        ]
    ];
    
    echo json_encode($response);
}
?>