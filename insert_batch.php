<?php
include_once "./includes/session_check.php";
include_once "./config/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate required fields
    if (!isset($_POST['batch_id'], $_POST['product_id'], $_POST['category_id'], $_POST['recipe_id'], $_POST['quantity_produced'], $_POST['production_datetime'], $_POST['estimated_completion'], $_POST['status'])) {
        die("Error: Missing required fields.");
    }

    // Ensure session employee ID exists
    if (!isset($_SESSION['employee_id'])) {
        die("Error: User not authenticated.");
    }

    // Sanitize input
    $batch_id = trim($_POST['batch_id']);
    $product_id = (int) $_POST['product_id'];
    $category_id = (int) $_POST['category_id'];
    $recipe_id = (int) $_POST['recipe_id'];
    $quantity_produced = (int) $_POST['quantity_produced'];
    $production_datetime = date("Y-m-d H:i:s", strtotime($_POST['production_datetime']));
    $estimated_completion = date("Y-m-d H:i:s", strtotime($_POST['estimated_completion']));
    $status = trim($_POST['status']);
    $produced_by = (int) $_SESSION['employee_id']; // Get the logged-in employee ID

    // Insert batch into database
    $stmt = $conn->prepare("INSERT INTO new_batch_production 
                            (batch_id, product_id, category_id, recipe_id, quantity_produced, production_datetime, estimated_completion, status, produced_by) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("siiissssi", $batch_id, $product_id, $category_id, $recipe_id, $quantity_produced, $production_datetime, $estimated_completion, $status, $produced_by);

    if ($stmt->execute()) {
        echo "Batch created successfully.";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
