<?php
       include('config/config.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure ID is an integer to prevent SQL injection

    // Prepare the DELETE query
    $query = "DELETE FROM capacity_management WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Record deleted successfully'); window.location.href='./capacity-manage.php';</script>";
    } else {
        echo "<script>alert('Error deleting record'); window.location.href='./capacity-manage.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Invalid request'); window.location.href='./capacity-manage.php';</script>";
}
?>
