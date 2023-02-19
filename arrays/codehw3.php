<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>PHP Week 5</title>
        <link rel="stylesheet" href="codehw3.css">
    </head>
    <body>
        <h1>Code Homework #2 [Functions]</h1>
            <h2 class="challenge-1">1. Challenge: Book lists</h2>
                <div class=books-table-container>
                    <?php

                        //Global Variables
                        $BOOKS_DATA = array();
                        $GOOGLE_SEARCH_QUERY_ROOT = "https://www.google.com/search?q=";

                        //Utility Functions
                        function create_book_details_array($title, $first_name, $last_name, $no_of_pages, $price, $type = "Paperback") {

                            /*
                                Creates and returns associative array with using all the input parameters
                            */

                            $out_array = array(

                                "Title" => $title,
                                "First Name" => $first_name,
                                "Last Name" => $last_name,
                                "Number of Pages" => $no_of_pages,
                                "Type" => $type,
                                "Price" => $price

                            );

                            return $out_array;

                        }

                        function create_books_db() {

                            /*
                                Creates a books data base in an higher dimensional array using individual book arrays
                            */

                            global $BOOKS_DATA;
                            $book1 = create_book_details_array("PHP and MySQL Web Development", "Luke", "Welling", 144, 31.63);
                            $book2 = create_book_details_array("Web Design with HTML, CSS, JavaScript and jQuery", "Jon", "Duckett", 135, 41.23);
                            $book3 = create_book_details_array("PHP Cookbook: Solutions & Examples for PHP Programmers", "David", "Sklar", 14, 40.88);
                            $book4 = create_book_details_array("JavaScript and JQuery: Interactive Front-End Web Development", "Jon", "Duckett", 251, 22.09);
                            $book5 = create_book_details_array("Modern PHP: New Features and Good Practices", "Josh", "Lockhart", 7, 28.49);
                            $book6 = create_book_details_array("Programming PHP", "Kevin", "Tatroe", 26, 28.96);                           
                            array_push($BOOKS_DATA, $book1);
                            array_push($BOOKS_DATA, $book2);
                            array_push($BOOKS_DATA, $book3);
                            array_push($BOOKS_DATA, $book4);
                            array_push($BOOKS_DATA, $book5);
                            array_push($BOOKS_DATA, $book6);
                        }

                        function create_books_table() {

                            /*
                                Creates and returns html to display the created book datastructure
                            */

                            global $BOOKS_DATA;
                            global $GOOGLE_SEARCH_QUERY_ROOT;
                            $search_url = $GOOGLE_SEARCH_QUERY_ROOT;
                            $out_str = "<table class='books-table'><tr>";
                            $out_str .= "<th>Title</th>";
                            $out_str .= "<th>First Name</th>";
                            $out_str .= "<th>Last Name</th>";
                            $out_str .= "<th>Number of Pages</th>";
                            $out_str .= "<th>Type</th>";
                            $out_str .= "<th>Price</th></tr>";

                            foreach($BOOKS_DATA as $book) {

                                $out_str .= "<tr>";
                                
                                foreach($book as $categoty => $value) {

                                    if ($categoty == "Title") {

                                        $out_str .= "<td class='book-title'>";
                                        $encoded_value = urlencode($value);
                                        $search_url .= $encoded_value;
                                        $out_str .= "<a href='$search_url' target=_blank>$value</a>";

                                    } else {

                                        $out_str .= "<td>";
                                        $out_str .= $value;

                                    }
                                    $out_str .= "</td>";

                                }

                                $out_str .= "</tr>";

                            }

                            $out_str .= "</table>";

                            return $out_str;

                        }

                        function calculate_total_price() {

                            /*
                                Calculates and returns the total price of all the books in the created books data structure
                            */

                            global $BOOKS_DATA;
                            $total = 0;

                            foreach($BOOKS_DATA as $book) {

                                $total += $book["Price"];

                            }

                            return $total;

                        }

                        function display_total_price($total) {

                            /*
                                Input: Total price as int
                                Displays the html for total price
                            */

                            $out_str = "<div class='total-price'>Your Total Price is: \$$total</div>";
                            echo $out_str;

                        }

                        create_books_db();
                        $books_table = create_books_table();
                        echo $books_table;
                        $total_price = calculate_total_price();
                        display_total_price($total_price);


                    ?>
                </div>
    
            <h2 class="challenge-2">Challenge 2: Coin Toss</h2>
                <h3>a. N-Consecutive Heads</h3>
                    <div class="challenge-2-a">
                        <?php

                            //Global variables
                            $HEADS_IMG = "data/heads.jpg";
                            $TAILS_IMG = "data/tails.jpg";
                            $N_CONSECUTIVE_HEADS = 6;

                            //Toss Function 
                            function toss() {

                                return mt_rand(0,1);

                            }

                            function n_cosecutive_heads($num_heads) {

                                /*
                                    Input: Number of consecutive heads wanted
                                    Output: Returns an array of tosses once n consecutive heads are flipped
                                */

                                $tosses = array();
                                $straight_heads = 0;

                                while ($num_heads != $straight_heads) {

                                    $flip = toss();
                                    array_push($tosses, $flip);
                                    ($flip == 0) ? $straight_heads = 0 : $straight_heads += 1;

                                }

                                return $tosses;

                            }

                            function consecutive_toss_display($tosses, $start_message="", $end_message="") {
                                /*
                                    Input: Array of toss results, start message if any, end message if any.
                                    Output: returns a string with the html to represent all the coin flips in the tosses array
                                */

                                global $HEADS_IMG;
                                global $TAILS_IMG;
                                $out_message = $start_message;
                                
                                foreach ($tosses as $toss) {

                                    $coin = "";
                                    ($toss == 0) ? $coin = $TAILS_IMG : $coin = $HEADS_IMG;
                                    $out_message .= "<img class='coin-face' src='$coin'/>";

                                }

                                $out_message .= $end_message."<br>";
                                return $out_message;

                            }

                            $start_message = "Beginning the coin flipping, looking for $N_CONSECUTIVE_HEADS heads in a row...</br>";
                            $flips = n_cosecutive_heads($N_CONSECUTIVE_HEADS);
                            $num_flips = count($flips);
                            $end_message = "</br>Flipped $N_CONSECUTIVE_HEADS heads in a row, in $num_flips flips!";

                            echo consecutive_toss_display($flips, $start_message, $end_message);
                        
                        ?>
                    </div>
        <div class="footer">
            <a class="footer-links" href="/~gpatil/">Return to Homeworks</a>
        </div>
    </body>
</html>