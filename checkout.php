<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Smart Grocery Store</title>
    <link rel="stylesheet" href="style.css">
    <script src="js/script.js" defer></script>
    <style>
        h2{
            color: rgb(8, 141, 224);
            margin: 10px;
        }
    </style>
</head>

<body>

    <header>
        <h1>Smart Grocery Store</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="products.php">Products</a>
            <a href="cart.php">Cart</a>
            <a href="checkout.php">Checkout</a>
        </nav>
    </header>

    <h2>Checkout</h2>

    <main class="checkout-page">
        

        <div id="checkout-container">

            <!-- LEFT SIDE: FORM -->
            <section id="billing-shipping" >

           <form id="checkoutForm">

    <!-- SHIPPING DETAILS -->
    <fieldset class="form-box">
        <legend>Shipping Details</legend>

        <div class="form-group full">
            <label for="fullName">Full Name</label>
            <input type="text" id="fullName" name="fullName">
        </div>

        <div class="form-group">
            <label for="phoneNum">Phone Number</label>
            <input type="tel" id="phoneNum" name="phoneNum">
        </div>

        <div class="form-group full">
            <label for="deliveryAddress">Address</label>
            <textarea id="deliveryAddress" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="pincode">Pincode</label>
            <input type="text" id="pincode">
        </div>
    </fieldset>

    <!-- PAYMENT METHOD -->
    <fieldset class="form-box">
        <legend>Payment Method</legend>

        <label>
            <input type="radio" name="paymentMethod" checked> Cash On Delivery
        </label><br>

        <label>
            <input type="radio" name="paymentMethod"> UPI
        </label>
    </fieldset>

    <!-- ✅ FIXED BUTTON -->
    <button type="button" class="primary-button" onclick="showOrderSummary()">
        Place Order
    </button>

</form>


            </section>

           
   <!-- RIGHT SIDE: ORDER SUMMARY -->
<section id="checkout-summary">
    <h3>Your Order</h3>
    <div id="order-items"></div>

    <div class="summary-total">
        <strong>Total:</strong>
        <span id="summary-total-price">₹0</span>
        <p id="delivery-date"></p>

    </div>
</section>
        </div>
        </div>
    </main>


<script src="js/checkout.js"></script>
</body>
</html>
