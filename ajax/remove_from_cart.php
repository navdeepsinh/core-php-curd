<?php
session_start();

$product_id = $_POST['product_id'];

if (isset($_SESSION['cart'][$product_id])) {
    unset($_SESSION['cart'][$product_id]);
    echo "🗑 Removed from cart";
} else {
    echo "❌ Product not found in cart";
}
