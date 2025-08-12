<?php
include_once './config/config.php';

echo "<h2>📦 Stock Table Structure</h2>";

$result = $conn->query("DESCRIBE stock");
if ($result) {
    echo "<table border='1'>";
    echo "<tr><th>Field</th><th>Type</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['Field']}</td><td>{$row['Type']}</td></tr>";
    }
    echo "</table>";
}

$conn->close();
?> 