<?php

// the code bellow connects to the mysql database
$dbsevername = "localhost";
// username
$dbusername = "root";
// password
$dbpassword = "";
// database name
$dbname = "email_list";

// function to start connection
// $conn = mysqli_connect($dbsevername, $dbusername, $dbpassword);
$conn = new mysqli($dbsevername, $dbusername, $dbpassword);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

// selecting the database table
mysqli_select_db($conn, "email_list");

// Inserting information into the database

if (isset($_GET['name'])) {
    $name = $_GET['name'];
    $password = $_GET['password'];
    $email = $_GET['email'];
    
    // this is the query to insert into database
    $query ="INSERT INTO `users`(`name`, `email`, `password`) VALUES ('$name','$email','$password')";
    
    // runs query to database
    $result = mysqli_query($conn, $query);
    
    // echo is to print to the screen 
    echo"$query";
}

// Reading information from the database

if (isset($_GET['find_email'])) {
    $email = $_GET['find_email'];
    
    // this is the query to insert into database
    $query ="SELECT `email` FROM `users` WHERE `email` = '$email';";
    
    // runs query to database
    $result = mysqli_query($conn, $query);

    // checks number of rows returned if not "0" makes email = $value 
    $row = mysqli_num_rows($result);
	if ($row == 0) {
		echo ("$email is not found");
	} else {
        while ($row = mysqli_fetch_assoc($result)) {
            $value = $row["email"];
        }  
        echo ("$email does exist");
    }
}

// Updating information to the database

if (isset($_GET['update_name'])) {
    $email = $_GET['search_email'];
    $name = $_GET['update_name'];
    
    // this is the query to insert into database
    $query = "SELECT `name` FROM `users` WHERE `email` = '$email';";
    
    // runs query to database
    $result = mysqli_query($conn, $query);

    // checks number of rows returned if not "0" makes email = $value 
    $row = mysqli_num_rows($result);
	if ($row == 0) {
		echo ("$email is not found");
	} else {

        // this is the query to update to the database
        $query = "UPDATE `users` SET `name`= '$name' WHERE `email` = '$email';";

        // runs query to database
        $result = mysqli_query($conn, $query);

        echo ("Changes have been updated");
    }
}

if (isset($_GET['delete_email'])) {
    $email = $_GET['delete_email'];

    // --------------------------------------------------------------------------------------------------------------------
    // Make into funtion 
    // --------------------------------------------------------------------------------------------------------------------

    // this is the query to insert into database
    $query ="SELECT `email` FROM `users` WHERE `email` = '$email';";
    
    // runs query to database
    $result = mysqli_query($conn, $query);
    
    // checks number of rows returned if not "0" makes email = $value 
    $row = mysqli_num_rows($result);
	if ($row == 0) {
        echo ("$email is not found");
	} else {
        while ($row = mysqli_fetch_assoc($result)) {
            $value = $row["email"];
        }  
        // $value variable not used

        // **************************
        // this is the query to delete from the database
        $query = "DELETE FROM `users` WHERE `email` = '$email';";
        
        // runs query to database
        $result = mysqli_query($conn, $query);
        
        echo ("$email deleted");
        // **************************
        
    }
    
    // --------------------------------------------------------------------------------------------------------------------
    

}
// echo"Page has loaded";