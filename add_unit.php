<?php
 include_once "./config/config.php";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $unit_name = $conn->real_escape_string($_POST['unit_name']);
    $short_name = $conn->real_escape_string($_POST['short_name']);
    $no_of_products = intval($_POST['no_of_products']);
    $status = isset($_POST['status']) ? 'active' : 'inactive';

    // Insert query
    $sql = "INSERT INTO units (unit_name, short_name, no_of_products, status) 
            VALUES ('$unit_name', '$short_name', $no_of_products, '$status')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Unit added successfully'); window.location.href='./assets-category.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>
