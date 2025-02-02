<?php
 include './config/config.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_name= $conn->real_escape_string($_POST['category_name']);
    $category_slug = $conn->real_escape_string($_POST['category_slug']);
    
    $category_status= isset($_POST['category_status']) ? 'active' : 'inactive';

    // Insert query
    $sql = "INSERT INTO product_category (category_name, category_slug, status) 
            VALUES ('$category_name', '$category_slug', '$category_status')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Product category added successfully'); window.location.href='./product-category.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}



// Close connection
$conn->close();
?>
