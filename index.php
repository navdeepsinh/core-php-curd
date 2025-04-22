<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <style>
        .product-box { border: 1px solid #ddd; padding: 10px; margin: 10px; width: 250px; float: left; }
        .pagination a { margin: 5px; padding: 5px 10px; background: #f0f0f0; border: 1px solid #ccc; text-decoration: none; }
        a.create-product {background-color: #0095ff; color: #f0f0f0; border-radius: 0; padding: 5px; text-decoration: none;}
        span.round-cart-items {
            background: red;
            height: 25px;
            border-radius: 50%;
            width: 30px;
            position: absolute;
            top: -26px;
            right: -15px;
            text-align: center;
            padding-top: 7px;
            font-size: 16px;
        }
        a.create-product  {
            position: relative;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<?php
$quantityCount = 0;
if (isset($_SESSION["cart"])) { 
    $productsInCart = $_SESSION["cart"];
    foreach ($productsInCart as $proItem) {
        $quantityCount += $proItem["quantity"];
    }
}
?>
<h2>All Products</h2>
<a href="/product_create.php" class="create-product">Create product</a>
<a href="/cart.php" class="create-product" id="cart-items"><span class="round-cart-items"><?php echo $quantityCount; ?></span>&nbsp;Cart</a>
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
                $('.round-cart-items').text(quantity);
            }
        });
    });
});
</script>

</body>
</html>
