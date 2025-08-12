<?php
include "config/config.php"; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_POST['employee_id']; // Ensure this is set
    $user_role = $_POST['user_role'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (!empty($password) && $password !== $confirm_password) {
        die("Passwords do not match.");
    }

    // Check if password update is needed
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE employees SET user_role = ?, password_hash = ? WHERE id = ?");
        $stmt->bind_param("isi", $user_role, $hashed_password, $employee_id);
    } else {
        $stmt = $conn->prepare("UPDATE employees SET user_role = ? WHERE id = ?");
        $stmt->bind_param("ii", $user_role, $employee_id);
    }


        if ($stmt->execute()) {
            echo "<script>alert('User Role updated successfully'); window.location.href='./users.php';</script>";
            exit;
        }
    } else {
        echo json_encode(["status" => "error", "message" => $stmt->error]);
    }

    $stmt->close();

?>
