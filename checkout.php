<?php
include('config.php');
$cart = $_SESSION['cart'] ?? [];
if (empty($cart)) {
    echo "<script>alert('Cart is empty!'); window.location.href='index.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <style>
        input, select { padding: 8px; margin: 5px 0; width: 100%; }
        .container { width: 600px; margin: 0 auto; }
        .btn { padding: 10px 20px; background: green; color: white; border: none; cursor: pointer; }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container">
    <h2>🧾 Checkout</h2>

    <form id="checkout-form">
        <h3>User Info</h3>
        <input type="text" name="firstname" placeholder="First Name" required>
        <input type="text" name="lastname" placeholder="Last Name" required>
        <input type="text" name="mobile" placeholder="Mobile Number" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="address" placeholder="Address" required>
        <input type="text" name="pincode" placeholder="Pincode" required>
        <input type="text" name="city" placeholder="City" required>
        <input type="text" name="state" placeholder="State" required>
        <input type="text" name="country" placeholder="Country" required>

        <label>Payment Mode</label>
        <select name="payment_mode" required>
            <option value="COD">Cash on Delivery</option>
            <option value="Online">Online Payment</option>
        </select>

        <br><br>
        <button type="submit" class="btn">Place Order</button>
    </form>
</div>

<script>
$('#checkout-form').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        url: 'ajax/place_order.php',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            alert(response);
            if (response.includes("Order placed")) {
                window.location.href = "index.php";
            }
        }
    });
});
</script>

</body>
</html>
