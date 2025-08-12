<?php
// Database Connection
include './config/config.php';

echo "<h2>🔍 Missing Ingredients Checker</h2>";

// Get all products with recipes
$query = "
    SELECT 
        p.product_name,
        p.recipe_name,
        r.recipe_name as recipe_name_text
    FROM products p 
    LEFT JOIN recipes r ON p.recipe_name = r.id 
    WHERE p.recipe_name IS NOT NULL
";

$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    echo "<h3>📋 Products with Recipes:</h3>";
    
    while ($row = $result->fetch_assoc()) {
        $product_name = $row['product_name'];
        $recipe_id = $row['recipe_name'];
        $recipe_name = $row['recipe_name_text'];
        
        echo "<div style='border: 1px solid #ddd; padding: 15px; margin: 10px 0; border-radius: 5px;'>";
        echo "<h4>🍞 Product: " . htmlspecialchars($product_name) . "</h4>";
        echo "<p><strong>Recipe:</strong> " . htmlspecialchars($recipe_name) . "</p>";
        
        // Get ingredients for this recipe
        $stmt = $conn->prepare("SELECT ingredients_json FROM recipe_ingredients WHERE recipe_id = ?");
        $stmt->bind_param("i", $recipe_id);
        $stmt->execute();
        $ingredients_result = $stmt->get_result();
        $ingredients_data = $ingredients_result->fetch_assoc();
        $stmt->close();
        
        if ($ingredients_data && $ingredients_data['ingredients_json']) {
            $ingredients = json_decode($ingredients_data['ingredients_json'], true);
            
            echo "<h5>📦 Required Ingredients:</h5>";
            echo "<ul>";
            
            $missing_ingredients = [];
            $available_ingredients = [];
            
            foreach ($ingredients as $ingredient) {
                $ingredient_name = $ingredient['name'];
                $ingredient_quantity = $ingredient['quantity'];
                $ingredient_unit = $ingredient['unit'];
                
                // Check if ingredient exists in stock
                $stmt = $conn->prepare("SELECT stock_quantity FROM stock WHERE product_name = ?");
                $stmt->bind_param("s", $ingredient_name);
                $stmt->execute();
                $stock_result = $stmt->get_result();
                $stock_data = $stock_result->fetch_assoc();
                $stmt->close();
                
                if ($stock_data) {
                    echo "<li style='color: green;'>✅ " . htmlspecialchars($ingredient_name) . " - " . $ingredient_quantity . " " . $ingredient_unit . " (Available: " . $stock_data['stock_quantity'] . ")</li>";
                    $available_ingredients[] = $ingredient_name;
                } else {
                    echo "<li style='color: red;'>❌ " . htmlspecialchars($ingredient_name) . " - " . $ingredient_quantity . " " . $ingredient_unit . " (NOT IN STOCK)</li>";
                    $missing_ingredients[] = $ingredient_name;
                }
            }
            
            echo "</ul>";
            
            if (!empty($missing_ingredients)) {
                echo "<div style='background: #fff3cd; border: 1px solid #ffeaa7; padding: 10px; border-radius: 5px; margin: 10px 0;'>";
                echo "<h5>⚠️ Missing Ingredients:</h5>";
                echo "<p>Add these ingredients to your stock:</p>";
                echo "<ul>";
                foreach ($missing_ingredients as $missing) {
                    echo "<li><strong>" . htmlspecialchars($missing) . "</strong></li>";
                }
                echo "</ul>";
                echo "<p><a href='manage-stocks.php' class='btn btn-primary'>Go to Manage Stock</a></p>";
                echo "</div>";
            } else {
                echo "<div style='background: #d4edda; border: 1px solid #c3e6cb; padding: 10px; border-radius: 5px; margin: 10px 0;'>";
                echo "<p style='color: #155724;'>✅ All ingredients are available in stock!</p>";
                echo "</div>";
            }
        } else {
            echo "<p style='color: orange;'>⚠️ No ingredients found for this recipe.</p>";
        }
        
        echo "</div>";
    }
} else {
    echo "<div style='background: #f8d7da; border: 1px solid #f5c6cb; padding: 15px; border-radius: 5px;'>";
    echo "<h3>📝 No Products with Recipes Found</h3>";
    echo "<p>To use the BOM system, you need to:</p>";
    echo "<ol>";
    echo "<li>Create recipes with ingredients</li>";
    echo "<li>Link products to recipes</li>";
    echo "<li>Add ingredients to stock</li>";
    echo "</ol>";
    echo "<p><a href='recipe.php' class='btn btn-primary'>Create Recipes</a> | <a href='add-product.php' class='btn btn-secondary'>Create Products</a></p>";
    echo "</div>";
}

// Show all available ingredients in stock
echo "<h3>📦 Available Ingredients in Stock:</h3>";
$stock_query = "SELECT product_name, stock_quantity, unit FROM stock ORDER BY product_name";
$stock_result = $conn->query($stock_query);

if ($stock_result && $stock_result->num_rows > 0) {
    echo "<table style='width: 100%; border-collapse: collapse; margin: 10px 0;'>";
    echo "<tr style='background: #f8f9fa;'><th style='border: 1px solid #ddd; padding: 8px;'>Ingredient</th><th style='border: 1px solid #ddd; padding: 8px;'>Quantity</th><th style='border: 1px solid #ddd; padding: 8px;'>Unit</th></tr>";
    
    while ($row = $stock_result->fetch_assoc()) {
        echo "<tr>";
        echo "<td style='border: 1px solid #ddd; padding: 8px;'>" . htmlspecialchars($row['product_name']) . "</td>";
        echo "<td style='border: 1px solid #ddd; padding: 8px;'>" . $row['stock_quantity'] . "</td>";
        echo "<td style='border: 1px solid #ddd; padding: 8px;'>" . htmlspecialchars($row['unit']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p style='color: orange;'>No ingredients found in stock.</p>";
    echo "<p><a href='manage-stocks.php' class='btn btn-primary'>Add Ingredients to Stock</a></p>";
}

echo "<hr>";
echo "<h3>🔧 Quick Fix Options:</h3>";
echo "<div style='display: flex; gap: 10px; margin: 20px 0;'>";
echo "<a href='manage-stocks.php' class='btn btn-primary'>Add Missing Ingredients</a>";
echo "<a href='recipe.php' class='btn btn-secondary'>Create/Edit Recipes</a>";
echo "<a href='add-product.php' class='btn btn-info'>Create Products</a>";
echo "<a href='pos.php' class='btn btn-success'>Go to POS</a>";
echo "</div>";

echo "<div style='background: #e7f3ff; border: 1px solid #b3d9ff; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
echo "<h4>💡 Solution for 'cocoa' Error:</h4>";
echo "<p>The error occurs because your product's recipe requires 'cocoa' but it's not in your stock.</p>";
echo "<p><strong>To fix this:</strong></p>";
echo "<ol>";
echo "<li>Go to <strong>Manage Stock</strong></li>";
echo "<li>Add 'cocoa' as a new ingredient</li>";
echo "<li>Set a quantity (e.g., 1000g)</li>";
echo "<li>Set the unit (e.g., g, kg, etc.)</li>";
echo "<li>Save the ingredient</li>";
echo "</ol>";
echo "<p>Or, if you don't need cocoa in your recipe, edit the recipe to remove it.</p>";
echo "</div>";
?> 