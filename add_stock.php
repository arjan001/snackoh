<?php
include_once "./config/config.php";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate the inputs
    $stock_item_name = $conn->real_escape_string($_POST['stock_item_name']);
    $stock_category_id = intval($_POST['stock_category_id']);
    $stock_quantity = intval($_POST['stock_quantity']);
    $stock_price = floatval($_POST['stock_price']);
    $stock_expiry_date = $conn->real_escape_string($_POST['stock_expiry_date']);
    $stock_unit = intval($_POST['stock_unit']);
    $reorder_level = intval($_POST['reorder_level']);
    $stock_supplier_id = intval($_POST['stock_supplier_id']); // Ensure supplier ID is included
    $status = 'active';

    // Insert query including stock_supplier_id
    $sql = "INSERT INTO stock (product_name, stock_category_id, stock_quantity, stock_price, stock_expiry_date, stock_unit, reorder_level, stock_supplier_id, status) 
            VALUES ('$stock_item_name', $stock_category_id, $stock_quantity, $stock_price, '$stock_expiry_date', $stock_unit, $reorder_level, $stock_supplier_id, '$status')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Stock item added successfully'); window.location.href='./manage-stocks.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Close connection
$conn->close();

?>
