<?php
include_once './config/config.php';

class AutomatedReorderSystem {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    public function checkReorderTriggers() {
        $query = "SELECT product_name, stock_quantity, reorder_level, unit 
                 FROM stock WHERE reorder_level > 0 AND stock_quantity <= reorder_level";
        
        $result = $this->conn->query($query);
        $reorder_items = [];
        
        while ($row = $result->fetch_assoc()) {
            $reorder_items[] = $row;
        }
        
        return $reorder_items;
    }
    
    public function generateReorderNotifications($reorder_items) {
        $notifications_created = 0;
        
        foreach ($reorder_items as $item) {
            $suggested_quantity = $item['reorder_level'] * 3;
            
            $stmt = $this->conn->prepare("
                INSERT INTO reorder_notifications 
                (ingredient_name, current_quantity, reorder_level, suggested_quantity) 
                VALUES (?, ?, ?, ?)
            ");
            $stmt->bind_param("sdii", 
                $item['product_name'], 
                $item['stock_quantity'], 
                $item['reorder_level'], 
                $suggested_quantity
            );
            
            if ($stmt->execute()) {
                $notifications_created++;
            }
            $stmt->close();
        }
        
        return $notifications_created;
    }
}

// Run the check
if (isset($_GET['run_check'])) {
    $reorder_system = new AutomatedReorderSystem($conn);
    
    echo "<h2>🔄 Automated Reorder Check</h2>";
    
    $reorder_items = $reorder_system->checkReorderTriggers();
    
    if (empty($reorder_items)) {
        echo "<p>✅ No reorder triggers found.</p>";
    } else {
        echo "<h3>⚠️ Reorder Triggers Found:</h3>";
        foreach ($reorder_items as $item) {
            echo "<p>{$item['product_name']}: {$item['stock_quantity']} {$item['unit']} (Reorder Level: {$item['reorder_level']})</p>";
        }
        
        $notifications_created = $reorder_system->generateReorderNotifications($reorder_items);
        echo "<p>✅ Created {$notifications_created} reorder notifications.</p>";
    }
}

$conn->close();
?> 