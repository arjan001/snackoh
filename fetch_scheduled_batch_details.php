
<?php
include_once "./config/config.php";

if (isset($_POST['batch_id'])) {
    $batch_id = $_POST['batch_id'];
    $sql = "SELECT * FROM production_batches WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $batch_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $batch = $result->fetch_assoc();

    echo json_encode($batch);
}
?>
