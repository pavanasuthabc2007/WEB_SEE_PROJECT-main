<?php

session_start();

include 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users 
WHERE username='$username' 
AND password='$password'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){

    $row = mysqli_fetch_assoc($result);

    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['role'] = $row['role'];

    if($row['role'] == 'admin'){

header("Location: http://localhost/WEB_SEE_PROJECT-main/admin_dashboard.php");

    } else {
header("Location: http://localhost/WEB_SEE_PROJECT-main/index.php");}
} else {

    echo "Invalid Username or Password";
}

?>