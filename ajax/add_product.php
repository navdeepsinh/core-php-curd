<?php
include('../db.php');

$name = $_POST['product_name'];
$sku = $_POST['product_sku'];
$details = $_POST['product_details'];
$stock = $_POST['stock'];
$price = $_POST['price'];

$img = $_FILES['product_image']['name'];
$tmp = $_FILES['product_image']['tmp_name'];

$path = "../uploads/" . basename($img);
move_uploaded_file($tmp, $path);

$sql = "INSERT INTO products (product_name, product_sku, product_details, product_image, stock, price)
        VALUES ('$name', '$sku', '$details', '$img', '$stock', '$price')";

if ($conn->query($sql)) {
    echo "✅ Product Added Successfully!";
} else {
    echo "❌ Error: " . $conn->error;
}
?>
