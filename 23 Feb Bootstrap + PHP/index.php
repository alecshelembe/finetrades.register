<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<style>
    .form-group{
        margin: 20px;
        margin-bottom: 30px;
    }
</style>
</head>
<body>
<form class="container mt-5" onsubmit="return validate()" action="load-page.php" enctype="multipart/form-data" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="p_key" id="cpassword" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1"> Confirm Password</label>
    <input type="password" name="p_key2" id="cpassword2" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password">
  </div>
  <div class="form-group">
    <label> Upload Image</label>
    <input type="file" accept="image/*" name="image">
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

</body>
<script>
    function validate(){
        var cpassword = document.getElementById('cpassword').value;
        var cpassword2 = document.getElementById('cpassword2').value;
        if( cpassword !==  cpassword2){
            alert("Passwords do not match");
            return false;
        } else{
            return true;
        }
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </html>