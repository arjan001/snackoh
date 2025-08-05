<?php
require_once 'config/config.php'; // Ensure database connection is included

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $contact_number = trim($_POST['contact_number']);
    $emp_code = trim($_POST['emp_code']);
    $dob = trim($_POST['dob']);
    $gender = trim($_POST['gender']);
    $nationality = trim($_POST['nationality']);
    $joining_date = trim($_POST['joining_date']);
    $department_id = trim($_POST['department_id']);
    $designation_id = trim($_POST['designation_id']);
    $blood_group = trim($_POST['blood_group']);
    $emergency_no_1 = trim($_POST['emergency_no_1']);
    $emergency_no_2 = trim($_POST['emergency_no_2']);
    $kra_pin = trim($_POST['kra_pin']);
    $address = trim($_POST['address']);
    $country = trim($_POST['country']);
    $physical_address = trim($_POST['physical_address']);
    $city = trim($_POST['city']);
    $zipcode = trim($_POST['zipcode']);
    // $password = $_POST['password_hash'];
    // $confirm_password = $_POST['confirm_password'];

    // Validate required fields
    $required_fields = [
        'first_name', 'last_name', 'email', 'contact_number', 'emp_code', 'dob', 'gender',
        'nationality', 'joining_date', 'department_id', 'designation_id', 'blood_group',
        'emergency_no_1', 'emergency_no_2', 'kra_pin', 'address', 'country', 'physical_address',
        'city', 'zipcode'
    ];
    
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            die("Error: All fields are required.");
        }
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Error: Invalid email format.");
    }

    // Validate password confirmation
    // if ($password !== $confirm_password) {
    //     die("Error: Passwords do not match.");
    // }

    // Hash password
    // $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Secure file uploads handling
    function uploadFile($fileInputName, $uploadDir)
    {
        if (!isset($_FILES[$fileInputName]) || $_FILES[$fileInputName]['error'] != 0) {
            die("Error: File upload failed for " . $fileInputName);
        }

        $file = $_FILES[$fileInputName];
        $fileName = basename($file['name']);
        $fileSize = $file['size'];
        $fileTmpName = $file['tmp_name'];
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        // Validate file size (5MB max)
        if ($fileSize > 5 * 1024 * 1024) {
            die("Error: File size too large. Maximum 5MB allowed.");
        }
        
        // Validate file type
        $allowedTypes = ['jpg', 'jpeg', 'png', 'pdf'];
        if (!in_array($fileType, $allowedTypes)) {
            die("Error: Invalid file type. Only JPG, PNG, and PDF files are allowed.");
        }
        
        // Generate unique filename to prevent overwrites
        $uniqueFileName = uniqid() . '_' . $fileName;
        $targetPath = $uploadDir . $uniqueFileName;
        
        // Ensure upload directory exists and is writable
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        if (move_uploaded_file($fileTmpName, $targetPath)) {
            return $targetPath;
        } else {
            die("Error: Failed to upload file " . $fileInputName);
        }
    }

    $profile_photo = uploadFile('profile_photo', 'uploads/');
    $national_id = uploadFile('national_id', 'uploads/');
    $employee_status = isset($_POST['employee_status']) ? 1 : 0; // Checkbox checked = 1, unchecked = 0
    // Insert into database
    $stmt = $conn->prepare("INSERT INTO employees 
        (first_name, last_name, email, contact_number, emp_code, dob, gender, nationality, 
        joining_date, department_id, designation_id, blood_group, emergency_no_1, 
        emergency_no_2, kra_pin, address, country, physical_address, city, zipcode,profile_photo, national_id,employee_status) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param(
    "sssssssssssssssssssssss",
    $first_name,
    $last_name,
    $email,
    $contact_number,
    $emp_code,
    $dob,
    $gender,
    $nationality,
    $joining_date,
    $department_id,
    $designation_id,
    $blood_group,
    $emergency_no_1,
    $emergency_no_2,
    $kra_pin,
    $address,
    $country,
    $physical_address,
    $city,
    $zipcode,
    // $hashed_password,  // ✅ Use hashed password instead of plain text
    $profile_photo,
    $national_id,
    $employee_status
);


    if ($stmt->execute()) {
        echo "<script>alert('employee added successfully'); window.location.href='./employees.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
