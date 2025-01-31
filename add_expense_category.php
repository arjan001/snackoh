<?php
include_once "./config/config.php";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $expense_name = $conn->real_escape_string($_POST['expense_name']);
    $expense_description = $conn->real_escape_string($_POST['expense_description']);

    // Insert query
    $sql = "INSERT INTO expense_category (expense_name, expense_description) 
            VALUES ('$expense_name', '$expense_description')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Expense category added successfully'); window.location.href='./expense-category.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>
