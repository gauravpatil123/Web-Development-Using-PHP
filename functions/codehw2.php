<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>PHP Week 4</title>
        <link rel="stylesheet" href="codehw2.css">
    </head>
    <body>
        <h1>Code Homework #2 [Functions]</h1>
            <h2 class="challenge-1">1. Challenge: ISBN Validation</h2>
                <div class=isbn-message>
                    <?php

                        //Global Variables
                        $ISBN_CODE = "0399563733";
                        $ISBN_ROOT_URL = "http://www.isbnsearch.org/isbn/";

                        //ISBN Validator Function
                        function isbn_validator($isbn) {
                            /*
                                Input: ISBN code as a string
                                Output: returns boolean true if isbn is valid else returns false
                            */

                            $valid = false;
                            if (strlen($isbn) == 10) {

                                $validator_value = 0;

                                for ($digit = 0, $place = 10; $digit < 10; $digit++, $place--) {

                                    $face = $isbn[$digit];
                                    (($digit == 9 && $face == "X") or ($digit == 9 && $face == "x")) ? $face = 10 : $face = $face;
                                    $validator_value += ((int)$face * $place);

                                }

                                ($validator_value % 11 == 0) ? $valid = true : $valid = false;

                            }

                            return $valid;

                        }

                        //ISBN Message & Link Printer
                        function isbn_validator_message($isbn) {
                            /*
                            Input: Isbn code as a string
                            Output: returns a string that prints message for the isbn validity and 
                                    prints a link to book is the isbn is valid 
                            */

                            global $ISBN_ROOT_URL;
                            $url = "";
                            $valid = isbn_validator($isbn);
                            $out_string = "Checking ISBN: $isbn for validity...</br>";
                            $valid ? $out_string .= "This is a valid ISBN!</br>" : $out_string .= "This is NOT a valid ISBN</br>";
                            $valid ? $url = $ISBN_ROOT_URL .= $isbn : $url .= "";
                            $valid ? $out_string .= "The Book Link:<a class='book-link' href='$url' target='_blank'> $url </a></br>" : $out_string .= "";
                            return $out_string;

                        }

                        echo isbn_validator_message($ISBN_CODE);

                    ?>
                </div>
    
            <h2 class="challenge-2">Challenge 2: Coin Toss</h2>
                <h3>a. Odd Number of Coin Tosses</h3>
                    <div class="challenge-2-a">
                        <?php

                            //Global Variables
                            $HEADS_IMG = "data/heads.jpg";
                            $TAILS_IMG = "data/tails.jpg";

                            //Toss Function 
                            function toss() {
                                // returns ints 0 or 1

                                return mt_rand(0,1);

                            }

                            function multi_toss($num) {
                                /*
                                Input: int number for the number of tosses to be flipped
                                Output: returns array with the results of all the tosses
                                */

                                $tosses = array();
                                for ($toss = 0; $toss < $num; $toss++) {

                                    $flip = toss();
                                    array_push($tosses, $flip);

                                }

                                return $tosses;

                            }

                            function toss_display($num, $start_message="", $end_message="") {
                                /*
                                    Input: number of times to flip the coin, start message if any, end message if any
                                    Output: returns string with html to represent the images for the flipped coins
                                */

                                $flip = multi_toss($num);
                                $out_message = $start_message;
                                
                                for ($times = 0; $times < $num; $times++) {

                                    global $HEADS_IMG;
                                    global $TAILS_IMG;
                                    $coin = "";
                                    ($flip[$times] == 0) ? $coin = $TAILS_IMG : $coin = $HEADS_IMG;
                                    $out_message .= "<img class='coin-face' src='$coin'/>";

                                }

                                $out_message .= $end_message."</br>";
                                return $out_message;

                            }

                            function odd_toss_displays() {
                                /*
                                    returns a string to display all the odd number of coin flips using the toss_display function
                                */

                                $out_string = "";

                                for ($start = 1; $start < 10; $start+=2) {

                                    $start_message = "Flipping a coin $start times...</br>";
                                    $out_string .= toss_display($start, $start_message);

                                }

                                return $out_string;

                            }

                            echo odd_toss_displays();

                        ?>
                    </div>
                <h3>b. Consecutive Two Heads</h3>
                    <div class="challenge-2-b">
                        <?php
                        
                            function consecutive_head_tosses() {
                                /*
                                    returns array of tosses once there have been two consecutive head flips
                                */

                                $last_flip = null;
                                $tosses = array();
                                $consecutive_heads = false;
                                while ($consecutive_heads == false) {

                                    $flip = toss();
                                    array_push($tosses, $flip);
                                    if (($flip == 1) && ($flip == $last_flip)) $consecutive_heads = true;
                                    $last_flip = $flip;

                                }

                                return $tosses;

                            }

                            function consecutive_toss_display($tosses, $num, $start_message="", $end_message="") {
                                /*
                                    Input: Array of toss results, number of flips in the toss result array, 
                                            start message if any, end message if any.
                                    Output: returns a string with the html to represent all the coin flips in the tosses array
                                */

                                $flip = $tosses;
                                $out_message = $start_message;
                                
                                for ($times = 0; $times < $num; $times++) {

                                    global $HEADS_IMG;
                                    global $TAILS_IMG;
                                    $coin = "";
                                    ($flip[$times] == 0) ? $coin = $TAILS_IMG : $coin = $HEADS_IMG;
                                    $out_message .= "<img class='coin-face' src='$coin'/>";

                                }

                                $out_message .= $end_message."</br>";
                                return $out_message;

                            }

                            $start_message = "Beginning the coin flipping...</br>";
                            $flips = consecutive_head_tosses();
                            $num_flips = count($flips);
                            $end_message = "</br>Flipped two heads in a row, in $num_flips flips!";

                            echo consecutive_toss_display($flips, $num_flips, $start_message, $end_message);

                        ?>
                    </div>
        <div class="footer">
            <a class="footer-links" href="/~gpatil/">Return to Homeworks</a>
        </div>
    </body>
</html>
