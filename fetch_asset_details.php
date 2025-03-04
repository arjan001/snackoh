
<?php
// Database connection
include('config/config.php');
$asset_id = $_POST['asset_id'];

$query = "SELECT serial_number, current_cost FROM assets WHERE id = '$asset_id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
echo json_encode($row);
?>
