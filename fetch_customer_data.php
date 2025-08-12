<?php
include('config/config.php'); // Include your database connection

if (isset($_GET['id'])) {
    $customer_id = $_GET['id'];
    $query = "SELECT * FROM customers WHERE id = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $customer_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $customer_data = $result->fetch_assoc();
            echo json_encode($customer_data); // Return the data as JSON
        } else {
            echo json_encode(['error' => 'Customer not found']);
        }
        $stmt->close();
    } else {
        echo json_encode(['error' => 'Database query failed']);
    }
}
?>
