<?php
require_once 'config/config.php'; // Ensure database connection is included

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $product_name = $conn->real_escape_string($_POST['product_name']);
    $category_id = intval($_POST['category_id']);
    $quantity = intval($_POST['quantity']);
    $product_category = $conn->real_escape_string($_POST['product_category']);
    $damaged_date = $_POST['damaged_date'];
    $reported_by = intval($_POST['reported_by']);
    $damage_type = $conn->real_escape_string($_POST['damage_type']);
    $location = $conn->real_escape_string($_POST['location']);
    $resolution = $conn->real_escape_string($_POST['resolution']);

    // Insert data into the damaged_goods table
    $sql = "INSERT INTO damaged_goods (product_name, category_id, quantity, product_category, damaged_date, reported_by, damage_type, location, resolution)
            VALUES ('$product_name', $category_id, $quantity, '$product_category', '$damaged_date', $reported_by, '$damage_type', '$location', '$resolution')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Damaged goods report submitted successfully.'); window.location.href='damaged-goods.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
?>
