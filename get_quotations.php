<?php
include_once './includes/session_check.php';
include_once './config/config.php';

header('Content-Type: application/json');

try {
    $search = $_GET['search'] ?? '';
    $status = $_GET['status'] ?? '';
    
    $query = "
        SELECT 
            q.*,
            DATE_FORMAT(q.quotation_date, '%d.%m.%Y') as quotation_date_formatted,
            DATE_FORMAT(q.expiry_date, '%d.%m.%Y') as expiry_date_formatted,
            CASE 
                WHEN q.status = 'draft' THEN '<span class=\"badges bg-lightgreen\">Draft</span>'
                WHEN q.status = 'sent' THEN '<span class=\"badges bg-lightblue\">Sent</span>'
                WHEN q.status = 'accepted' THEN '<span class=\"badges bg-lightgreen\">Accepted</span>'
                WHEN q.status = 'rejected' THEN '<span class=\"badges bg-lightred\">Rejected</span>'
                WHEN q.status = 'expired' THEN '<span class=\"badges bg-lightred\">Expired</span>'
                ELSE '<span class=\"badges bg-lightgray\">Unknown</span>'
            END as status_badge
        FROM quotations q
        WHERE 1=1
    ";
    
    $params = [];
    $types = '';
    
    if (!empty($search)) {
        $query .= " AND (q.quotation_number LIKE ? OR q.customer_name LIKE ? OR q.customer_email LIKE ?)";
        $search_param = "%$search%";
        $params[] = $search_param;
        $params[] = $search_param;
        $params[] = $search_param;
        $types .= 'sss';
    }
    
    if (!empty($status)) {
        $query .= " AND q.status = ?";
        $params[] = $status;
        $types .= 's';
    }
    
    $query .= " ORDER BY q.created_at DESC";
    
    $stmt = $conn->prepare($query);
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    
    $quotations = [];
    while ($row = $result->fetch_assoc()) {
        $quotations[] = [
            'id' => $row['id'],
            'quotation_number' => $row['quotation_number'],
            'customer_name' => $row['customer_name'],
            'quotation_date' => $row['quotation_date_formatted'],
            'status' => $row['status'],
            'status_badge' => $row['status_badge'],
            'grand_total' => number_format($row['grand_total'], 2)
        ];
    }
    $stmt->close();
    
    echo json_encode([
        'success' => true,
        'data' => $quotations
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error fetching quotations: ' . $e->getMessage()
    ]);
}
?> 