<?php
include_once "./config/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $employeeId = mysqli_real_escape_string($conn, $_POST['id']);

    $query = "DELETE FROM employees WHERE id = '$employeeId'";
    
    if (mysqli_query($conn, $query)) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
