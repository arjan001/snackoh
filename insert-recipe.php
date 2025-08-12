<?php
include_once "./config/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Start a transaction
    $conn->begin_transaction();

    try {
        $recipe_name = $_POST["recipe_name"] ?? '';
        $upper_temp = $_POST["upper_temp"] ?? 0;
        $lower_temp = $_POST["lower_temp"] ?? 0;
        $recipe_instructions = $_POST["recipe_instructions"] ?? '';

        // Insert recipe
        $sql = "INSERT INTO recipes (recipe_name, upper_temperature, lower_temperature, recipe_instructions) 
                VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdds", $recipe_name, $upper_temp, $lower_temp, $recipe_instructions);
        $stmt->execute();

        if ($stmt->affected_rows < 1) {
            throw new Exception("Failed to insert recipe.");
        }

        $recipe_id = $stmt->insert_id; // Get last inserted recipe ID

        // Debugging: Check if ingredients are being sent
        error_log(print_r($_POST["ingredient_name"], true));

        // Check if ingredients are set and not empty
        if (!empty($_POST["ingredient_name"])) {
            $ingredient_names = $_POST["ingredient_name"];
            $ingredient_quantities = $_POST["ingredient_quantity"];
            $ingredient_units = $_POST["ingredient_unit"];

            // Prepare an array for storing ingredients
            $ingredients = [];
            for ($i = 0; $i < count($ingredient_names); $i++) {
                if (!empty($ingredient_names[$i]) && !empty($ingredient_quantities[$i])) {
                    $ingredients[] = [
                        "name" => $ingredient_names[$i],
                        "quantity" => $ingredient_quantities[$i],
                        "unit" => $ingredient_units[$i]
                    ];
                }
            }

            // Convert to JSON string
            $ingredients_json = json_encode($ingredients);

            // Insert into recipe_ingredients with JSON storage
            $sql = "INSERT INTO recipe_ingredients (recipe_id, ingredients_json) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $recipe_id, $ingredients_json);
            $stmt->execute();

            if ($stmt->affected_rows < 1) {
                throw new Exception("Failed to insert ingredients.");
            }
        }

        // Commit the transaction
        $conn->commit();

        // Clear localStorage after success
        echo "<script>
                localStorage.clear();
                alert('Recipe and ingredients added successfully!');
                window.location.href = 'recipe.php?status=success';
              </script>";
        exit();

    } catch (Exception $e) {
        // Rollback the transaction on failure
        $conn->rollback();

        // Debugging: Log error
        error_log("Error: " . $e->getMessage());

        // Redirect with error message
        echo "<script>
                alert('Error: " . addslashes($e->getMessage()) . "');
                window.location.href = 'recipe.php?status=error';
              </script>";
        exit();
    }
}
?>
