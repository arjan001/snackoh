<?php
include_once "./config/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $department_name = $conn->real_escape_string($_POST['department_name']);
    $status = isset($_POST['status']) ? 'active' : 'inactive'; // Ensures active/inactive

    // Insert query
    $sql = "INSERT INTO departments (department_name, status) 
            VALUES ('$department_name', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Department added successfully'); window.location.href='./department.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>
