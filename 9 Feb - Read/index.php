<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- comment will not run code but will show is source code -->
    <!-- <h1> uncomment to see this CRT + "/" </h1> -->
    <h1>Crud Operations</h1>
    <h2>Create / Insert</h2>

    <!-- Information from the form will go to "action address" -->
    <form action="load-page.php" method="GET">
        <label for="First Name">First name:</label>
        <input type="text" placeholder="Name" name="name"><br><br>
        <label for="Email">Email:</label>
        <input type="text" placeholder="Email" name="email"><br><br>
        <label for="Password">Password:</label>
        <input type="text" placeholder="Password" name="password"><br><br>
        <!-- <label for="fname">Confirm Password:</label> -->
        <!-- <input type="text" name="fname"><br><br> -->
        <input type="submit" value="Submit">
    </form>
    <h2>Read</h2>
    <form action="load-page.php" method="GET">
        
        <label for="Email">Email:</label>
        <input type="text" placeholder="Search" name="find_email"><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>