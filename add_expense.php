<?php
include_once "./config/config.php";

$expense_id = isset($_GET['expense_id']) ? $conn->real_escape_string($_GET['expense_id']) : null;

$category_name = "";
$reference = "";
$date = "";
$amount = "";
$description = "";

// Fetch existing expense details if editing
if ($expense_id) {
    $sql = "SELECT * FROM expenses WHERE id='$expense_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $category_name = $row['category_name'];
        $reference = $row['reference'];
        $date = $row['date'];
        $amount = $row['amount'];
        $description = $row['description'];
    }
}

// Handle form submission (both Add & Edit)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $expense_id = isset($_POST['expense_id']) ? $conn->real_escape_string($_POST['expense_id']) : null;
    $category_name = $conn->real_escape_string($_POST['category_name']);
    $reference = $conn->real_escape_string($_POST['reference']);
    $date = $conn->real_escape_string($_POST['date']);
    $amount = $conn->real_escape_string($_POST['amount']);
    $description = $conn->real_escape_string($_POST['description']);

    if ($expense_id) {
        // Update existing expense
        $sql = "UPDATE expenses 
                SET category_name='$category_name', reference='$reference', date='$date', amount='$amount', description='$description' 
                WHERE id='$expense_id'";
    } else {
        // Insert new expense
        $sql = "INSERT INTO expenses (category_name, reference, date, amount, description) 
                VALUES ('$category_name', '$reference', '$date', '$amount', '$description')";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Expense saved successfully'); window.location.href='./expense-list.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
