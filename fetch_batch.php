<?php
include_once "./config/config.php";

$sql = "SELECT 
            b.batch_id, 
            p.product_name, 
            c.category_name, 
            b.quantity_produced, 
            b.production_datetime, 
            b.estimated_completion, 
            b.status, 
            CONCAT(e.first_name, ' ', e.last_name) AS produced_by
        FROM new_batch_production b
        JOIN products p ON b.product_id = p.id
        JOIN product_category c ON b.category_id = c.id
        LEFT JOIN employees e ON b.produced_by = e.id
        ORDER BY b.production_datetime DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $batches = [];
    while ($row = $result->fetch_assoc()) {
        $batches[] = $row;
    }
    echo json_encode($batches);
} else {
    echo json_encode([]);
}
$conn->close();
?>
