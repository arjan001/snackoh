<?php
// Database connection
include('config/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $asset_name = trim($_POST["asset_name"]);
    $category_id = trim($_POST["category_id"]);
    $company_code = trim($_POST["company_code"]);
    $registration_number = trim($_POST["registration_number"]);
    $initial_cost = trim($_POST["initial_cost"]);
    $current_cost = trim($_POST["current_cost"]);
    $status = trim($_POST["status"]);
    $next_maintenance = trim($_POST["next_maintenance"]);
    $ownership = trim($_POST["ownership"]);
    $maintenance_cost = trim($_POST["maintenance_cost"]);
    $depreciation_factor = trim($_POST["depreciation_factor"]);
    $lifespan = trim($_POST["lifespan"]);

    // Prepare and execute insert query
    $stmt = $conn->prepare("INSERT INTO assets (asset_name, category_id, company_code, registration_number, initial_cost, current_cost, status, next_maintenance, ownership, maintenance_cost, depreciation_factor, lifespan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissdssssdsi", $asset_name, $category_id, $company_code, $registration_number, $initial_cost, $current_cost, $status, $next_maintenance, $ownership, $maintenance_cost, $depreciation_factor, $lifespan);

    if ($stmt->execute()) {
        echo "<script>alert('Asset added successfully'); window.location.href='./assets.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Close connection
$conn->close();
?>
