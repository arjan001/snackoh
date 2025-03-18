<?php
include_once "./config/config.php";

if (isset($_POST['batch_id'])) {
    $batch_id = $_POST['batch_id'];
    $sql = "DELETE FROM production_batches WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $batch_id);

    if ($stmt->execute()) {
        echo "Batch deleted successfully.";
    } else {
        echo "Error deleting batch.";
    }
}
?>
