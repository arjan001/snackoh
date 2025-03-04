<?php
include('config/config.php');

$query = "SELECT p.*, a.asset_name, a.asset_code, a.last_maintenance 
          FROM asset_replacement_policy p 
          JOIN assets a ON p.asset_id = a.id";
$result = mysqli_query($conn, $query);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);
?>
