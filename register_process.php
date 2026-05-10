<?php

include 'db.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$sql = "INSERT INTO users(username,email,password)
VALUES('$username','$email','$password')";

if(mysqli_query($conn,$sql)){

    header("Location: login.php");

} else {

    echo "Registration Failed";
}

?>