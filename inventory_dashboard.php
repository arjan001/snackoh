<?php
include_once './config/config.php';

echo "<h2>📊 Inventory Dashboard</h2>";

// Stock Levels
echo "<h3>📦 Stock Levels</h3>";
$result = $conn->query("SELECT product_name, stock_quantity, reorder_level, unit FROM stock ORDER BY stock_quantity ASC LIMIT 10");
if ($result && $result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Ingredient</th><th>Current</th><th>Reorder Level</th><th>Status</th></tr>";
    while ($row = $result->fetch_assoc()) {
        $status = $row['stock_quantity'] <= $row['reorder_level'] ? 'Low Stock' : 'OK';
        $color = $row['stock_quantity'] <= $row['reorder_level'] ? 'red' : 'green';
        echo "<tr>";
        echo "<td>{$row['product_name']}</td>";
        echo "<td>{$row['stock_quantity']} {$row['unit']}</td>";
        echo "<td>{$row['reorder_level']} {$row['unit']}</td>";
        echo "<td style='color: {$color};'>{$status}</td>";
        echo "</tr>";
    }
    echo "</table>";
}

// Reorder Notifications
echo "<h3>⚠️ Reorder Notifications</h3>";
$result = $conn->query("SELECT ingredient_name, current_quantity, suggested_quantity, status FROM reorder_notifications WHERE status IN ('pending', 'acknowledged') ORDER BY notification_date DESC LIMIT 5");
if ($result && $result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Ingredient</th><th>Current</th><th>Suggested</th><th>Status</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['ingredient_name']}</td>";
        echo "<td>{$row['current_quantity']}</td>";
        echo "<td>{$row['suggested_quantity']}</td>";
        echo "<td>{$row['status']}</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No pending reorder notifications.</p>";
}

// Waste Summary
echo "<h3>🗑️ Waste Summary</h3>";
$result = $conn->query("SELECT ingredient_name, SUM(waste_quantity) as total_waste, waste_reason FROM ingredient_waste GROUP BY ingredient_name, waste_reason ORDER BY total_waste DESC LIMIT 10");
if ($result && $result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Ingredient</th><th>Total Waste</th><th>Reason</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['ingredient_name']}</td>";
        echo "<td>{$row['total_waste']}</td>";
        echo "<td>{$row['waste_reason']}</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No waste records found.</p>";
}

echo "<h3>⚡ Quick Actions</h3>";
echo "<p><a href='automated_reorder_system.php?run_check=1'>Check Reorder Triggers</a></p>";
echo "<p><a href='waste_tracking_system.php'>Record Waste</a></p>";
echo "<p><a href='manage-stocks.php'>Manage Stock</a></p>";

$conn->close();
?> 