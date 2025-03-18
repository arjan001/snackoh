<?php
include_once "./config/config.php";

// Fetch products with category
$productsQuery = "SELECT p.id, p.product_name, c.id as category_id, c.category_name 
                  FROM products p
                  LEFT JOIN product_category c ON p.product_category = c.id";
$productsResult = $conn->query($productsQuery);

// Fetch recipes
$recipesQuery = "SELECT id, recipe_name FROM recipes";
$recipesResult = $conn->query($recipesQuery);

$data = [
    'products' => $productsResult->fetch_all(MYSQLI_ASSOC),
    'recipes' => $recipesResult->fetch_all(MYSQLI_ASSOC)
];

echo json_encode($data);
?>
