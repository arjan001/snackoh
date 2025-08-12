<?php
include_once './config/config.php';

// Record waste
if (isset($_POST['record_waste'])) {
    $ingredient_name = $_POST['ingredient_name'];
    $waste_quantity = $_POST['waste_quantity'];
    $waste_reason = $_POST['waste_reason'];
    $waste_date = $_POST['waste_date'];
    
    $stmt = $conn->prepare("INSERT INTO ingredient_waste (ingredient_name, waste_quantity, waste_reason, waste_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdss", $ingredient_name, $waste_quantity, $waste_reason, $waste_date);
    
    if ($stmt->execute()) {
        echo "<p style='color: green;'>✅ Waste recorded successfully!</p>";
    } else {
        echo "<p style='color: red;'>❌ Error recording waste.</p>";
    }
    $stmt->close();
}

// Show waste form
echo "<h2>🗑️ Record Ingredient Waste</h2>";
echo "<form method='POST'>";
echo "<p><label>Ingredient: <input type='text' name='ingredient_name' required></label></p>";
echo "<p><label>Waste Quantity: <input type='number' step='0.01' name='waste_quantity' required></label></p>";
echo "<p><label>Reason: <select name='waste_reason' required>";
echo "<option value='expired'>Expired</option>";
echo "<option value='damaged'>Damaged</option>";
echo "<option value='production_waste'>Production Waste</option>";
echo "<option value='spillage'>Spillage</option>";
echo "<option value='other'>Other</option>";
echo "</select></label></p>";
echo "<p><label>Date: <input type='date' name='waste_date' value='" . date('Y-m-d') . "'></label></p>";
echo "<p><input type='submit' name='record_waste' value='Record Waste'></p>";
echo "</form>";

// Show waste summary
echo "<h3>📊 Waste Summary</h3>";
$result = $conn->query("SELECT ingredient_name, SUM(waste_quantity) as total_waste, waste_reason FROM ingredient_waste GROUP BY ingredient_name, waste_reason ORDER BY total_waste DESC");

if ($result && $result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Ingredient</th><th>Total Waste</th><th>Reason</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['ingredient_name']}</td><td>{$row['total_waste']}</td><td>{$row['waste_reason']}</td></tr>";
    }
    echo "</table>";
} else {
    echo "<p>No waste records found.</p>";
}

$conn->close();
?> 