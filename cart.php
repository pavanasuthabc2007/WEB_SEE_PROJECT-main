<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
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

<main class="cart-page">
    <h2>Your Cart</h2>

    <div id="cart-items"></div>

    <h3 id="total"></h3>
    <button class="buy-btn" onclick="buyNow()">Buy Now</button>

</main>

<script src="js/cart.js"></script>
</body>
</html>
