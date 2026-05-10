<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}
include 'db.php';
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html>
<head>
  

    <title>Products - Smart Grocery Store</title>
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

    <main class="products-page">
        <h2>All Products</h2>
        
        <section id="search-container">
            <input type="text" id="searchBar" placeholder="Search products..." onkeyup="searchProducts()">
        </section>

       <nav id="category-filters">
    <button class="filter-btn active" onclick="filterCategory('All')">All</button>
    <button class="filter-btn" onclick="filterCategory('Fruits')">Fruits</button>
    <button class="filter-btn" onclick="filterCategory('Vegetables')">Vegetables</button>
    <button class="filter-btn" onclick="filterCategory('Dairy')">Dairy</button>
    <button class="filter-btn" onclick="filterCategory('Snacks')">Snacks</button>
    <button class="filter-btn" onclick="filterCategory('Oils/Ghee')">Oils/Ghee</button>
    <button class="filter-btn" onclick="filterCategory('Cereals/DryFruits')">Cereals/DryFruits</button>
    
    <button class="filter-btn" onclick="filterCategory('Juices/Colddrinks')">Juices/Colddrinks</button>
    
</nav>



<section id="product-list" class="product-grid content-section">

    <?php while($row = mysqli_fetch_assoc($result)){ ?>
    <div class="product" data-category="<?php echo $row['category']; ?>">
        <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
        <h3><?php echo $row['name']; ?></h3>
        <p>₹<?php echo $row['price']; ?></p>
        <button class="add-to-cart-btn" 
            data-id="<?php echo $row['product_id']; ?>"
            data-name="<?php echo $row['name']; ?>"
            data-price="<?php echo $row['price']; ?>"
            data-image="<?php echo $row['image']; ?>">
            Add to Cart
        </button>
    </div>
<?php } ?>

<p id="no-products-msg" style="display:none; text-align:center; font-weight:bold; margin-top:20px;">Product not available</p>
   
</section>



        
    </main>


    <script src="js/script.js"></script>
 

</body>
</html>
