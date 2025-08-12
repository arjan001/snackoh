<?php
// Database connection
include('config/config.php');

// Fetch all input fields from the form
$asset_id = $_POST['asset_id'];
$serial_number = $_POST['serial_number'];
$purchase_date = $_POST['purchase_date'];
$policy_years = $_POST['policy_years'];
$replacement_date = $_POST['replacement_date'];
$current_value = $_POST['current_value'];
$condition = $_POST['condition'];
$policy_description = $_POST['policy_description']; // Newly added field

// Prevent SQL injection
$asset_id = mysqli_real_escape_string($conn, $asset_id);
$serial_number = mysqli_real_escape_string($conn, $serial_number);
$purchase_date = mysqli_real_escape_string($conn, $purchase_date);
$policy_years = mysqli_real_escape_string($conn, $policy_years);
$replacement_date = mysqli_real_escape_string($conn, $replacement_date);
$current_value = mysqli_real_escape_string($conn, $current_value);
$condition = mysqli_real_escape_string($conn, $condition);
$policy_description = mysqli_real_escape_string($conn, $policy_description);

// Check for duplicate policy
$check_query = "SELECT * FROM asset_replacement_policy WHERE asset_id = '$asset_id'";
$check_result = mysqli_query($conn, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    echo "<script>
            alert('Policy already exists for this asset!');
            window.location.href = 'add_policy.php';
          </script>";
    exit();
}

// Insert data into the database
$query = "INSERT INTO asset_replacement_policy (asset_id, serial_number, purchase_date, policy_years, replacement_date, current_value, asset_condition, policy_description) 
          VALUES ('$asset_id', '$serial_number', '$purchase_date', '$policy_years', '$replacement_date', '$current_value', '$condition', '$policy_description')";

if (mysqli_query($conn, $query)) {
    echo "<script>
            alert('Policy added successfully!');
            window.location.href = 'policy_list.php';
          </script>";
} else {
    echo "<script>
            alert('Error: " . addslashes(mysqli_error($conn)) . "');
            window.location.href = 'add_policy.php';
          </script>";
}

exit();
?>
