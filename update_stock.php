<?php
include_once "config/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stock_id = $_POST['stock_id'];
    $stock_item_name = $_POST['stock_item_name'];
    $stock_category_id = $_POST['stock_category_id'];
    $stock_quantity = $_POST['stock_quantity'];
    $stock_unit = $_POST['stock_unit'];
    $stock_expiry_date = $_POST['stock_expiry_date'];
    $stock_price = $_POST['stock_price'];
    $stock_supplier_id = $_POST['stock_supplier_id'];
    $reorder_level = $_POST['reorder_level'];

    $sql = "UPDATE stock SET 
                stock_item_name = ?, 
                stock_category_id = ?, 
                stock_quantity = ?, 
                stock_unit = ?, 
                stock_expiry_date = ?, 
                stock_price = ?, 
                stock_supplier_id = ?, 
                reorder_level = ? 
            WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siissdsii", $stock_item_name, $stock_category_id, $stock_quantity, $stock_unit, $stock_expiry_date, $stock_price, $stock_supplier_id, $reorder_level, $stock_id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Stock updated successfully'); window.location.href='manage-stocks.php';</script>";
    } else {
        echo "<script>alert('Error updating stock'); history.back();</script>";
    }
    
    $stmt->close();
}
$conn->close();
?>
