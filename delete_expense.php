<?php
include './config/config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "DELETE FROM expenses WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        header("Location: expense-list.php"); // Redirect after delete
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>
