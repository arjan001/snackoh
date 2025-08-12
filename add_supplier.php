<?php
// Include database connection
include_once './config/config.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate the inputs
    $supplier_name = $conn->real_escape_string($_POST['supplier_name']);
    $contact_person_name = $conn->real_escape_string($_POST['contact_person_name']);
    $phone_no = $conn->real_escape_string($_POST['phone_no']);
    $email_address = $conn->real_escape_string($_POST['email_address']);
    $supplier_category = $conn->real_escape_string($_POST['supplier_category']);
    $physical_address = $conn->real_escape_string($_POST['physical_address']);
    $payment_terms = $conn->real_escape_string($_POST['payment_terms']);
    $tax_information = $conn->real_escape_string($_POST['tax_information']);
    $bank_details = $conn->real_escape_string($_POST['bank_details']);
    $status = isset($_POST['status']) ? 'active' : 'inactive'; // Checkbox for status

    // SQL query to insert data into suppliers table
    $sql = "INSERT INTO suppliers (supplier_name, contact_person_name, phone_no, email_address, supplier_category, physical_address, payment_terms, tax_information, bank_details, status) 
            VALUES ('$supplier_name', '$contact_person_name', '$phone_no', '$email_address', '$supplier_category', '$physical_address', '$payment_terms', '$tax_information', '$bank_details', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Supplier added successfully'); window.location.href='suppliers.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
