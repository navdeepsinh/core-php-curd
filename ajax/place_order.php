<?php
include('../db.php');
session_start();

$cart = $_SESSION['cart'] ?? [];
if (empty($cart)) {
    echo "Cart is empty.";
    exit;
}

// 1. Insert user
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$address = $_POST['address'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$pincode = $_POST['pincode'];
$city = $_POST['city'];
$state = $_POST['state'];
$country = $_POST['country'];
$payment_mode = $_POST['payment_mode'];

$stmt = $conn->prepare("INSERT INTO users (firstname, lastname, address, mobile, email, pincode, city, state, country)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssss", $firstname, $lastname, $address, $mobile, $email, $pincode, $city, $state, $country);
$stmt->execute();
$user_id = $stmt->insert_id;
$stmt->close();

// 2. Insert each product into orders + update stock
foreach ($cart as $item) {
    $product_id = $item['id'];
    $qty = $item['quantity'];

    // Fetch stock
    $stockRes = $conn->query("SELECT stock FROM products WHERE id = $product_id");
    $stockData = $stockRes->fetch_assoc();
    $currentStock = $stockData['stock'];

    if ($currentStock < $qty) {
        echo "Not enough stock for {$item['name']}";
        exit;
    }

    $total = $item['price'] * $qty;

    $orderStmt = $conn->prepare("INSERT INTO orders (user_id, product_id, quantity, total_amount, payment_mode)
        VALUES (?, ?, ?, ?, ?)");
    $orderStmt->bind_param("iiids", $user_id, $product_id, $qty, $total, $payment_mode);
    $orderStmt->execute();
    $orderStmt->close();

    // Reduce stock
    $conn->query("UPDATE products SET stock = stock - $qty WHERE id = $product_id");
}

unset($_SESSION['cart']);
echo "Order placed successfully!";
