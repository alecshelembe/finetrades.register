<?php

// the code bellow connects to the mysql database
$dbsevername = "localhost";
// username
$dbusername = "root";
// password
$dbpassword = "";
// database name
$dbname = "register";
$table = "users";


// function to start connection
$conn = mysqli_connect($dbsevername, $dbusername, $dbpassword);

// selecting the database table
mysqli_select_db($conn, $dbname);


function sanitizeString(){
    
}

function alert($var) {
	echo("<script type=\"text/javascript\">
		alert(\"$var\");
		</script>");
}

function redirect_back() {
	echo("<script type=\"text/javascript\">
		window.history.go(-1);
		</script>");
	exit();
}

function image_process($varconn,$dir,$image,$file_type,$file_size,$file_tem_loc){


    if (is_dir($dir) === false){
        mkdir($dir);
    }
	switch($file_type)
	{
        case 'image/jpeg':  $ext = 'jpg';   break;
		case 'image/gif':   $ext = 'gif';   break;
		case 'image/png':   $ext = 'png';   break;
		case 'image/tiff':  $ext = 'tiff';  break;	
		case 'image/jfif':  $ext = 'jfif';  break;	
		default:       
		alert("$file_type is not a valid image file $image unallowed");
		redirect_back();
	} 
    
	if ($ext){	
        $image = "$image".'.'."$ext";
		$file_store = "$dir/$image";
		move_uploaded_file($file_tem_loc, $file_store);
		return "$image";
    } else {
		alert("Something went wrong with the upload. Try a different one.");
		redirect_back();
    }

}

function insert_info($varconn,$dbname,$table,$row_title,$info){
	
	$query = "INSERT INTO `$table` (`$row_title`) VALUES ('$info');";

	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));

	// echo("$query");
	// exit("$query");


}

function update_info($varconn,$dbname,$table,$row_title,$identifier_row,$info,$identifier_info){
	
	$query = "UPDATE `$table` SET `$row_title` = '$info' WHERE `$table`.`$identifier_row` = '$identifier_info';";

	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));

	// echo("$query");
	// exit("$query");
}