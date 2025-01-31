<?php
 include_once "./config/config.php";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $conn->real_escape_string($_POST['recipe_name']);
    $Recipe_ingridients = $conn->real_escape_string($_POST['product_category']);
    $recipe_instructions= $conn->real_escape_string($_POST['recipe_instructions']);
    
   
    

    // Insert query
    $sql = "INSERT INTO recipe (recipe_name, product_category, product_unit, product_quantity ,product_price,product_quantity_alert,manufactured_on) 
            VALUES ('$product_name', '$product_category', $product_unit, '$product_quantity', '$product_price' ,'$product_quantity_alert','$manufactured_on')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Unit added successfully'); window.location.href='./product-list.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>
