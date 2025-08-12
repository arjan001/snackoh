<?php
include_once './includes/session_check.php';
include_once './config/config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$production_id = intval($_GET['id'] ?? 0);

if ($production_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid production ID']);
    exit;
}

try {
    // Get production details
    $query = "
        SELECT 
            nbp.*,
            p.product_name,
            p.product_price,
            c.category_name,
            e.full_name as produced_by_name,
            e.email as employee_email
        FROM new_batch_production nbp
        LEFT JOIN products p ON nbp.product_id = p.id
        LEFT JOIN categories c ON nbp.category_id = c.id
        LEFT JOIN employees e ON nbp.produced_by = e.id
        WHERE nbp.id = ?
    ";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $production_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $production = $result->fetch_assoc();
    $stmt->close();
    
    if (!$production) {
        echo json_encode(['success' => false, 'message' => 'Production record not found']);
        exit;
    }
    
    // Calculate duration
    $start_time = new DateTime($production['production_datetime']);
    $end_time = $production['estimated_completion'] ? new DateTime($production['estimated_completion']) : new DateTime();
    $duration = $start_time->diff($end_time);
    $duration_text = $duration->h . 'h ' . $duration->i . 'm';
    
    // Format dates
    $production_date = date('M d, Y', strtotime($production['production_datetime']));
    $production_time = date('H:i', strtotime($production['production_datetime']));
    $completion_time = $production['estimated_completion'] ? date('H:i', strtotime($production['estimated_completion'])) : 'N/A';
    
    // Calculate efficiency (placeholder - you can add actual calculations)
    $efficiency = 95; // This could be calculated based on actual vs expected output
    
    // Generate HTML content
    $html = "
    <div class='production-report-details'>
        <div class='row'>
            <div class='col-md-6'>
                <h6><strong>Production Information</strong></h6>
                <table class='table table-sm'>
                    <tr><td><strong>Batch ID:</strong></td><td>{$production['batch_id']}</td></tr>
                    <tr><td><strong>Product:</strong></td><td>{$production['product_name']}</td></tr>
                    <tr><td><strong>Category:</strong></td><td>{$production['category_name']}</td></tr>
                    <tr><td><strong>Quantity Produced:</strong></td><td>{$production['quantity_produced']} units</td></tr>
                    <tr><td><strong>Status:</strong></td><td><span class='badge bg-" . ($production['status'] == 'Completed' ? 'success' : 'warning') . "'>{$production['status']}</span></td></tr>
                </table>
            </div>
            <div class='col-md-6'>
                <h6><strong>Timing Details</strong></h6>
                <table class='table table-sm'>
                    <tr><td><strong>Production Date:</strong></td><td>{$production_date}</td></tr>
                    <tr><td><strong>Start Time:</strong></td><td>{$production_time}</td></tr>
                    <tr><td><strong>Completion Time:</strong></td><td>{$completion_time}</td></tr>
                    <tr><td><strong>Duration:</strong></td><td>{$duration_text}</td></tr>
                    <tr><td><strong>Efficiency:</strong></td><td>{$efficiency}%</td></tr>
                </table>
            </div>
        </div>
        
        <div class='row mt-3'>
            <div class='col-md-12'>
                <h6><strong>Production Team</strong></h6>
                <table class='table table-sm'>
                    <tr><td><strong>Produced By:</strong></td><td>{$production['produced_by_name']}</td></tr>
                    <tr><td><strong>Employee Email:</strong></td><td>{$production['employee_email']}</td></tr>
                </table>
            </div>
        </div>
        
        <div class='row mt-3'>
            <div class='col-md-12'>
                <h6><strong>Production Summary</strong></h6>
                <div class='alert alert-info'>
                    <strong>Total Production:</strong> {$production['quantity_produced']} units<br>
                    <strong>Product Value:</strong> KSH " . number_format($production['quantity_produced'] * $production['product_price'], 2) . "<br>
                    <strong>Production Efficiency:</strong> {$efficiency}%
                </div>
            </div>
        </div>
    </div>
    ";
    
    echo json_encode([
        'success' => true,
        'html' => $html,
        'data' => $production
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error fetching production details: ' . $e->getMessage()
    ]);
}
?> 