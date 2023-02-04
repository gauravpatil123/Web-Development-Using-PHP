<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>PHP Week 3</title>
        <link rel="stylesheet" href="codehw1.css">
    </head>
    <body>
        <h1>Code Homework #1 [Variables, expressions, and control flow]</h1>
            <h2 class="challenge-1">Challenge 1: Correct Change</h2>
                <div>
                    <?php
                    
                        // UTILITY FUNCTIONS FOR DOING CHANGE OPERATIONS

                        function fit($change, $denomination_value) {
                            /*
                            Input: value of change in cents,
                                    denomination to fit
                            Output: number of denominations that fit the change
                            */

                            return ($change - ($change % $denomination_value)) / $denomination_value;

                        }

                        function remainder_cents($change, $fit_denomination, $denomination_value) {
                            /*
                            Input: value of change,
                                    number of denominations,
                                    value of denomination
                            Output: Remaining change in cents after the equivalent denomination value is deducted 
                            */

                            return $change - ($fit_denomination * $denomination_value);

                        }

                        function display_change($dollars, $quarters, $dimes, $nickels, $cents) {
                            // Sting bulider function that build string using consecutive ternary operations & prints the desired output

                            $out_string = "";
                            ($dollars == 0) ? $out_string .= "" : (($dollars > 1) ? $out_string .= $dollars." dollars" : $out_string .= $dollars." dollar");
                            ($quarters == 0) ? $out_string .= "" : (($quarters > 1) ? $out_string .= ", ".$quarters." quarters" : $out_string .= ", ".$quarters." quarter");
                            ($dimes == 0) ? $out_string .= "" : (($dimes > 1) ? $out_string .= ", ".$dimes." dimes" : $out_string .= ", ".$dimes." dime");
                            ($nickels == 0) ? $out_string .= "" : (($nickels > 1) ? $out_string .= ", ".$nickels." nickels" : $out_string .= ", ".$nickels." nickel");
                            ($cents == 0) ? $out_string .= "" : (($cents > 1) ? $out_string .= " & ".$cents." cents" : $out_string .= " & ".$cents." cent");
                            $out_string .= ".";
                            return $out_string;

                        }

                        // SETTING DENOMINATION VALUES
                        $DOLLAR = 100;
                        $QUARTER = 25;
                        $DIME = 10;
                        $NICKEL = 5;
                        $CHANGE_DUE = 159;

                        $message_class = "change-message";
                        echo "<div class=$message_class>You are due $CHANGE_DUE cents back in change total.</div>";

                        // Fitting the change in respective denominations
                        $dollars = fit($CHANGE_DUE, $DOLLAR);
                        $remaining_change = remainder_cents($CHANGE_DUE, $dollars, $DOLLAR);
                        $quarters = fit($remaining_change, $QUARTER);
                        $remaining_change = remainder_cents($remaining_change, $quarters, $QUARTER);
                        $dimes = fit($remaining_change, $DIME);
                        $remaining_change = remainder_cents($remaining_change, $dimes, $DIME);
                        $nickels = fit($remaining_change, $NICKEL);
                        $remaining_change = remainder_cents($remaining_change, $nickels, $NICKEL);

                        $change_message = display_change($dollars, $quarters, $dimes, $nickels, $remaining_change);

                        echo "<div class=$message_class>".$change_message."</div>";

                    ?>
                </div>
    
            <h2 class="challenge-2">Challenge 2: 99 Bottles of Beer</h2>
                <div class="song-lyrics">
                    <?php

                        // Setting the start value for song lyrics
                        $start_value = 99;

                        for ($initial_value = $start_value; $initial_value > 0; $initial_value--) {

                            // For loop ot print the song

                            $is_even = ($initial_value % 2 == 0) ? "even" : "odd";
                            $out_string = "$initial_value bottles of beer on the wall, $initial_value bottle of beer.</br>";
                            $new_value = $initial_value - 1;
                            $out_string .= "Take one down, pass it around, $new_value bottles of beer on the wall.";
                            echo "<div class='$is_even'>$out_string</div>";

                        }

                    ?>
                </div>
        <div class="footer">
            <a class="footer-links" href="/~gpatil/">Return to Homeworks</a>
        </div>
    </body>
</html>