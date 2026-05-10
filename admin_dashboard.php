<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit();
}

include 'db.php';

// ADD PRODUCT
if(isset($_POST['add_product'])){
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $description = $_POST['description'];
    mysqli_query($conn, "INSERT INTO products (name, category, price, image, description) VALUES ('$name', '$category', '$price', '$image', '$description')");
    header("Location: admin_dashboard.php#products");
    exit();
}

// DELETE PRODUCT
if(isset($_GET['delete_id'])){
    mysqli_query($conn, "DELETE FROM products WHERE product_id = ".$_GET['delete_id']);
    header("Location: admin_dashboard.php#products");
    exit();
}

// UPDATE PRODUCT
if(isset($_POST['update_product'])){
    $id = $_POST['product_id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    mysqli_query($conn, "UPDATE products SET name='$name', category='$category', price='$price', image='$image' WHERE product_id=$id");
    header("Location: admin_dashboard.php#products");
    exit();
}

// FETCH DATA
$total_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users"))['total'];
$total_products = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM products"))['total'];
$total_orders = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM orders"))['total'];
$orders = mysqli_query($conn, "SELECT * FROM orders ORDER BY order_date DESC");
$products = mysqli_query($conn, "SELECT * FROM products ORDER BY category");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f4f4f4; }
        .admin-header { background: #2e7d32; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        .admin-header h1 { font-size: 24px; }
        .admin-nav { display: flex; gap: 15px; }
        .admin-nav a { color: white; text-decoration: none; padding: 8px 15px; background: rgba(255,255,255,0.2); border-radius: 5px; }
        .admin-nav a:hover { background: rgba(255,255,255,0.4); }
        .dashboard-body { padding: 30px; }
        .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; padding: 25px; border-radius: 10px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .stat-card h2 { font-size: 48px; color: #2e7d32; }
        .stat-card p { color: #666; margin-top: 5px; }
        .section-title { font-size: 22px; font-weight: bold; margin: 30px 0 15px; color: #333; }
        .add-form { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .add-form h3 { color: #2e7d32; margin-bottom: 15px; }
        .form-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin-bottom: 15px; }
        .form-row input, .form-row select { padding: 9px; border: 1px solid #ddd; border-radius: 5px; width: 100%; font-size: 14px; }
        .btn-add { background: #2e7d32; color: white; padding: 10px 25px; border: none; border-radius: 5px; cursor: pointer; font-size: 15px; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 30px; }
        th { background: #2e7d32; color: white; padding: 12px 15px; text-align: left; }
        td { padding: 10px 15px; border-bottom: 1px solid #eee; }
        tr:hover { background: #f9f9f9; }
        .edit-input { padding: 5px; border: 1px solid #ddd; border-radius: 4px; width: 100%; font-size: 13px; }
        .btn-delete { background: #e53935; color: white; text-decoration: none; padding: 6px 12px; border-radius: 5px; font-size: 13px; border: none; cursor: pointer; }
        .btn-save { background: #2e7d32; color: white; padding: 6px 12px; border-radius: 5px; font-size: 13px; border: none; cursor: pointer; }
        .logout-btn { background: #e53935; color: white; padding: 8px 15px; border-radius: 5px; text-decoration: none; }
    </style>
</head>
<body>

<div class="admin-header">
    <h1>🛒 Admin Dashboard</h1>
    <div class="admin-nav">
        <a href="#orders">Orders</a>
        <a href="#products">Products</a>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</div>

<div class="dashboard-body">

    <!-- STATS -->
    <div class="stats-grid">
        <div class="stat-card">
            <h2><?php echo $total_users; ?></h2>
            <p>Total Users</p>
        </div>
        <div class="stat-card">
            <h2><?php echo $total_products; ?></h2>
            <p>Total Products</p>
        </div>
        <div class="stat-card">
            <h2><?php echo $total_orders; ?></h2>
            <p>Total Orders</p>
        </div>
    </div>

    <!-- ORDERS -->
    <div id="orders">
        <p class="section-title">📦 All Orders</p>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Total</th>
                <th>Payment</th>
                <th>Date</th>
            </tr>
            <?php while($order = mysqli_fetch_assoc($orders)){ ?>
            <tr>
                <td>#<?php echo $order['order_id']; ?></td>
                <td><?php echo $order['full_name']; ?></td>
                <td><?php echo $order['phone']; ?></td>
                <td><?php echo $order['address']; ?></td>
                <td>₹<?php echo $order['total_amount']; ?></td>
                <td><?php echo $order['payment_method']; ?></td>
                <td><?php echo $order['order_date']; ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>

    <!-- PRODUCTS -->
    <div id="products">
        <p class="section-title">🛍️ All Products</p>

        <!-- ADD PRODUCT FORM -->
        <div class="add-form">
            <h3>➕ Add New Product</h3>
            <form method="POST">
                <div class="form-row">
                    <input type="text" name="name" placeholder="Product Name" required>
                    <select name="category" required>
                        <option value="">Select Category</option>
                        <option value="Fruits">Fruits</option>
                        <option value="Vegetables">Vegetables</option>
                        <option value="Dairy">Dairy</option>
                        <option value="Snacks">Snacks</option>
                        <option value="Oils/Ghee">Oils/Ghee</option>
                        <option value="Cereals/DryFruits">Cereals/DryFruits</option>
                        <option value="Juices/Colddrinks">Juices/Colddrinks</option>
                    </select>
                    <input type="number" name="price" placeholder="Price (₹)" required>
                </div>
                <div class="form-row">
                    <input type="text" name="image" placeholder="Image path (images/apple.jpg)">
                    <input type="text" name="description" placeholder="Description">
                </div>
                <button type="submit" name="add_product" class="btn-add">➕ Add Product</button>
            </form>
        </div>

        <!-- PRODUCTS TABLE -->
        <table>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            <?php while($product = mysqli_fetch_assoc($products)){ ?>
            <tr>
                <form method="POST">
                <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                <td><?php echo $product['product_id']; ?></td>
                <td><img src="<?php echo $product['image']; ?>" width="50" height="50" style="object-fit:cover; border-radius:5px;"></td>
                <td><input class="edit-input" type="text" name="name" value="<?php echo $product['name']; ?>"></td>
                <td>
                    <select name="category" class="edit-input">
                        <?php
                        $cats = ['Fruits','Vegetables','Dairy','Snacks','Oils/Ghee','Cereals/DryFruits','Juices/Colddrinks'];
                        foreach($cats as $cat){
                            $selected = ($product['category'] == $cat) ? 'selected' : '';
                            echo "<option value='$cat' $selected>$cat</option>";
                        }
                        ?>
                    </select>
                </td>
                <td><input class="edit-input" type="number" name="price" value="<?php echo $product['price']; ?>"></td>
                <td>
                    <button type="submit" name="update_product" class="btn-save">💾 Save</button>
                    </form>
                    <a href="?delete_id=<?php echo $product['product_id']; ?>"
                       class="btn-delete"
                       onclick="return confirm('Are you sure?')">🗑️ Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>

</div>

</body>
</html>