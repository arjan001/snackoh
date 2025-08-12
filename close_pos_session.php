<?php
session_start();
include './config/config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

// Ensure employee_id is available
if (!isset($_SESSION['employee_id'])) {
    $_SESSION['employee_id'] = $_SESSION['user_id'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $session_id = trim($_POST['session_id'] ?? '');
    $closing_amount = floatval($_POST['closing_amount'] ?? 0);
    $notes = trim($_POST['notes'] ?? '');
    $employee_id = $_SESSION['employee_id'] ?? 0;
    
    // Debug information
    error_log("Close Session Debug - Session ID: '$session_id', Employee ID: $employee_id, Closing Amount: $closing_amount");
    error_log("POST data: " . print_r($_POST, true));
    error_log("Raw POST data: " . file_get_contents('php://input'));
    
    if (empty($session_id)) {
        echo json_encode(['success' => false, 'message' => 'Session ID is required']);
        exit;
    }
    
    if ($closing_amount < 0) {
        echo json_encode(['success' => false, 'message' => 'Closing amount cannot be negative']);
        exit;
    }
    
    try {
        // Get current session data
        $session_query = "SELECT * FROM pos_sessions WHERE session_id = ? AND employee_id = ? AND status = 'open'";
        $stmt = $conn->prepare($session_query);
        $stmt->bind_param("si", $session_id, $employee_id);
        $stmt->execute();
        $session_result = $stmt->get_result();
        $session_data = $session_result->fetch_assoc();
        $stmt->close();
        
        if (!$session_data) {
            echo json_encode(['success' => false, 'message' => 'Session not found or already closed']);
            exit;
        }
        
        // Calculate total sales from orders
        $sales_query = "SELECT SUM(total_price) as total_sales, COUNT(*) as total_transactions 
                       FROM orders 
                       WHERE created_at >= ? AND created_at <= NOW()";
        $stmt = $conn->prepare($sales_query);
        $stmt->bind_param("s", $session_data['opening_time']);
        $stmt->execute();
        $sales_result = $stmt->get_result();
        $sales_data = $sales_result->fetch_assoc();
        $stmt->close();
        
        $total_sales = $sales_data['total_sales'] ?? 0;
        $total_transactions = $sales_data['total_transactions'] ?? 0;
        
        // Update session with closing data
        $update_query = "UPDATE pos_sessions SET 
                        closing_amount = ?, 
                        total_sales = ?, 
                        total_transactions = ?, 
                        closing_time = NOW(), 
                        status = 'closed',
                        notes = CONCAT(IFNULL(notes, ''), '\n', ?)
                        WHERE session_id = ? AND employee_id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("ddiss", $closing_amount, $total_sales, $total_transactions, $notes, $session_id, $employee_id);
        
        if ($stmt->execute()) {
            // Create daily summary
            $summary_query = "INSERT INTO daily_batch_summaries 
                            (date, session_id, employee_id, opening_amount, closing_amount, total_sales, total_transactions)
                            VALUES (CURDATE(), ?, ?, ?, ?, ?, ?)
                            ON DUPLICATE KEY UPDATE
                            closing_amount = VALUES(closing_amount),
                            total_sales = VALUES(total_sales),
                            total_transactions = VALUES(total_transactions)";
            $stmt2 = $conn->prepare($summary_query);
            $stmt2->bind_param("sidddi", $session_id, $employee_id, $session_data['opening_amount'], $closing_amount, $total_sales, $total_transactions);
            $stmt2->execute();
            $stmt2->close();
            
            echo json_encode([
                'success' => true, 
                'message' => 'POS session closed successfully! Session summary: Opening KSH ' . number_format($session_data['opening_amount'], 2) . ', Closing KSH ' . number_format($closing_amount, 2) . ', Sales KSH ' . number_format($total_sales, 2),
                'summary' => [
                    'opening_amount' => $session_data['opening_amount'],
                    'closing_amount' => $closing_amount,
                    'total_sales' => $total_sales,
                    'total_transactions' => $total_transactions
                ]
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to close session']);
        }
        $stmt->close();
        
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?> 