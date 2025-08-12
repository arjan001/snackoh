<?php
include_once 'config/config.php' ; // Include your database connection
// Fetch customers with latitude & longitude
$sql = "SELECT customer_name, phone, physical_address, latitude, longitude FROM customers WHERE latitude IS NOT NULL AND longitude IS NOT NULL";
$result = $conn->query($sql);

$customers = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $customers[] = $row;
    }
}

// Return JSON data
echo json_encode($customers);

$conn->close();

