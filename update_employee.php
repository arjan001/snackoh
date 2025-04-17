<?php
require_once 'config/config.php'; // Database connection

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee_id = intval($_POST['employee_id']);
    
    // Sanitize inputs
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $contact_number = $conn->real_escape_string($_POST['contact_number']);
    $emp_code = $conn->real_escape_string($_POST['emp_code']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $nationality = $conn->real_escape_string($_POST['nationality']);
    $joining_date = $conn->real_escape_string($_POST['joining_date']);
    $department_id = intval($_POST['department_id']);
    $designation_id = intval($_POST['designation_id']);
    $blood_group = $conn->real_escape_string($_POST['blood_group']);
    $emergency_no_1 = $conn->real_escape_string($_POST['emergency_no_1']);
    $emergency_no_2 = $conn->real_escape_string($_POST['emergency_no_2']);
    $kra_pin = $conn->real_escape_string($_POST['kra_pin']);
    $address = $conn->real_escape_string($_POST['address']);
    $country = $conn->real_escape_string($_POST['country']);
    $physical_address = $conn->real_escape_string($_POST['physical_address']);
    $city = $conn->real_escape_string($_POST['city']);
    $zipcode = $conn->real_escape_string($_POST['zipcode']);
    $status = $conn->real_escape_string($_POST['employee_status']);

    // Handle file uploads
    $profile_photo = '';
    $national_id = '';
    
    if (!empty($_FILES['profile_photo']['name'])) {
        $profile_photo = 'uploads/' . basename($_FILES['profile_photo']['name']);
        move_uploaded_file($_FILES['profile_photo']['tmp_name'], $profile_photo);
    }
    
    if (!empty($_FILES['national_id']['name'])) {
        $national_id = 'uploads/' . basename($_FILES['national_id']['name']);
        move_uploaded_file($_FILES['national_id']['tmp_name'], $national_id);
    }

    // Update employee data
    $update_query = "UPDATE employees SET
        first_name = '$first_name',
        last_name = '$last_name',
        email = '$email',
        contact_number = '$contact_number',
        emp_code = '$emp_code',
        dob = '$dob',
        gender = '$gender',
        nationality = '$nationality',
        joining_date = '$joining_date',
        department_id = $department_id,
        designation_id = $designation_id,
        blood_group = '$blood_group',
        emergency_no_1 = '$emergency_no_1',
        emergency_no_2 = '$emergency_no_2',
        kra_pin = '$kra_pin',
        address = '$address',
        country = '$country',
        physical_address = '$physical_address',
        city = '$city',
        zipcode = '$zipcode'
        employee_status = '$status'";

    // Append file uploads if available
    if ($profile_photo !== '') {
        $update_query .= ", profile_photo = '$profile_photo'";
    }
    if ($national_id !== '') {
        $update_query .= ", national_id = '$national_id'";
    }
    
    $update_query .= " WHERE id = $employee_id";
    
    if ($conn->query($update_query)) {
        header("Location: employees.php?update=success"); // Redirect after update
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Invalid request!";
}
