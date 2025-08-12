<?php
include_once './config/config.php';

echo "<h2>🚚 Testing Delivery-Order Integration</h2>";

// Test 1: Check orders
$result = $conn->query("SELECT COUNT(*) as count FROM orders");
$row = $result->fetch_assoc();
echo "Total orders: " . $row['count'] . "<br>";

// Test 2: Check deliveries
$result = $conn->query("SELECT COUNT(*) as count FROM deliveries");
$row = $result->fetch_assoc();
echo "Total deliveries: " . $row['count'] . "<br>";

// Test 3: Check customers with orders
$result = $conn->query("SELECT DISTINCT c.id, c.customer_name, COUNT(o.id) as order_count 
                       FROM customers c 
                       INNER JOIN orders o ON c.id = o.customer_id 
                       GROUP BY c.id 
                       ORDER BY order_count DESC 
                       LIMIT 3");
if ($result->num_rows > 0) {
    echo "<strong>Customers with Orders:</strong><br>";
    while ($row = $result->fetch_assoc()) {
        echo "- {$row['customer_name']}: {$row['order_count']} orders<br>";
    }
}

echo "<h3>✅ Integration Ready!</h3>";
echo "<p><a href='deliveries.php'>Go to Deliveries Page</a></p>";

$conn->close();
?> 