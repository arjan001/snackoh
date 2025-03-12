<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === "add") {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = floatval($_POST['price']);

        // Check if item already in cart
        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $id) {
                $item['quantity'] += 1;
                $found = true;
                break;
            }
        }

        // If not found, add new item
        if (!$found) {
            $_SESSION['cart'][] = [
                "id" => $id,
                "name" => $name,
                "price" => $price,
                "quantity" => 1
            ];
        }

    } elseif ($action === "increase") {
        $index = $_POST['index'];
        $_SESSION['cart'][$index]['quantity'] += 1;

    } elseif ($action === "decrease") {
        $index = $_POST['index'];
        if ($_SESSION['cart'][$index]['quantity'] > 1) {
            $_SESSION['cart'][$index]['quantity'] -= 1;
        } else {
            unset($_SESSION['cart'][$index]);
            $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index array
        }

    } elseif ($action === "remove") {
        $index = $_POST['index'];
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index array
    }

    echo json_encode(["status" => "success", "cart" => $_SESSION['cart']]);
    exit;
}
