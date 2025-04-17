<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Product</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<h2>Create New Product</h2>
<form id="productForm" enctype="multipart/form-data">
    <input type="text" name="product_name" placeholder="Product Name" required><br>
    <input type="text" name="product_sku" placeholder="SKU" required><br>
    <textarea name="product_details" placeholder="Details"></textarea><br>
    <input type="file" name="product_image" required><br>
    <input type="number" name="stock" placeholder="Stock" required><br>
    <input type="number" step="0.01" name="price" placeholder="Price" required><br>
    <button type="submit">Add Product</button>
</form>

<div id="result"></div>

<script>
$('#productForm').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        url: 'ajax/add_product.php',
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function(res) {
            $('#result').html(res);
            $('#productForm')[0].reset();
        }
    });
});
</script>

</body>
</html>
