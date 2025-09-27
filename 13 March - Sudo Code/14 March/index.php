<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" 
    crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<form action= "load-page.php" method = "POST" enctype="multipart/form-data" onSubmit="return validate()">
    <div class="mb-3 container pt-7 bg-light text-black">"
        <label for="name" class="form-label">Name</label>
            <input type="text" name="name"  class="form-control" id="name" aria-describedby="nameHelp">
        <label for="username" class="form-label">Username </label>
            <input type="text" name="username"  class="form-control" id="username" aria-describedby="nameHelp">
        <label for="email" class="form-label">Email </label>
            <input type="text" name="email"  class="form-control" id="email" aria-describedby="nameHelp">  
        <label for="password" class="form-label">Password </label>
            <input type="text" name="password"  class="form-control" id="password" aria-describedby="nameHelp">
        <label for="confirmpassword" class="form-label">Confirm Password</label>
            <input type="text" name="confirmpassword"  class="form-control" id="confirmpassword" aria-describedby="nameHelp">
            
            <button type="submit">submit</button>
    </div>
</form>
    
</body>
<script>
    function validate(){

   
    var password = document.getElementById('password').value;
    var confirmpassword = document.getElementById('confirmpassword').value;

    if(password !== confirmpassword) {
        alert("Passwords Do Not Match!!");
        return false;
    }

}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" 
crossorigin="anonymous"></script>
</html>