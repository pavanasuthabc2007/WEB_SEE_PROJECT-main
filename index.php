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
    <title>Smart Grocery Store</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">





</head>
<body>

    <header>
    <div class="profile-wrapper">
    <div class="profile-avatar" onclick="toggleProfileDropdown()">
        👤
    </div>

    <div class="profile-dropdown" id="profileDropdown">
        <p class="profile-name" id="profileName"></p>
        <p class="profile-phone" id="profilePhone"></p>
        <hr>
        <button onclick="logout()">Logout</button>
    </div>
</div>

        <h1>Smart Grocery Store</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="products.php">Products</a>
            <a href="cart.php">Cart</a>
            <a href="checkout.php">Checkout</a>
        </nav>
    </header>

    <main>
        <!-- Hero Banner -->
      <section id="banner">

    <div class="banner-slider">
        <div class="banner-track">
            <img src="images/banner1.png" class="banner-slide">
            <img src="images/banner2.png" class="banner-slide">
            <img src="images/banner3.png" class="banner-slide">
        </div>
    </div>

    <div class="banner-content">
        <h2>Fresh Groceries Delivered to Your Home</h2>
        <a href="products.php" class="primary-button">Shop Now</a>
    </div>

    <div class="banner-dots">
        <span class="dot active"></span>
        <span class="dot"></span>
        <span class="dot"></span>
    </div>

</section>


        <!-- Categories Section -->
        <section id="categories" class="content-section">
            <h2>Shop by Category</h2>
            <ul class="category-grid">
                <li class="category-tile" data-category="Fruits">
                      <a href="products.php?category=Fruits">
                    <img src="images/apple.jpg" alt="Fruits">
                    <span>Fruits</span>
                    </a>
                </li>
                <li class="category-tile" data-category="Vegetables">
                     <a href="products.php?category=Vegetables">
                    <img src="images/tomato.jpg" alt="Vegetables">
                    <span>Vegetables</span>
                    </a>
                </li>
                <li class="category-tile" data-category="Dairy">
                     <a href="products.php?category=Dairy">
                    <img src="images/milk.jpg" alt="Dairy">
                    <span>Dairy</span>
                    </a>
                </li>
                <li class="category-tile" data-category="Snacks">
                     <a href="products.php?category=Snacks">
                    <img src="images/chips.jpg" alt="Snacks">
                    <span>Snacks</span>
                    </a>
                </li>
                <li class="category-tile" data-category="Oil/Ghee">
                     <a href="products.php?category=Oil/Ghee">
                    <img src="images/groundnut.jpg" alt="Oil/Ghee">
                    <span>Oil/Ghee</span>
                    </a>
                </li>
                <li class="category-tile" data-category="Juices/Colddrinks">
                     <a href="products.php?category=Juices/Colddrinks">
                    <img src="images/maaza.jpg" alt="Juices/Colddrinks">
                    <span>Juices/Colddrinks</span>
                    </a>
                </li>
                <li class="category-tile" data-category="Cereals/DryFruits">
                     <a href="products.php?category=Cereals/DryFruits">
                    <img src="images/rice.jpg" alt="Cereals/DryFruits">
                    <span>Cereals/DryFruits</span>
                    </a>
                 </li>
            </ul>
        </section>

        <!-- Featured Products -->
        <section id="featured" class="content-section">
            <h2>Best Selling Products</h2>
            <div id="featured-products-grid" class="product-grid">
                <div class="product-card" data-id="1">
                    <img src="images/apple.jpg" alt="Apple">
                    <h3>Apple</h3>
                    <p>₹40</p>
                    
                </div>
                <div class="product-card" data-id="5">
                    <img src="images/milk.jpg" alt="Milk">
                    <h3>Milk</h3>
                    <p>₹30</p>
                    
                </div>
                <div class="product-card" data-id="2">
                    <img src="images/banana.jpg" alt="Banana">
                    <h3>Banana</h3>
                    <p>₹50/dozen</p>
                    
                </div>
                <div class="product-card" data-id="3">
                    <img src="images/chips.jpg" alt="Chips">
                    <h3>Chips</h3>
                    <p>₹20</p>
                    
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; Shop with enjoy ! Pavanasutha and Nandhesh is here for all your grocery needs.</p>
    </footer>

    <script src="js/script.js"></script>
   <script>
function toggleProfileDropdown() {
    const dropdown = document.getElementById("profileDropdown");
    dropdown.style.display =
        dropdown.style.display === "block" ? "none" : "block";
}

// Load user details
document.addEventListener("DOMContentLoaded", function () {
    const name = "<?php echo $_SESSION['username']; ?>";
    document.getElementById("profileName").innerText = "👤 " + name;
});
// Close dropdown when clicking outside
document.addEventListener("click", function (event) {
    const profile = document.querySelector(".profile-wrapper");
    if (!profile.contains(event.target)) {
        document.getElementById("profileDropdown").style.display = "none";
    }
});

// Logout
function logout() {
    window.location.href = "logout.php";
}
</script>
</body>
</html>
