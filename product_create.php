<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Product</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        a.create-product {background-color: #0095ff; color: #f0f0f0; border-radius: 0; padding: 5px; text-decoration: none;}
        input {
            margin: 10px;
            height: 25px;
            border-radius: 5px;
            border: 1px solid #000;
            margin-left: 0px;
        }
        input[type="file"] {
            border: indianred;
            border-radius: 0;
            margin-left: 0px;
        }
        textarea {
            margin: 10px;
            border: 1px solid #000;
            border-radius: 5px;
            margin-left: 0px;
        }
    </style>
</head>
<body>

<h2>Create New Product <a href="/" class="create-product">List Product</a></h2>

<form id="productForm" enctype="multipart/form-data">
    <input type="text" name="product_name" placeholder="Product Name" required><br>
    <input type="text" name="product_sku" placeholder="SKU" required><br>
    <textarea name="product_details" placeholder="Details" rows="5"></textarea><br>
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
