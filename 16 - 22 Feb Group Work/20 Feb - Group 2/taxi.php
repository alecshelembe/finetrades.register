<?php
    // variables
    $seats = 15;
    $amtDue = 25;
    $i = 0;
    $totAmt = 0;
    $totDue = 375;
    $er = 0;

    // arrays
    $pngsPay = array(25, 25, 25, 25, 25, 30, 25, 25, 25, 25, 25, 25, 25, 25, 25, 25);

    //variable Boolean
    $check = true;

    //condition while loop
    while ($i < $seats)
    {
        //if statement
        if ($amtDue === $pngsPay[$i])
        {
            $totAmt += $pngsPay[$i];
            $i++;
        }
        else
        {
            $totAmt += $pngsPay[$i];
            $i++;
            $er = $i;
        }
    }

    if ($totAmt < $totDue)
    {
        $check = false;
    }
    
    //condition boolean
    if ($check === true)
    {
        echo "Total Amount Due is R" . $totAmt . ".00";
    }
    else
    {
        echo "Passenger  no. " . $er + 1 . ", Please Pay R" . $amtDue . ".00 since total amount is only R" . $totAmt . ".00" ;
    }
?>
