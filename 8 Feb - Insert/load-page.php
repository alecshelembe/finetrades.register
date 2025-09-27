<?php

$dbsevername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "email_list";

$conn = mysqli_connect($dbsevername, $dbusername, $dbpassword);

mysqli_select_db($conn, $dbname);

if (isset($_GET['name'])) {
    $name = $_GET['name'];
    $password = $_GET['password'];
    $email = $_GET['email'];
    
    // this is the query to insert into database
    $query ="INSERT INTO `users`(`name`, `email`, `password`) VALUES ('$name','$email','$password')";
    
    // writes into the database
    $result = mysqli_query($conn, $query);
    
    echo"$query";
}
// echo"Page has loaded";