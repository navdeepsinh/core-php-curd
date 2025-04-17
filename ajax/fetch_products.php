<?php
include('../db.php');

$limit = 4;
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$offset = ($page - 1) * $limit;

$sql = "SELECT * FROM products ORDER BY id DESC LIMIT $offset, $limit";
$result = $conn->query($sql);

$productsHTML = "";
while ($row = $result->fetch_assoc()) {
    $productsHTML .= '<div class="product-box">
    <img src="uploads/' . $row['product_image'] . '" width="100"><br>
    <strong>' . $row['product_name'] . '</strong><br>
    SKU: ' . $row['product_sku'] . '<br>
    Price: ₹' . $row['price'] . '<br>
    Stock: ' . $row['stock'] . '<br>
    <input type="number" min="1" value="1" id="qty_' . $row['id'] . '">
    <button class="add-to-cart-btn" data-id="' . $row['id'] . '">Add to Cart</button>
</div>';
}

$countResult = $conn->query("SELECT COUNT(*) AS total FROM products");
$totalRows = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $limit);

$paginationHTML = "";
for ($i = 1; $i <= $totalPages; $i++) {
    $paginationHTML .= '<a href="#" class="page-link" data-page="' . $i . '">' . $i . '</a>';
}

$response = [
    "products" => $productsHTML,
    "pagination" => $paginationHTML
];

echo json_encode($response);
