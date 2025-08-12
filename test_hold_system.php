<?php
// Test script for Hold Transaction System
include_once './config/config.php';
include_once './includes/notifications.php';

echo "<h2>🧪 Testing Hold Transaction System</h2>";

// Test 1: Database Connection
echo "<h3>1. Database Connection Test</h3>";
if ($conn->ping()) {
    echo "✅ Database connection successful<br>";
} else {
    echo "❌ Database connection failed<br>";
    exit;
}

// Test 2: Check if held_transactions table exists
echo "<h3>2. Held Transactions Table Test</h3>";
$result = $conn->query("SHOW TABLES LIKE 'held_transactions'");
if ($result->num_rows > 0) {
    echo "✅ held_transactions table exists<br>";
    
    // Check table structure
    $result = $conn->query("DESCRIBE held_transactions");
    echo "<strong>Table Structure:</strong><br>";
    while ($row = $result->fetch_assoc()) {
        echo "- {$row['Field']}: {$row['Type']}<br>";
    }
} else {
    echo "❌ held_transactions table does not exist<br>";
}

// Test 3: Check if notifications table exists
echo "<h3>3. Notifications Table Test</h3>";
$result = $conn->query("SHOW TABLES LIKE 'notifications'");
if ($result->num_rows > 0) {
    echo "✅ notifications table exists<br>";
    
    // Check table structure
    $result = $conn->query("DESCRIBE notifications");
    echo "<strong>Table Structure:</strong><br>";
    while ($row = $result->fetch_assoc()) {
        echo "- {$row['Field']}: {$row['Type']}<br>";
    }
} else {
    echo "❌ notifications table does not exist<br>";
}

// Test 4: Test notifications function
echo "<h3>4. Notifications Function Test</h3>";
try {
    $test_result = addNotification(
        "Test Notification",
        "This is a test notification from the hold system",
        'info',
        1
    );
    if ($test_result) {
        echo "✅ Notifications function working<br>";
    } else {
        echo "❌ Notifications function failed<br>";
    }
} catch (Exception $e) {
    echo "❌ Notifications function error: " . $e->getMessage() . "<br>";
}

// Test 5: Check for existing held transactions
echo "<h3>5. Existing Held Transactions</h3>";
$result = $conn->query("SELECT COUNT(*) as count FROM held_transactions");
$row = $result->fetch_assoc();
echo "Current held transactions: {$row['count']}<br>";

if ($row['count'] > 0) {
    $result = $conn->query("SELECT * FROM held_transactions ORDER BY created_at DESC LIMIT 3");
    echo "<strong>Recent held transactions:</strong><br>";
    while ($row = $result->fetch_assoc()) {
        echo "- ID: {$row['hold_id']}, Total: KSH {$row['total_price']}, Date: {$row['created_at']}<br>";
    }
}

echo "<h3>🎉 Hold Transaction System Test Complete!</h3>";
echo "<p><a href='pos.php'>Go to POS</a> to test the full functionality.</p>";
?> 