<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])){
    echo json_encode(['status' => 'error', 'message' => 'Not logged in']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);

$user_id = $_SESSION['user_id'];
$full_name = $data['full_name'];
$phone = $data['phone'];
$address = $data['address'];
$pincode = $data['pincode'];
$payment_method = $data['payment_method'];
$total_amount = $data['total_amount'];
$items = $data['items'];

// Insert into orders table
$sql = "INSERT INTO orders (user_id, full_name, phone, address, pincode, payment_method, total_amount)
VALUES ('$user_id', '$full_name', '$phone', '$address', '$pincode', '$payment_method', '$total_amount')";

if(mysqli_query($conn, $sql)){
    $order_id = mysqli_insert_id($conn);

    // Insert each item into order_items table
    foreach($items as $item){
        $product_name = $item['name'];
        $price = $item['price'];
        $quantity = $item['qty'];

        $sql2 = "INSERT INTO order_items (order_id, product_name, price, quantity)
        VALUES ('$order_id', '$product_name', '$price', '$quantity')";

        mysqli_query($conn, $sql2);
    }

    echo json_encode(['status' => 'success', 'order_id' => $order_id]);

} else {
    echo json_encode(['status' => 'error', 'message' => 'Order failed']);
}
?>