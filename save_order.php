<?php
// Database Connection
include './config/config.php';
include './includes/notifications.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input data
    $transaction_id = trim($_POST['transaction_id'] ?? '');
    $customer_id = intval($_POST['customer_id'] ?? 0);
    $employee_id = intval($_POST['employee_id'] ?? 0);
    $total_price = floatval($_POST['total_price'] ?? 0);
    $payment_type = isset($_POST['payment_type']) ? trim($_POST['payment_type']) : 'cash';
    $cart_data = $_POST['cart'] ?? '[]';
    $carts = json_decode($cart_data, true);
    
    // Validate required fields
    if (empty($transaction_id) || $employee_id <= 0 || $total_price <= 0) {
        echo "<script>
                alert('Invalid input data provided. Please ensure transaction ID, employee, and total price are valid.');
                window.location.href = './pos.php?status=error';
              </script>";
        exit;
    }
    
    // Handle customer_id for walk-in customers
    if (empty($customer_id) || $customer_id == '0' || $customer_id <= 0) {
        $customer_id = null; // Set to NULL for walk-in customers
    }
    
    // Validate payment type
    $allowed_payment_types = ['cash', 'mpesa', 'credit'];
    if (!in_array($payment_type, $allowed_payment_types)) {
        $payment_type = 'cash'; // Default to cash if invalid
    }

    if (!$carts || count($carts) == 0) {
        echo "<script>
                alert('No products found in the order.');
                window.location.href = './pos.php?status=error';
              </script>";
        exit;
    }

    $conn->begin_transaction();

    try {
        $payment_status = 'completed';
        
        // For credit sales, set payment status to pending
        if ($payment_type === 'credit') {
            $payment_status = 'pending';
        }

        // ✅ Check inventory availability and BOM requirements BEFORE processing
        $insufficient_stock = [];
        $insufficient_ingredients = [];
        
        foreach ($carts as $cart) {
            $product_name = $cart['name'];
            $quantity_needed = $cart['quantity'];
            
            // Check product stock availability
            $stmt = $conn->prepare("SELECT id, product_quantity FROM products WHERE product_name = ?");
            $stmt->bind_param("s", $product_name);
            $stmt->execute();
            $product_result = $stmt->get_result();
            $product_data = $product_result->fetch_assoc();
            $stmt->close();
            
            if ($product_data) {
                if ($product_data['product_quantity'] < $quantity_needed) {
                    $insufficient_stock[] = "$product_name (Available: {$product_data['product_quantity']}, Needed: $quantity_needed)";
                }
                
                // Check BOM ingredients availability
                $stmt = $conn->prepare("SELECT p.recipe_name, r.recipe_name as recipe_name_text 
                                       FROM products p 
                                       LEFT JOIN recipes r ON p.recipe_name = r.id 
                                       WHERE p.product_name = ?");
                $stmt->bind_param("s", $product_name);
                $stmt->execute();
                $recipe_result = $stmt->get_result();
                $recipe_data = $recipe_result->fetch_assoc();
                $stmt->close();
                
                if ($recipe_data && $recipe_data['recipe_name']) {
                    // Get recipe ingredients
                    $stmt = $conn->prepare("SELECT ingredients_json FROM recipe_ingredients WHERE recipe_id = ?");
                    $stmt->bind_param("i", $recipe_data['recipe_name']);
                    $stmt->execute();
                    $ingredients_result = $stmt->get_result();
                    $ingredients_data = $ingredients_result->fetch_assoc();
                    $stmt->close();
                    
                    if ($ingredients_data && $ingredients_data['ingredients_json']) {
                        $ingredients = json_decode($ingredients_data['ingredients_json'], true);
                        
                        foreach ($ingredients as $ingredient) {
                            $ingredient_name = $ingredient['name'];
                            $ingredient_quantity_needed = $ingredient['quantity'] * $quantity_needed; // Multiply by product quantity
                            $ingredient_unit = $ingredient['unit'];
                            
                            // Check stock availability for this ingredient
                            $stmt = $conn->prepare("SELECT id, stock_quantity FROM stock WHERE product_name = ?");
                            $stmt->bind_param("s", $ingredient_name);
                            $stmt->execute();
                            $stock_result = $stmt->get_result();
                            $stock_data = $stock_result->fetch_assoc();
                            $stmt->close();
                            
                            if (!$stock_data) {
                                $insufficient_ingredients[] = "$ingredient_name (Not in stock)";
                            } elseif ($stock_data['stock_quantity'] < $ingredient_quantity_needed) {
                                $insufficient_ingredients[] = "$ingredient_name (Available: {$stock_data['stock_quantity']} $ingredient_unit, Needed: $ingredient_quantity_needed $ingredient_unit)";
                            }
                        }
                    }
                }
            } else {
                $insufficient_stock[] = "$product_name (Product not found)";
            }
        }
        
        // If insufficient stock or ingredients, rollback and show error
        if (!empty($insufficient_stock) || !empty($insufficient_ingredients)) {
            $conn->rollback();
            
            // Build error message for display on POS page
            $error_details = [];
            if (!empty($insufficient_stock)) {
                $error_details[] = "Insufficient Product Stock:";
                foreach ($insufficient_stock as $stock_error) {
                    $error_details[] = "• " . $stock_error;
                }
            }
            if (!empty($insufficient_ingredients)) {
                $error_details[] = "Insufficient Ingredients:";
                foreach ($insufficient_ingredients as $ingredient_error) {
                    $error_details[] = "• " . $ingredient_error;
                }
            }
            
            // Add notification for inventory error
            $error_message = implode("\n", $error_details);
            addNotification(
                "Inventory Error - Order Cannot Be Processed",
                $error_message,
                'error'
            );
            
            // Redirect to POS with detailed error message
            $error_message = urlencode($error_message);
            header("Location: ./pos.php?status=inventory_error&message=" . $error_message);
            exit;
        }

        // ✅ Insert order into orders table
        if ($customer_id === null) {
            // For walk-in customers, don't include customer_id in the query
            $stmt = $conn->prepare("INSERT INTO orders (transaction_id, employee_id, total_price, payment_status, payment_type) 
                                    VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sidss", $transaction_id, $employee_id, $total_price, $payment_status, $payment_type);
        } else {
            // For registered customers, include customer_id
            $stmt = $conn->prepare("INSERT INTO orders (transaction_id, customer_id, employee_id, total_price, payment_status, payment_type) 
                                    VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("siidss", $transaction_id, $customer_id, $employee_id, $total_price, $payment_status, $payment_type);
        }
        $stmt->execute();
        $order_id = $stmt->insert_id;
        $stmt->close();

        // ✅ Insert each product into order_items table
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_name, price, quantity, image) 
                                VALUES (?, ?, ?, ?, ?)");
        foreach ($carts as $cart) {
            $stmt->bind_param("isdis", $order_id, $cart['name'], $cart['price'], $cart['quantity'], $cart['image']);
            $stmt->execute();
        }
        $stmt->close();

        // ✅ REDUCE PRODUCT INVENTORY AND CONSUME INGREDIENTS (BOM)
        foreach ($carts as $cart) {
            $product_name = $cart['name'];
            $quantity_sold = $cart['quantity'];
            
            // Reduce product stock
            $stmt = $conn->prepare("UPDATE products SET product_quantity = product_quantity - ? WHERE product_name = ?");
            $stmt->bind_param("is", $quantity_sold, $product_name);
            $stmt->execute();
            $stmt->close();
            
            // Get recipe and consume ingredients
            $stmt = $conn->prepare("SELECT p.recipe_name, r.recipe_name as recipe_name_text 
                                   FROM products p 
                                   LEFT JOIN recipes r ON p.recipe_name = r.id 
                                   WHERE p.product_name = ?");
            $stmt->bind_param("s", $product_name);
            $stmt->execute();
            $recipe_result = $stmt->get_result();
            $recipe_data = $recipe_result->fetch_assoc();
            $stmt->close();
            
            if ($recipe_data && $recipe_data['recipe_name']) {
                // Get recipe ingredients
                $stmt = $conn->prepare("SELECT ingredients_json FROM recipe_ingredients WHERE recipe_id = ?");
                $stmt->bind_param("i", $recipe_data['recipe_name']);
                $stmt->execute();
                $ingredients_result = $stmt->get_result();
                $ingredients_data = $ingredients_result->fetch_assoc();
                $stmt->close();
                
                if ($ingredients_data && $ingredients_data['ingredients_json']) {
                    $ingredients = json_decode($ingredients_data['ingredients_json'], true);
                    
                    foreach ($ingredients as $ingredient) {
                        $ingredient_name = $ingredient['name'];
                        $ingredient_quantity_consumed = $ingredient['quantity'] * $quantity_sold; // Multiply by product quantity
                        
                        // Reduce ingredient stock
                        $stmt = $conn->prepare("UPDATE stock SET stock_quantity = stock_quantity - ? WHERE product_name = ?");
                        $stmt->bind_param("is", $ingredient_quantity_consumed, $ingredient_name);
                        $stmt->execute();
                        $stmt->close();
                        
                        // Log ingredient consumption for tracking
                        $stmt = $conn->prepare("INSERT INTO ingredient_usage (product_name, ingredient_name, quantity_consumed, order_id, transaction_id, usage_date) 
                                               VALUES (?, ?, ?, ?, ?, NOW())");
                        $stmt->bind_param("ssdis", $product_name, $ingredient_name, $ingredient_quantity_consumed, $order_id, $transaction_id);
                        $stmt->execute();
                        $stmt->close();
                    }
                }
            }
        }

        // ✅ Handle credit sales - Add to debtors table
        if ($payment_type === 'credit' && $customer_id !== null) {
            // Get customer details
            $stmt = $conn->prepare("SELECT customer_name, email, phone FROM customers WHERE id = ?");
            $stmt->bind_param("i", $customer_id);
            $stmt->execute();
            $customer_result = $stmt->get_result();
            $customer_data = $customer_result->fetch_assoc();
            $stmt->close();

            if ($customer_data) {
                // Check if customer already exists in debtors table
                $stmt = $conn->prepare("SELECT id FROM debtors WHERE customer_id = ?");
                $stmt->bind_param("i", $customer_id);
                $stmt->execute();
                $debtor_result = $stmt->get_result();
                $stmt->close();

                if ($debtor_result->num_rows == 0) {
                    // Insert new debtor record
                    $stmt = $conn->prepare("INSERT INTO debtors (customer_id, customer_name, email, phone, total_debt, created_date) 
                                            VALUES (?, ?, ?, ?, ?, NOW())");
                    $stmt->bind_param("issdd", $customer_id, $customer_data['customer_name'], 
                                     $customer_data['email'], $customer_data['phone'], $total_price);
                    $stmt->execute();
                    $stmt->close();
                } else {
                    // Update existing debtor's total debt
                    $stmt = $conn->prepare("UPDATE debtors SET total_debt = total_debt + ? WHERE customer_id = ?");
                    $stmt->bind_param("di", $total_price, $customer_id);
                    $stmt->execute();
                    $stmt->close();
                }

                // Insert debt transaction record
                $stmt = $conn->prepare("INSERT INTO debt_transactions (customer_id, order_id, transaction_id, amount, transaction_date, status) 
                                        VALUES (?, ?, ?, ?, NOW(), 'pending')");
                $stmt->bind_param("iisd", $customer_id, $order_id, $transaction_id, $total_price);
                $stmt->execute();
                $stmt->close();
            }
        }

        // ✅ Commit transaction
        $conn->commit();

        // Add success notification
        $success_message = "Order completed successfully! Transaction ID: " . $transaction_id;
        addNotification(
            "Order Completed Successfully",
            $success_message,
            'success'
        );
        
        // Store order details for receipt
        $receipt_data = [
            'transaction_id' => $transaction_id,
            'order_id' => $order_id,
            'total_price' => $total_price,
            'payment_type' => $payment_type
        ];
        
        // Handle M-Pesa payment if applicable
        if ($payment_type === 'mpesa') {
            $mpesa_number = $_POST['mpesa_number'] ?? '';
            if (!empty($mpesa_number)) {
                // Here you would typically integrate with M-Pesa API
                // For now, we'll just redirect to a success page
                echo "<script>localStorage.clear();</script>";
                header("Location: ./pos.php?status=success&payment=mpesa&message=" . urlencode("M-Pesa payment initiated for number: " . $mpesa_number) . "&transaction_id=" . $transaction_id . "&order_id=" . $order_id);
            } else {
                echo "<script>localStorage.clear();</script>";
                header("Location: ./pos.php?status=success&payment=mpesa&message=" . urlencode("M-Pesa payment initiated") . "&transaction_id=" . $transaction_id . "&order_id=" . $order_id);
            }
        } elseif ($payment_type === 'credit') {
            // Credit sale success message
            echo "<script>localStorage.clear();</script>";
            header("Location: ./pos.php?status=success&payment=credit&message=" . urlencode("Credit sale completed! Customer added to debtors list.") . "&transaction_id=" . $transaction_id . "&order_id=" . $order_id);
        } else {
            // ✅ Clear localStorage after success for other payment types
            echo "<script>localStorage.clear();</script>";
            header("Location: ./pos.php?status=success&message=" . urlencode("Order completed successfully! Inventory updated.") . "&transaction_id=" . $transaction_id . "&order_id=" . $order_id);
        }
        exit;

    } catch (mysqli_sql_exception $e) {
        $conn->rollback(); // Rollback transaction on error

        // Check if the error is a duplicate entry
        if ($e->getCode() == 1062) {
            $error_msg = "Transaction ID already exists. Please try again.";
            addNotification("Order Error", $error_msg, 'error');
            header("Location: ./pos.php?status=error&message=" . urlencode($error_msg));
        } else {
            $error_msg = "Failed to save order: " . $e->getMessage();
            addNotification("Order Error", $error_msg, 'error');
            header("Location: ./pos.php?status=error&message=" . urlencode($error_msg));
        }
        exit;
    }
} else {
    // Redirect if accessed directly
    header("Location: pos.php");
    exit;
}
?>


