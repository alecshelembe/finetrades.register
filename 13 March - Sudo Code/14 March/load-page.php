<?php

$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "email_list";

$conn = mysqli_connect($dbservername, $dbusername, $dbpassword);

mysqli_select_db($conn, $dbname);
if (isset ($_POST{'name'})) {
    $name = $_POST ['username'];
    $email = $_POST ['email'];
    $password = $_POST ['password'];
    $confirmpassword = $_POST ['confirmpassword'];

    $query = "INSERT INTO `users`(`name`, `email`, `password`, `confirm password`) VALUES ('$name','$email','$password','$confirmpassword')";
$result =mysqli_query($conn, $query);

echo"$query";

}