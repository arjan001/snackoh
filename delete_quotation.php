<?php
include_once './includes/session_check.php';
include_once './config/config.php';
include_once './includes/notifications.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$quotation_id = intval($_POST['quotation_id'] ?? 0);

if ($quotation_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid quotation ID']);
    exit;
}

try {
    // Get quotation details for notification
    $stmt = $conn->prepare("SELECT quotation_number, customer_name FROM quotations WHERE id = ?");
    $stmt->bind_param("i", $quotation_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $quotation = $result->fetch_assoc();
    $stmt->close();
    
    if (!$quotation) {
        echo json_encode(['success' => false, 'message' => 'Quotation not found']);
        exit;
    }
    
    // Start transaction
    $conn->begin_transaction();
    
    try {
        // Delete quotation items first (due to foreign key constraint)
        $delete_items = $conn->prepare("DELETE FROM quotation_items WHERE quotation_id = ?");
        $delete_items->bind_param("i", $quotation_id);
        $delete_items->execute();
        $delete_items->close();
        
        // Delete quotation
        $delete_quotation = $conn->prepare("DELETE FROM quotations WHERE id = ?");
        $delete_quotation->bind_param("i", $quotation_id);
        $delete_quotation->execute();
        $delete_quotation->close();
        
        // Commit transaction
        $conn->commit();
        
        // Add notification
        addNotification(
            "Quotation Deleted",
            "Quotation #{$quotation['quotation_number']} for {$quotation['customer_name']} has been deleted",
            'warning'
        );
        
        echo json_encode([
            'success' => true,
            'message' => 'Quotation deleted successfully'
        ]);
        
    } catch (Exception $e) {
        $conn->rollback();
        throw $e;
    }
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error deleting quotation: ' . $e->getMessage()
    ]);
}
?> 