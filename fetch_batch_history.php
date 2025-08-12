<?php
include_once "./config/config.php";

// Fetch batch history with employee names
$sql = "SELECT 
            nbp.batch_id, 
            p.product_name, 
            c.category_name, 
            nbp.quantity_produced, 
            nbp.production_datetime, 
            nbp.estimated_completion, 
            nbp.status, 
            CONCAT(e.first_name, ' ', e.last_name) AS produced_by
        FROM new_batch_production nbp
        JOIN products p ON nbp.product_id = p.id
        JOIN product_category c ON nbp.category_id = c.id
        LEFT JOIN employees e ON nbp.produced_by = e.id"; // Fetch employee full name

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $batchHistory = [];

    while ($row = $result->fetch_assoc()) {
        $batchHistory[] = $row;
    }

    echo json_encode($batchHistory);
} else {
    echo json_encode([]);
}
?>
