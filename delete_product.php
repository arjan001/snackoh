<?php
include('config/config.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product_id = $_GET['id'];

    // Get the product image filename
    $sql = "SELECT product_image FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $image_path = "uploads/" . $row['product_image'];

        // Delete product from database
        $delete_sql = "DELETE FROM products WHERE id = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("i", $product_id);

        if ($delete_stmt->execute()) {
            // Delete the product image if it exists
            if (!empty($row['product_image']) && file_exists($image_path)) {
                unlink($image_path);
            }

            echo "<script>alert('Product deleted successfully'); window.location.href='./product-list.php';</script>";
        } else {
            echo "<script>alert('Error deleting product: " . $conn->error . "'); window.location.href='./product-list.php';</script>";
        }
    } else {
        echo "<script>alert('Product not found'); window.location.href='./product-list.php';</script>";
    }

    $stmt->close();
    $delete_stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Invalid request'); window.location.href='./product-list.php';</script>";
}
?>
