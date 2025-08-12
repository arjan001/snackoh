<?php
include_once "./config/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $batchId = $_POST['batchId'];
    $itemName = $_POST['itemName'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $productionDateTime = $_POST['productionDateTime'];
    $completionTime = $_POST['completionTime'];
    $status = $_POST['status'];

    $sql = "UPDATE new_batch_production SET 
                product_id = (SELECT id FROM products WHERE name = ?), 
                category_id = (SELECT id FROM categories WHERE name = ?), 
                quantity_produced = ?, 
                production_datetime = ?, 
                estimated_completion = ?, 
                status = ? 
            WHERE batch_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisiss", $itemName, $category, $quantity, $productionDateTime, $completionTime, $status, $batchId);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Batch updated successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update batch"]);
    }

    $stmt->close();
    $conn->close();
}
?>
