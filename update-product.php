<?php
include_once "./config/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get product ID
    $product_id = $_POST['product_id'];

    // Sanitize input data
    $product_name = trim($_POST['product_name']);
    $product_category = $_POST['product_category'];
    $product_unit = $_POST['product_unit'];
    $product_quantity = $_POST['product_quantity'];
    $product_price = $_POST['product_price'];
    $product_quantity_alert = $_POST['product_quantity_alert'];
    $product_manufactured_date = $_POST['product_manufactured_date'];

    // Fetch the existing product details
    $stmt = $conn->prepare("SELECT product_image FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $stmt->bind_result($existing_image);
    $stmt->fetch();
    $stmt->close();

    // Handle image upload
    if (!empty($_FILES['product_image']['name'])) {
        $target_dir = "uploads/";
        $imageFileType = strtolower(pathinfo($_FILES["product_image"]["name"], PATHINFO_EXTENSION));
        $new_image_name = time() . '_' . uniqid() . '.' . $imageFileType;
        $target_file = $target_dir . $new_image_name;

        // Validate image type
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowed_types)) {
            die("Error: Only JPG, JPEG, PNG & GIF files are allowed.");
        }

        // Move uploaded file
        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
            // Delete the old image if it exists
            if (!empty($existing_image) && file_exists($target_dir . $existing_image)) {
                unlink($target_dir . $existing_image);
            }
            $product_image = $new_image_name;
        } else {
            die("Error uploading image.");
        }
    } else {
        $product_image = $existing_image; // Keep the existing image if no new one is uploaded
    }

    // Update product details
    $update_sql = "UPDATE products 
                   SET product_name=?, product_category=?, product_unit=?, product_quantity=?, product_price=?, 
                       product_quantity_alert=?, manufactured_on=?, product_image=? 
                   WHERE id=?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("siidddssi", $product_name, $product_category, $product_unit, $product_quantity, $product_price, $product_quantity_alert, $product_manufactured_date, $product_image, $product_id);

    if ($stmt->execute()) {
        header("Location: product-list.php?success=Product updated successfully");
    } else {
        die("Error updating product: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
} else {
    die("Invalid request");
}
