<?php
include('config.php');
$cart = $_SESSION['cart'] ?? [];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <style>
        table { border-collapse: collapse; width: 80%; margin: 20px auto; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        .remove-btn { color: red; cursor: pointer; }
        a#order-order {
            text-decoration: none;
            color: #fff;
            background: #2a2aa9;
            padding: 5px;
            font-weight: 600;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<h2 align="center">🛒 Your Shopping Cart</h2>

<table>
    <thead>
        <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
            <th>Remove</th>
        </tr>
    </thead>
    <tbody id="cart-body">
        <?php
        $grandTotal = 0;
        if (!empty($cart)) {
            foreach ($cart as $item) {
                $total = $item['quantity'] * $item['price'];
                $grandTotal += $total;
                echo "<tr>
                    <td>{$item['name']}</td>
                    <td>{$item['quantity']}</td>
                    <td>₹{$item['price']}</td>
                    <td>₹$total</td>
                    <td><span class='remove-btn' data-id='{$item['id']}'>🗑</span></td>
                </tr>";
            }
            echo "<tr>
                    <td colspan='2'><strong>Grand Total</strong></td>
                    <td colspan='2'><strong>₹$grandTotal</strong></td>
                    <td colspan='1'><a href='/checkout.php' class='order-now' id='order-order'>Order Now</a></td>
                </tr>";
        } else {
            echo "<tr><td colspan='5'>Cart is empty.</td></tr>";
        }
        ?>
    </tbody>
</table>

<script>
$(document).on('click', '.remove-btn', function() {
    let productId = $(this).data('id');

    $.ajax({
        url: 'ajax/remove_from_cart.php',
        type: 'POST',
        data: { product_id: productId },
        success: function(response) {
            alert(response);
            location.reload();
        }
    });
});
</script>

</body>
</html>
