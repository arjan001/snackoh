<?php
 include_once "./config/config.php";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $designation_name = $conn->real_escape_string($_POST['designation_name']);

    $status = isset($_POST['status']) ? 'active' : 'inactive';

    // Insert query
    $sql = "INSERT INTO designation (designation_name, status) 
            VALUES ('$designation_name','$status')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Designation added successfully'); window.location.href='./designation.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>
