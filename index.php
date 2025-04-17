<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <style>
        .product-box { border: 1px solid #ddd; padding: 10px; margin: 10px; width: 250px; float: left; }
        .pagination a { margin: 5px; padding: 5px 10px; background: #f0f0f0; border: 1px solid #ccc; text-decoration: none; }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<h2>All Products</h2>
<div id="product-list"></div>
<div class="pagination" id="pagination"></div>

<script>
function loadProducts(page = 1) {
    $.ajax({
        url: 'ajax/fetch_products.php',
        type: 'POST',
        data: { page: page },
        success: function(data) {
            let response = JSON.parse(data);
            $('#product-list').html(response.products);
            $('#pagination').html(response.pagination);
        }
    });
}

$(document).on('click', '.page-link', function(e) {
    e.preventDefault();
    let page = $(this).data('page');
    loadProducts(page);
});

$(document).ready(function() {
    loadProducts();
    $(document).on('click', '.add-to-cart-btn', function() {
        let productId = $(this).data('id');
        let quantity = $('#qty_' + productId).val();

        $.ajax({
            url: 'ajax/add_to_cart.php',
            type: 'POST',
            data: { product_id: productId, quantity: quantity },
            success: function(response) {
                alert(response);
            }
        });
    });
});
</script>

</body>
</html>
