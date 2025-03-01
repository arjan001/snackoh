<?php
include_once "./config/config.php";

// Handle AJAX request for fetching products
if (isset($_GET['category'])) {
    $category = $_GET['category'];

    // If category is 'all', fetch all products; otherwise, fetch products for the selected category
    if ($category === 'all') {
        $sql = "SELECT * FROM products";
    } else {
        $sql = "SELECT * FROM products WHERE product_category = '$category'";
    }

    $result = $conn->query($sql);
    $products = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;  // Add product to array
        }
    }

    // Close connection
    $conn->close();

    // Return the products as JSON
    echo json_encode($products);
    exit;
}

// Handle form submission for inserting product
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form inputs
    if (empty($_POST['product_name']) || empty($_POST['product_category']) || empty($_POST['recipe_name']) || empty($_POST['product_unit']) || empty($_POST['product_quantity']) || empty($_POST['product_price']) || empty($_POST['product_quantity_alert']) || empty($_POST['product_manufactured_date'])) {
        echo "All fields are required!";
        exit;
    }

    // Sanitize inputs to prevent SQL injection
    $product_name = $conn->real_escape_string($_POST['product_name']);
    $product_category = $conn->real_escape_string($_POST['product_category']);
    $recipe_name = $conn->real_escape_string($_POST['recipe_name']);
    $product_unit = $conn->real_escape_string($_POST['product_unit']);
    $product_quantity = $conn->real_escape_string($_POST['product_quantity']);
    $product_price = $conn->real_escape_string($_POST['product_price']);
    $product_quantity_alert = $conn->real_escape_string($_POST['product_quantity_alert']);
    $manufactured_on = isset($_POST['manufactured_on']) ? $_POST['manufactured_on'] : date('Y-m-d H:i:s'); // default to current date if not provided


    // Initialize the image path variable
    $image_path = null;

    // Handle file upload
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
        $image_name = $_FILES['product_image']['name'];
        $image_tmp_name = $_FILES['product_image']['tmp_name'];
        $image_size = $_FILES['product_image']['size'];
        $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

        // Validate file type (e.g., jpg, jpeg, png)
        $allowed_exts = ['jpg', 'jpeg', 'png'];
        if (in_array($image_ext, $allowed_exts)) {
            // Generate a unique file name to avoid overwriting
            $image_new_name = uniqid() . '.' . $image_ext;

            // Specify the directory where the image will be stored
            $image_path = "uploads/" . $image_new_name;

            // Move the file to the "uploads" directory
            if (!move_uploaded_file($image_tmp_name, $image_path)) {
                echo "Error uploading the image.";
                exit;
            }
        } else {
            echo "Invalid image type. Only JPG, JPEG, and PNG files are allowed.";
            exit;
        }
    }

    // Prepare the SQL query
    if ($image_path) {
        // Insert query with image path
        $sql = "INSERT INTO products (product_name, product_category, recipe_name, product_unit, product_quantity, product_price, product_quantity_alert, manufactured_on, product_image) 
                VALUES ('$product_name', '$product_category',  $recipe_name, '$product_unit', '$product_quantity', '$product_price', '$product_quantity_alert', '$manufactured_on', '$image_path')";
    } else {
        // If no image is uploaded, insert data without image
        $sql = "INSERT INTO products (product_name, product_category, recipe_name, product_unit, product_quantity, product_price, product_quantity_alert, manufactured_on) 
                VALUES ('$product_name', '$product_category',  $recipe_name, '$product_unit', '$product_quantity', '$product_price', '$product_quantity_alert', '$manufactured_on')";
    }

    // Debugging output: check SQL query before execution
    // echo "SQL Query: $sql<br>";

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Product added successfully'); window.location.href='./product-list.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>
