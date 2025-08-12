<?php
include_once './config/config.php';

echo "<h2>📋 Orders Table Structure</h2>";

try {
    $result = $conn->query("DESCRIBE orders");
    if ($result) {
        echo "<table border='1' style='border-collapse: collapse;'>";
        echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['Field'] . "</td>";
            echo "<td>" . $row['Type'] . "</td>";
            echo "<td>" . $row['Null'] . "</td>";
            echo "<td>" . $row['Key'] . "</td>";
            echo "<td>" . $row['Default'] . "</td>";
            echo "<td>" . $row['Extra'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "❌ Error describing orders table: " . $conn->error;
    }
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}

echo "<h2>📊 Sample Orders Data</h2>";
try {
    $result = $conn->query("SELECT * FROM orders ORDER BY id DESC LIMIT 5");
    if ($result && $result->num_rows > 0) {
        echo "<table border='1' style='border-collapse: collapse;'>";
        echo "<tr><th>ID</th><th>Transaction ID</th><th>Customer ID</th><th>Employee ID</th><th>Total Price</th><th>Payment Status</th><th>Payment Type</th><th>Created At</th></tr>";
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['transaction_id'] . "</td>";
            echo "<td>" . ($row['customer_id'] ?? 'NULL') . "</td>";
            echo "<td>" . $row['employee_id'] . "</td>";
            echo "<td>" . $row['total_price'] . "</td>";
            echo "<td>" . $row['payment_status'] . "</td>";
            echo "<td>" . $row['payment_type'] . "</td>";
            echo "<td>" . $row['created_at'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "ℹ️ No orders found in the database.";
    }
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}

$conn->close();
?> 