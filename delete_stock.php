<?php
include_once "config/config.php";

if (isset($_GET['id'])) {
    $stock_id = $_GET['id'];

    $sql = "DELETE FROM stock WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $stock_id);

    if ($stmt->execute()) {
        echo "<script>alert('Stock deleted successfully'); window.location.href='manage-stocks.php';</script>";
    } else {
        echo "<script>alert('Error deleting stock'); history.back();</script>";
    }

    $stmt->close();
}
$conn->close();
?>
