<?php
include('../db.php');
session_start();

$product_id = $_POST['product_id'];
$quantity = (int)$_POST['quantity'];

if ($quantity <= 0) {
    echo "❌ Invalid quantity";
    exit;
}

$sql = "SELECT * FROM products WHERE id = $product_id";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    echo "❌ Product not found";
    exit;
}

$product = $result->fetch_assoc();

$item = [
    'id' => $product['id'],
    'name' => $product['product_name'],
    'price' => $product['price'],
    'quantity' => $quantity
];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// If already in cart, update quantity
if (isset($_SESSION['cart'][$product_id])) {
    $_SESSION['cart'][$product_id]['quantity'] += $quantity;
} else {
    $_SESSION['cart'][$product_id] = $item;
}

echo "✅ Added to cart";
