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
    $opening_amount = floatval($_POST['opening_amount'] ?? 0);
    $notes = trim($_POST['notes'] ?? '');
    $employee_id = $_SESSION['employee_id'] ?? 0;
    
    // Debug information
    error_log("POS Session Debug - User ID: " . ($_SESSION['user_id'] ?? 'NOT SET') . ", Employee ID: " . $employee_id);
    
    if ($opening_amount <= 0) {
        echo json_encode(['success' => false, 'message' => 'Opening amount must be greater than 0']);
        exit;
    }
    
    if ($employee_id <= 0) {
        echo json_encode(['success' => false, 'message' => 'Employee ID not found']);
        exit;
    }
    
    try {
        // Check if employee already has an open session
        $check_query = "SELECT id FROM pos_sessions WHERE employee_id = ? AND status = 'open'";
        $stmt = $conn->prepare($check_query);
        $stmt->bind_param("i", $employee_id);
        $stmt->execute();
        $existing_session = $stmt->get_result();
        $stmt->close();
        
        if ($existing_session->num_rows > 0) {
            echo json_encode(['success' => false, 'message' => 'You already have an active POS session. Please close your current session before opening a new one.']);
            exit;
        }
        
        // Generate session ID
        $session_id = 'POS-' . date('Y-m-d-H-i-s') . '-' . $employee_id;
        
        // Insert new session
        $insert_query = "INSERT INTO pos_sessions (session_id, employee_id, opening_amount, notes, status) VALUES (?, ?, ?, ?, 'open')";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("sids", $session_id, $employee_id, $opening_amount, $notes);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Session opened successfully', 'session_id' => $session_id]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to open session']);
        }
        $stmt->close();
        
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?> 