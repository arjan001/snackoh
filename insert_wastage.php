<?php
include_once "./config/config.php"; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $batch_id = $conn->real_escape_string($_POST['batch_id']);
    $wastage_type = $conn->real_escape_string($_POST['wastage_type']);
    $quantity_wasted = $conn->real_escape_string($_POST['quantity_wasted']);
    $reason = $conn->real_escape_string($_POST['reason']);

    $sql = "INSERT INTO production_wastage (batch_id, wastage_type, quantity_wasted, reason) 
            VALUES ('$batch_id', '$wastage_type', '$quantity_wasted', '$reason')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Waste reported successfully');
                window.location.href = './waste_manage.php'; // Change to your actual page
              </script>";
    } else {
        echo "<script>
                alert('Error: " . addslashes($conn->error) . "');
                window.location.href = './waste_manage.php'; // Change to your actual page
              </script>";
    }
}

$conn->close();
?>
