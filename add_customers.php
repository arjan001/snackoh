<?php
// Include the database connection
include('config/config.php'); // Include the correct path if necessary

// Check if we're editing an existing customer
$customer_id = isset($_GET['id']) ? $_GET['id'] : null;

// Initialize variables
$customer_name = $email = $phone = $physical_address = $town = $segment = $city = $gender = $payment_terms = $latitude = $longitude = '';

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate the input data
    $customer_name = htmlspecialchars(trim($_POST['customer_name']));
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $phone = htmlspecialchars(trim($_POST['phone']));
    $physical_address = htmlspecialchars(trim($_POST['physical_address']));
    $town = htmlspecialchars(trim($_POST['town']));
    $segment = htmlspecialchars(trim($_POST['segment'])); // Handle segment correctly
    $city = htmlspecialchars(trim($_POST['city']));
    $gender = htmlspecialchars(trim($_POST['gender'])); // Handle gender correctly
    $payment_terms = htmlspecialchars(trim($_POST['payment_terms'])); // Handle payment terms correctly
    $latitude = htmlspecialchars(trim($_POST['latitude']));
    $longitude = htmlspecialchars(trim($_POST['longitude']));

    // Validate required fields
    if (!$email) {
        die('Invalid email format.');
    }

    if (empty($segment) || !in_array($segment, ['Retailer', 'Wholesaler', 'Consumer','Distributor,'])) {
        die('Invalid segment.');
    }

    if (empty($gender) || !in_array($gender, ['Male', 'Female'])) {
        die('Invalid gender.');
    }

    if (empty($payment_terms) || !in_array($payment_terms, ['Cash', 'Credit'])) {
        die('Invalid payment terms.');
    }

    // Check if email already exists in the database (for add/edit)
    $check_email_query = "SELECT * FROM customers WHERE email = ? AND id != ?";
    if ($stmt = $conn->prepare($check_email_query)) {
        // Bind parameters to the query
        $stmt->bind_param("si", $email, $customer_id);

        // Execute the query
        $stmt->execute();
        $stmt->store_result();

        // If email already exists, show error message
        if ($stmt->num_rows > 0) {
            echo "<script>alert('Email already exists'); window.location.href='./customers.php';</script>";
            exit;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing the email check query.";
        exit;
    }

    // If we're editing, update the customer; otherwise, insert a new customer
    if ($customer_id) {
        // Prepare the SQL query to update customer data
        $sql = "UPDATE customers SET customer_name = ?, email = ?, phone = ?, physical_address = ?, town = ?, segment = ?, city = ?, gender = ?, payment_terms = ?WHERE id = ?";

        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters to the query
            $stmt->bind_param("sssssssssssi", $customer_name, $email, $phone, $physical_address, $town, $segment, $city, $gender, $payment_terms, $customer_id);

            // Execute the query
            if ($stmt->execute()) {
                // Success message and redirect
                echo "<script>alert('Customer updated successfully'); window.location.href='./customers.php';</script>";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close statement
            $stmt->close();
        } else {
            echo "Error preparing the update query.";
        }
    } else {
        // Prepare the SQL query to insert data into the database
        $sql = "INSERT INTO customers (customer_name, email, phone, physical_address, town, segment, city, gender, payment_terms, latitude, longitude)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters to the query
            $stmt->bind_param("sssssssssss", $customer_name, $email, $phone, $physical_address, $town, $segment, $city, $gender, $payment_terms, $latitude, $longitude);

            // Execute the query
            if ($stmt->execute()) {
                // Success message and redirect
                echo "<script>alert('Customer added successfully'); window.location.href='./customers.php';</script>";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close statement
            $stmt->close();
        } else {
            echo "Error preparing the insert query.";
        }
    }

    // Close the database connection
    $conn->close();
}

// If we're editing, fetch the existing customer data
if ($customer_id) {
    $sql = "SELECT * FROM customers WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $customer_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Populate fields with existing data
            $customer_name = $row['customer_name'];
            $email = $row['email'];
            $phone = $row['phone'];
            $physical_address = $row['physical_address'];
            $town = $row['town'];
            $segment = $row['segment'];
            $city = $row['city'];
            $gender = $row['gender'];
            $payment_terms = $row['payment_terms'];
            $latitude = $row['latitude'];
            $longitude = $row['longitude'];
        }
        $stmt->close();
    }
}
?>
