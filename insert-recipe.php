<?php
include_once "./config/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipe_name = $_POST["recipe_name"];
    $upper_temp = $_POST["upper_temp"];
    $lower_temp = $_POST["lower_temp"];
    $recipe_instructions = $_POST["recipe_instructions"];

    // Insert recipe first
    $sql = "INSERT INTO recipes (recipe_name, upper_temperature, lower_temperature, recipe_instructions) 
            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdds", $recipe_name, $upper_temp, $lower_temp, $recipe_instructions);
    $stmt->execute();
    $recipe_id = $stmt->insert_id; // Get last inserted recipe ID

    // Check if ingredients are set
    if (isset($_POST["ingredient_name"])) {
        $ingredient_names = $_POST["ingredient_name"];
        $ingredient_quantities = $_POST["ingredient_quantity"];
        $ingredient_units = $_POST["ingredient_unit"];

        // Insert each ingredient linked to the recipe
        $sql = "INSERT INTO recipe_ingredients (recipe_id, ingredient_name, quantity, unit) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        for ($i = 0; $i < count($ingredient_names); $i++) {
            if (!empty($ingredient_names[$i]) && !empty($ingredient_quantities[$i])) {
                $stmt->bind_param("isds", $recipe_id, $ingredient_names[$i], $ingredient_quantities[$i], $ingredient_units[$i]);
                $stmt->execute();
            }
        }
    }

    echo "Recipe and ingredients added successfully!";
}
?>
