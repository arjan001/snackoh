<?php
// Database Connection
include './config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $transaction_id = $_POST['transaction_id'];
    $customer_id = $_POST['customer_id'];
    $employee_id = $_POST['employee_id'];
    $total_price = $_POST['total_price'];
    $payment_type = isset($_POST['payment_type']) ? $_POST['payment_type'] : 'cash'; // ✅ Define payment type
    $carts = json_decode($_POST['cart'], true); // Decode JSON string

    if (!$carts || count($carts) == 0) {
        echo json_encode(["status" => "error", "message" => "No products found in the order."]);
        exit;
    }

    $conn->begin_transaction();

    try {
        $payment_status = 'completed';

        // ✅ Insert order into orders table
        $stmt = $conn->prepare("INSERT INTO orders (transaction_id, customer_id, employee_id, total_price, payment_status, payment_type) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("siidss", $transaction_id, $customer_id, $employee_id, $total_price, $payment_status, $payment_type);
        $stmt->execute();
        $order_id = $stmt->insert_id;
        $stmt->close();

        // ✅ Insert each product into order_items table
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_name, price, quantity, image) VALUES (?, ?, ?, ?, ?)");
        foreach ($carts as $cart) {
            $stmt->bind_param("isdis", $order_id, $cart['name'], $cart['price'], $cart['quantity'], $cart['image']);
            $stmt->execute();
        }
        $stmt->close();

        // ✅ Commit transaction
        $conn->commit();

        echo "<script>alert('Order Saved successfully'); window.location.href='./pos.php';</script>";
    } catch (Exception $e) {
        $conn->rollback(); // Rollback transaction on error
        echo "<script>alert('Failed to save orderss: " . $e->getMessage() . "'); window.location.href='./pos.php';</script>";
    }
}
?>
