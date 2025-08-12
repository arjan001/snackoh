<?php
// Database connection
include('config/config.php');

$query = "SELECT id, asset_name FROM assets";
$result = mysqli_query($conn, $query);
$options = "";
while ($row = mysqli_fetch_assoc($result)) {
    $options .= "<option value='{$row['id']}'>{$row['asset_name']}</option>";
}
echo $options;
?>
