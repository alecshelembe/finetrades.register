<!--EXAMPLE 1 CREATING/DECLEARING VARIABLES-->
<?php
$txt ="Hello World!";
$x = 5;
$y = 10.5;

?>

<!--EXAMPLE 2 OUTPUT VARIABLES-->
<?php
$txt = "Rocks";
echo "Tiny $txt!";
?>

<!--EXAMPLE 2 OUTPUT VARIABLES 2-->
<?php
$txt = "Rocks";
echo "Tiny" . $txt . "!";
?>

<!--EXAMPLE 3 OUTPUT THE SUM OF 2 VARIABLES-->
<?php
$x = 5;
$y = 4;
echo $x + $y;
?>

<!--EXAMPLE 4.1 VARIABLE WITH GLOBAL SCOPE-->
<?php
$x = 5; //global scope

function myTest() {
    //using x inside this function will generate an error 
    echo "<p>Variable x inside function is: $x</p>";
}
myTest();

echo "<p>Variable x outside function is: $x</p>";
?>

<!--EXAMPLE 4.2 VARIABLE WITH LOCAL SCOPE-->
<?php
function myTest() {
    $x = 5;//local scope
    echo "<p>Variable x inside function is: $x</p>";
}
myTest();

//using x outside the function will generate an error 
echo "<p>Variable x outside function is: $x</p>";
?>

<!--EXAMPLE 4.2.1 GLOBAL KEYWORD-->
<?php
$x = 5;
$y = 10;
function myTest() {
    global $x, $y;
    $y = $x + $y;
}

myTest();
echo $y; //output 15
?>

<!--EXAMPLE 4.2.2 $GLOBALS[index]-->
<?php
$x = 5;
$y = 10;

function myTest() {
    $GLOBALS['y'] = $GLOBALS['x'] + $GLOBALS['y'];
}

myTest();
echo $y; //outputs 15
?>

<!--EXAMPLE 4.3.1 STATIC KEYWORD-->
<?php
function myTest() {
    static $x = 0;
    echo $x;
    $x++;
}

myTest();
myTest();
myTest();
?>