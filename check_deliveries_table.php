<?php
include_once './config/config.php';

echo "<h2>🚚 Deliveries Table Structure</h2>";

try {
    $result = $conn->query("DESCRIBE deliveries");
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
        echo "❌ Error describing deliveries table: " . $conn->error;
    }
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}

echo "<h2>📊 Sample Deliveries Data</h2>";
try {
    $result = $conn->query("SELECT * FROM deliveries ORDER BY id DESC LIMIT 5");
    if ($result && $result->num_rows > 0) {
        echo "<table border='1' style='border-collapse: collapse;'>";
        echo "<tr><th>ID</th><th>Customer ID</th><th>Address</th><th>Order ID</th><th>Schedule DateTime</th><th>Driver ID</th><th>Vehicle ID</th><th>Notification Method</th></tr>";
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['customer_id'] . "</td>";
            echo "<td>" . $row['address'] . "</td>";
            echo "<td>" . ($row['order_id'] ?? 'NULL') . "</td>";
            echo "<td>" . $row['schedule_datetime'] . "</td>";
            echo "<td>" . $row['driver_id'] . "</td>";
            echo "<td>" . $row['vehicle_id'] . "</td>";
            echo "<td>" . $row['notification_method'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "ℹ️ No deliveries found in the database.";
    }
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}

$conn->close();
?> 