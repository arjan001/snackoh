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
    $reorder_level = intval($_POST['reorder_level']); // NEW REORDER LEVEL
    $status = 'active'; // Assuming active status on new items

    // SQL query to insert stock data into stock table
    $sql = "INSERT INTO stock (product_name, stock_category_id, stock_quantity, stock_price, stock_expiry_date, stock_unit, reorder_level, status) 
            VALUES ('$stock_item_name', $stock_category_id, $stock_quantity, $stock_price, '$stock_expiry_date', $stock_unit, $reorder_level, '$status')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Stock item added successfully'); window.location.href='./manage-stocks.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>
