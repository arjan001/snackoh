<?php
// Database Connection
include './config/config.php';
include './includes/notifications.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = trim($_POST['product_name'] ?? '');
    $quantity = intval($_POST['quantity'] ?? 1);
    
    if (empty($product_name)) {
        echo json_encode(['success' => false, 'message' => 'Product name is required']);
        exit;
    }
    
    try {
        // Check product stock availability
        $stmt = $conn->prepare("SELECT id, product_quantity FROM products WHERE product_name = ?");
        $stmt->bind_param("s", $product_name);
        $stmt->execute();
        $product_result = $stmt->get_result();
        $product_data = $product_result->fetch_assoc();
        $stmt->close();
        
        if (!$product_data) {
            $error_msg = "❌ PRODUCT NOT FOUND\n\nProduct: '$product_name'\n\nThis product does not exist in the system. Please check the product name or contact administrator.";
            addNotification("Product Not Found", "Product '$product_name' not found in system", 'error');
            echo json_encode(['success' => false, 'message' => $error_msg, 'type' => 'product_not_found']);
            exit;
        }
        
        if ($product_data['product_quantity'] < $quantity) {
            $error_msg = "❌ PRODUCT STOCK INSUFFICIENT\n\nProduct: $product_name\nAvailable: {$product_data['product_quantity']} units\nNeeded: $quantity units\n\nPlease restock this product before adding to cart.";
            addNotification("Product Stock Insufficient", "Product '$product_name' has insufficient stock", 'error');
            echo json_encode([
                'success' => false, 
                'message' => $error_msg,
                'type' => 'product_stock'
            ]);
            exit;
        }
        
        // Check BOM ingredients availability
        $stmt = $conn->prepare("SELECT p.recipe_name, r.recipe_name as recipe_name_text 
                               FROM products p 
                               LEFT JOIN recipes r ON p.recipe_name = r.id 
                               WHERE p.product_name = ?");
        $stmt->bind_param("s", $product_name);
        $stmt->execute();
        $recipe_result = $stmt->get_result();
        $recipe_data = $recipe_result->fetch_assoc();
        $stmt->close();
        
        $insufficient_ingredients = [];
        
        if ($recipe_data && $recipe_data['recipe_name']) {
            // Get recipe ingredients
            $stmt = $conn->prepare("SELECT ingredients_json FROM recipe_ingredients WHERE recipe_id = ?");
            $stmt->bind_param("i", $recipe_data['recipe_name']);
            $stmt->execute();
            $ingredients_result = $stmt->get_result();
            $ingredients_data = $ingredients_result->fetch_assoc();
            $stmt->close();
            
            if ($ingredients_data && $ingredients_data['ingredients_json']) {
                $ingredients = json_decode($ingredients_data['ingredients_json'], true);
                
                foreach ($ingredients as $ingredient) {
                    $ingredient_name = $ingredient['name'];
                    $ingredient_quantity_needed = $ingredient['quantity'] * $quantity; // Multiply by product quantity
                    $ingredient_unit = $ingredient['unit'];
                    
                    // Check stock availability for this ingredient
                    $stmt = $conn->prepare("SELECT id, stock_quantity FROM stock WHERE product_name = ?");
                    $stmt->bind_param("s", $ingredient_name);
                    $stmt->execute();
                    $stock_result = $stmt->get_result();
                    $stock_data = $stock_result->fetch_assoc();
                    $stmt->close();
                    
                    if (!$stock_data) {
                        $insufficient_ingredients[] = "$ingredient_name (Not in stock)";
                    } elseif ($stock_data['stock_quantity'] < $ingredient_quantity_needed) {
                        $insufficient_ingredients[] = "$ingredient_name (Available: {$stock_data['stock_quantity']} $ingredient_unit, Needed: $ingredient_quantity_needed $ingredient_unit)";
                    }
                }
            }
        }
        
        if (!empty($insufficient_ingredients)) {
            $error_message = "❌ INGREDIENT STOCK INSUFFICIENT\n\nProduct: $product_name\n\nMissing/Insufficient Ingredients:\n";
            foreach ($insufficient_ingredients as $ingredient_error) {
                $error_message .= "• " . $ingredient_error . "\n";
            }
            $error_message .= "\nPlease restock the missing ingredients before making this product.";
            addNotification("Ingredient Stock Insufficient", "Product '$product_name' has insufficient ingredients", 'error');
            echo json_encode(['success' => false, 'message' => $error_message, 'type' => 'ingredient_stock']);
            exit;
        }
        
        // All checks passed
        echo json_encode(['success' => true, 'message' => 'Product can be added to cart']);
        
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error checking inventory: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?> 