<?php
include('config/config.php');

if (isset($_GET['id'])) {
    $customer_id = intval($_GET['id']);
    $sql = "SELECT physical_address FROM customers WHERE id = $customer_id";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
    echo json_encode($data);
}
?>
