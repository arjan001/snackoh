<?php
 include_once "./config/config.php";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $conn->real_escape_string($_POST['product_name']);
    $product_category = $conn->real_escape_string($_POST['product_category']);
    $product_unit = $conn->real_escape_string($_POST['product_unit']);
    $product_quantity = $conn->real_escape_string($_POST['product_quantity']);
    $product_price = $conn->real_escape_string($_POST['product_price']);
    $product_quantity_alert = $conn->real_escape_string($_POST['product_quantity_alert']);
    $manufactured_on = $conn->real_escape_string($_POST['product_manufactured_date']);
   
    

    // Insert query
    $sql = "INSERT INTO products (product_name, product_category, product_unit, product_quantity ,product_price,product_quantity_alert,manufactured_on) 
            VALUES ('$product_name', '$product_category', $product_unit, '$product_quantity', '$product_price' ,'$product_quantity_alert','$manufactured_on')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Unit added successfully'); window.location.href='./product-list.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>
