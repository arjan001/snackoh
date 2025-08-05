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

try {
    // Get form data
    $quotation_id = intval($_POST['quotation_id'] ?? 0);
    $customer_id = $_POST['customer_id'] ?? null;
    $customer_name = trim($_POST['customer_name'] ?? '');
    $customer_email = trim($_POST['customer_email'] ?? '');
    $customer_phone = trim($_POST['customer_phone'] ?? '');
    $quotation_date = $_POST['quotation_date'] ?? date('Y-m-d');
    $expiry_date = $_POST['expiry_date'] ?? date('Y-m-d', strtotime('+30 days'));
    $tax_rate = floatval($_POST['tax_rate'] ?? 0);
    $discount = floatval($_POST['discount'] ?? 0);
    $shipping = floatval($_POST['shipping'] ?? 0);
    $status = $_POST['status'] ?? 'draft';
    $notes = trim($_POST['notes'] ?? '');
    $terms_conditions = trim($_POST['terms_conditions'] ?? '');
    $items = json_decode($_POST['items'] ?? '[]', true);
    
    // Validate required fields
    if ($quotation_id <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid quotation ID']);
        exit;
    }
    
    if (empty($customer_name)) {
        echo json_encode(['success' => false, 'message' => 'Customer name is required']);
        exit;
    }
    
    if (empty($items) || count($items) == 0) {
        echo json_encode(['success' => false, 'message' => 'At least one item is required']);
        exit;
    }
    
    // Calculate totals
    $subtotal = 0;
    foreach ($items as $item) {
        $item_total = ($item['quantity'] * $item['unit_price']) - $item['discount'];
        $subtotal += $item_total;
    }
    
    $tax_amount = $subtotal * ($tax_rate / 100);
    $grand_total = $subtotal + $tax_amount + $shipping - $discount;
    
    // Start transaction
    $conn->begin_transaction();
    
    try {
        // Update quotation
        $stmt = $conn->prepare("
            UPDATE quotations SET 
                customer_id = ?, customer_name = ?, customer_email = ?, customer_phone = ?,
                quotation_date = ?, expiry_date = ?, subtotal = ?, tax_rate = ?, tax_amount = ?, 
                discount = ?, shipping = ?, grand_total = ?, status = ?, notes = ?, 
                terms_conditions = ?, updated_at = NOW()
            WHERE id = ?
        ");
        
        $stmt->bind_param("isssssddddddsssi", 
            $customer_id, $customer_name, $customer_email, $customer_phone,
            $quotation_date, $expiry_date, $subtotal, $tax_rate, $tax_amount, 
            $discount, $shipping, $grand_total, $status, $notes, 
            $terms_conditions, $quotation_id
        );
        
        $stmt->execute();
        $stmt->close();
        
        // Delete existing items
        $delete_stmt = $conn->prepare("DELETE FROM quotation_items WHERE quotation_id = ?");
        $delete_stmt->bind_param("i", $quotation_id);
        $delete_stmt->execute();
        $delete_stmt->close();
        
        // Insert new quotation items
        $item_stmt = $conn->prepare("
            INSERT INTO quotation_items (
                quotation_id, product_name, product_description, quantity, unit_price,
                discount, tax_rate, tax_amount, total_amount
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        
        foreach ($items as $item) {
            $item_total = ($item['quantity'] * $item['unit_price']) - $item['discount'];
            $item_tax = $item_total * ($tax_rate / 100);
            
            $item_stmt->bind_param("issdddddd", 
                $quotation_id, $item['product_name'], $item['product_description'], 
                $item['quantity'], $item['unit_price'], $item['discount'], 
                $tax_rate, $item_tax, $item_total
            );
            $item_stmt->execute();
        }
        $item_stmt->close();
        
        // Commit transaction
        $conn->commit();
        
        // Add notification
        addNotification(
            "Quotation Updated",
            "Quotation updated successfully for $customer_name",
            'info'
        );
        
        echo json_encode([
            'success' => true,
            'message' => 'Quotation updated successfully'
        ]);
        
    } catch (Exception $e) {
        $conn->rollback();
        throw $e;
    }
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error updating quotation: ' . $e->getMessage()
    ]);
}
?> 