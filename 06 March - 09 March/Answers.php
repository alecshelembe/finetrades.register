<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Document</title>
</head>
<body class="container mt-5">
    <p class="lead"> 06 March - 08 March</p>
    <p class="h2">Practicing PHP and Javascript</p>
    <ol>
        <li>Create a new PHP page</li>
        <li>Create a function for each loop so the user can input their own values</li>
        <li><strong> Please upload your work to your student folder</strong></li>
    </ol>
    <p class="h2">Loops (using a Loop) php or javascript</p>
    <?php

        $x = 0;
        while($x < 10){
            echo"$x";
            // increment 
            $x++;
        }

        echo"<br>";
        echo"<br>";
        
        function while_loop($start_num,$end_num){
            while($start_num < $end_num){
                echo"$start_num";
                // echo"<br>";
                // increment 
                $start_num++;
            }
        }
        
        while_loop(0,20000);

        echo"<br>";
        echo"<br>";

        echo "Forloop";
         for ($i = 1; $i <= 10; $i++)
            {
                echo "$i";
            }

            function for_loop($s_num, $e_num, $in){
                for ($s_num = 1; $s_num <= $e_num; $s_num+=$in)
                    {
                        echo "$s_num";
                    }
                }
            echo "<br>Function forloop";
            for_loop(1,20,2);
        ?>

<p> write 1 - 10</p> 
<p> write 1 - 10000</p>  
    <!-- <p class="h2">Function with Loops</p> -->
    <p class="h2">Write a switch statement </p>
    <p> if a: choose somalia </p>  
    <p> if b: choose Kenya </p>  
    <p> if c: return false </p>  
    <?php
    $x = "d";

    switch($x){
        case "a":
            echo "Somalia";
            break;
            case "b":
                echo "Kenya";
            break;

            default:
            echo "false";
    }

   
    ?>
    <p class="h2">Write an Array </p>
    <p> for cars store (BMW, Audi, Toyota)</p>
    <p> for Countries store (Congo, Somalia, Kenya)</p>
    <p> output 1:2 </p>
<?php
 $cars = array("BMW", "Audi", "Toyota");
 echo $cars[1]. " and " . $cars[2] . ".";

 $countries = array("Congo", "Somalia", "Kenya");
     echo $countries[1] . " and " . $countries[2] . ".";
?>
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</html>