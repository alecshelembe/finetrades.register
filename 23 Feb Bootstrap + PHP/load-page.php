<?php

include_once("functions.php");

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password= $_POST['p_key'];
    insert_info($conn,$dbname,$table,"email",$email);
    update_info($conn,$dbname,$table,"name","email",$name,$email);
    update_info($conn,$dbname,$table,"password","email",$password,$email);
    // update_info($conn,$dbname,$table,"name","email",$name,$email);

    if (file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])) {

        $image = $_FILES['image']['name'];
        $file_type = $_FILES['image']['type'];
        $file_size = $_FILES['image']['size'];
        $file_tem_loc = $_FILES['image']['tmp_name'];
    
        $image = 'pic_'."$name";
    
        $dir = "uploaded-images";
        // $dir = $_SERVER['DOCUMENT_ROOT'] . "/dashboard/2023/Fintech solutions/Space Dynamic Free Website Template - Free-CSS.com/templatemo_562_space_dynamic/profile-images/";
    
        $image = image_process($conn, $dir, $image, $file_type, $file_size, $file_tem_loc);
        update_info($conn, $dbname, 'users', 'image', 'email', $image, $email);
        echo("Successful");
    }

    // update_info($conn,$dbname,$table,"image",$identifier_row,$info,$info);
}