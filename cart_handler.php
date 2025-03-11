<?php
session_start();

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    if ($action == "add") {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $image = $_POST['image'];

        // Check if item already exists in cart
        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $id) {
                $item['quantity'] += 1;
                $found = true;
                break;
            }
        }
        if (!$found) {
            $_SESSION['cart'][] = ["id" => $id, "name" => $name, "price" => $price, "image" => $image, "quantity" => 1];
        }
    } elseif ($action == "increase") {
        $index = $_POST['index'];
        $_SESSION['cart'][$index]['quantity'] += 1;
    } elseif ($action == "decrease") {
        $index = $_POST['index'];
        if ($_SESSION['cart'][$index]['quantity'] > 1) {
            $_SESSION['cart'][$index]['quantity'] -= 1;
        }
    } elseif ($action == "remove") {
        $index = $_POST['index'];
        array_splice($_SESSION['cart'], $index, 1);
    }

    echo json_encode(["status" => "success", "cart" => $_SESSION['cart']]);
}
?>
