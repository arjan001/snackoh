<?php
// Database connection
include('config/config.php');

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_name = trim($_POST["category_name"]);
    $category_description = trim($_POST["category_description"]);
    $status = isset($_POST["status"]) ? 1 : 0; // Checkbox value

    // Validate input
    if (empty($category_name)) {
        die("Category Name is required.");
    }

    // Prepare and execute insert query
    $stmt = $conn->prepare("INSERT INTO asset_category (category_name, category_description, status) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $category_name, $category_description, $status);

    if ($stmt->execute()) {
        echo"<script>alert('Asset Category added successfully'); window.location.href='./assets-category.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Close connection
$conn->close();
?>
