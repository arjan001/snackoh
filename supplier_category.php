<?php
// Include database connection
include_once "./config/config.php";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the input values and sanitize them
    $category_name = $conn->real_escape_string($_POST['category_name']);
    $category_description = $conn->real_escape_string($_POST['category_description']);

    // Insert query
    $sql = "INSERT INTO supplier_category (category_name, category_description) 
            VALUES ('$category_name', '$category_description')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Redirect to the same page or another page after successful submission
        echo "<script>alert('Supplier Category added successfully'); window.location.href='suppliers.php';</script>";
    } else {
        // Show error if the query fails
        echo "Error: " . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
