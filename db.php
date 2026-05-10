<?php

$conn = mysqli_connect(
"127.0.0.1",
"root",
"siddhu@rvu",
"smart grocery store"
);

if(!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}

?>