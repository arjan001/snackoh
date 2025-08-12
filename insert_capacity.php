<?php
include('config/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate required fields
    if (
        !empty($_POST['product_unit']) &&
        !empty($_POST['category']) &&
        !empty($_POST['max_capacity']) &&
        !empty($_POST['current_usage']) &&
        !empty($_POST['available_capacity']) &&
        !empty($_POST['status']) &&
        !empty($_POST['last_updated'])
    ) {
        // Fetch and sanitize input values
        $asset_id = intval($_POST['product_unit']);
        $category = trim($_POST['category']);
        $max_capacity = intval($_POST['max_capacity']);
        $current_usage = intval($_POST['current_usage']);
        $available_capacity = intval($_POST['available_capacity']);
        $status = trim($_POST['status']);
        $last_updated = $_POST['last_updated'];

        // Check if asset already exists
        $checkQuery = "SELECT id FROM capacity_management WHERE asset_id = ?";
        $stmt = $conn->prepare($checkQuery);
        $stmt->bind_param("i", $asset_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Asset exists, show message
            echo "<script>alert('Asset already exists. Consider updating it or adding a new one.'); window.history.back();</script>";
        } else {
            // Insert new asset
            $insertQuery = "INSERT INTO capacity_management 
                (asset_id, category, max_capacity, current_usage, available_capacity, status, last_updated)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($insertQuery);
            $stmt->bind_param("isiiiss", $asset_id, $category, $max_capacity, $current_usage, $available_capacity, $status, $last_updated);

            if ($stmt->execute()) {
                echo "<script>alert('Capacity record added successfully'); window.location.href='./capacity-manage.php';</script>";
            } else {
                echo "<script>alert('Error adding record: " . $stmt->error . "'); window.history.back();</script>";
            }
        }

        $stmt->close();
    } else {
        echo "<script>alert('All fields are required.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.history.back();</script>";
}

$conn->close();
?>
