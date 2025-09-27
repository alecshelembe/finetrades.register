<?php

include_once('functions-page.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body class='container'>

<?php
// Reading information from the database

if (isset($_POST['add_to_cart'])) {
    $id = $_POST['id'];
    
    // this is the query to insert into database
    $query ="SELECT `id` FROM `products` WHERE `id` = '$id';";
    
    // runs query to database
    $result = mysqli_query($conn, $query);

    // checks number of rows returned if not "0" makes email = $value 
    $row = mysqli_num_rows($result);
	if ($row == 0) {
		echo ("Product $id is not found");
	} else {
        while ($row = mysqli_fetch_assoc($result)) {
            $value = $row["id"];
        }  
        
        $name = return_info($conn, 'products', 'name', 'id', $id);
        $id = return_info($conn, 'products', 'id', 'id', $id);
        $price = return_info($conn, 'products', 'price', 'id', $id);
        $description = return_info($conn, 'products', 'description', 'id', $id);
        $status = return_info($conn, 'products', 'status', 'id', $id);

        $_SESSION["p$id"] = "yes";
        $session = ''.$_SESSION["p$id"];
        
        echo ("ID of product is Id: $id <br>Name: $name <br>Price: $price <br>Description: $description <br>Session: $session");
        echo("<br>");
        echo("<br>");
        echo("Product ID's selected or in cart");
        echo("<br>");
        
        include("calculate-total.php");
        redirect_back();

    }
}


if (isset($_POST['checkout'])) {
    // foreach ($_SESSION as $key=>$val)
    // echo $key." ".$val."<br/>";
    include("calculate-total.php");

    echo("R Total $total");

    echo("<div class='mb-3'>
    <form action='load-page.php' method='post'>

    <div class='m-3'>
    <label for='formGroupExampleInput2' class='form-label'>Email</label>
    <input type='email' name='checkout_email' class='form-control' id='formGroupExampleInput2' placeholder='Enter your email address' required>
    <input type='submit' class='m-3 btn btn-outline-success' name='pay_now' value='Place My Order'>
    </form>
    </div>
    ");
}

if(isset($_POST['pay_now'])){

$email = $_POST['checkout_email'];

$total = 0;
foreach ($_SESSION as $key=>$val){
$product_id_number_without_p = substr($key, -6);    // returns "f"
$price = return_info($conn, 'products', 'price', 'id', $product_id_number_without_p);
$total += $price;
}

$name ='First';
$name_person = 'First';
$phone = '0614523201';
$lastname = 'Last';

$id = rand(1000, 9999);

/**
 * @param array $data
 * @param null $passPhrase
 * @return string
 */
// '1Q2w3e4r5t6y7u8i9o.'
// jt7NOE43FZPn
function generateSignature($data, $passPhrase = 'jt7NOE43FZPn')
{
  // Create parameter string
  $pfOutput = '';
  foreach ($data as $key => $val) {
    if ($val !== '') {
      $pfOutput .= $key . '=' . urlencode(trim($val)) . '&';
    }
  }
  // Remove last ampersand
  $getString = substr($pfOutput, 0, -1);
  if ($passPhrase !== null) {
    $getString .= '&passphrase=' . urlencode(trim($passPhrase));
  }
  return md5($getString);
}

// Construct variables
$cartTotal = $total; // This amount needs to be sourced from your application
$data = array(
  // Merchant details
//   'merchant_id' => '17393408',
//   'merchant_key' => 'nn2tkc8asjvsi',
  'merchant_id' => '10000100',
  'merchant_key' => '46f0cd694581a',
  'return_url' => 'https://gconnex.000webhostapp.com/ajax-results/return.php',
  'cancel_url' => 'https://gconnex.000webhostapp.com/ajax-results/cancel.php',
  'notify_url' => 'https://gconnex.000webhostapp.com/ajax-results/notify.php',
  // Buyer details
  'name_first' => "$name",
  'name_last'  => "$lastname",
  'email_address' => "$email",
  'cell_number' => "$phone",

  // Transaction details
  'm_payment_id' => "$id", //Unique payment ID to pass through to notify_url
  'amount' => number_format(sprintf('%.2f', $total), 2, '.', ''),
  'item_name' => "Test-transaction",
  'item_description' => "Test-transaction",
  'custom_int1' => '2',
  'custom_int2' => '4',
  'custom_int3' => '6',
  'custom_int4' => '8',
  'custom_int5' => '10',
  'custom_str1' => 'two',
  'custom_str2' => 'four',
  'custom_str3' => 'six',
  'custom_str4' => 'eight',
  'custom_str5' => 'ten',
  'email_confirmation' => "1",
  'confirmation_address' => "admin@finetrades.co.za",
  'payment_method' => '',
);

$signature = generateSignature($data);
$data['signature'] = $signature;

// If in testing mode make use of either sandbox.payfast.co.za or www.payfast.co.za
$testingMode = true;
$pfHost = $testingMode ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';
$htmlForm = '<form action="https://' . $pfHost . '/eng/process" method="post">';
foreach ($data as $name => $value) {
  $htmlForm .= '<input name="' . $name . '" type="hidden" value=\'' . $value . '\' />';
}
$htmlForm .= '<button type="submit" class="btn btn-success"> <i class="fab fa-cc-mastercard"></i> <i class="fab fa-cc-visa"></i> Pay Now</button></form>';

echo $htmlForm;

send_email('ashelembe96@gmail.com', "$email", "$name_person", 'Test transcation', "Hello $name_person, We're notifying you that your test has been recieved
  
  <br>Total: R $total 
  <br><br><a href='https://gconnex.000webhostapp.com/'>Go to Finetrades</a>");

}

if (isset($_POST['remove_from_cart'])) {
    $id = $_POST['id'];
    unset($_SESSION["p$id"]);

    include("calculate-total.php");
    // redirect_back();
    echo("R Total $total");

    echo("<div class='mb-3'>
    <form action='load-page.php' method='post'>

    <div class='m-3'>
    <label for='formGroupExampleInput2' class='form-label'>Email</label>
    <input type='email' name='checkout_email' class='form-control' id='formGroupExampleInput2' placeholder='Enter your email address' required>
    <input type='submit' class='m-3 btn btn-outline-success' name='pay_now' value='Place My Order'>
    </form>
    </div>
    ");
    
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
<script>
    if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</html>