<?php
 include_once "./config/config.php";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stock_category_name= $conn->real_escape_string($_POST['stock_category_name']);
    $stock_category_description = $conn->real_escape_string($_POST['stock_category_description']);
    $stock_category_status = isset($_POST['stock_category_status']) ? 'active' : 'inactive';

    // Insert query
    $sql = "INSERT INTO stock_category (stock_category_name, stock_category_description, stock_category_status) 
            VALUES ('$stock_category_name', '$stock_category_description', '$stock_category_status')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Stock Category added successfully'); window.location.href='./stocks-category.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>
