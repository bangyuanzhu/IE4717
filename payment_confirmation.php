<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lao~X Cinema - Home</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="image/png" href="image/logo.png"/>
</head>
<body>
    <div id="wrapper">
        <header>
            <div class="logo_margin">
                <img id='company_logo' src="image/logo.png" alt="logo" height="100%" class="logo">
            </div>            
        </header>
            <nav>
                <table class="nav" border="0" cellspacing="0">
                    <tr>
                        <td>
                            <a href="index.html">Home</a>
                        </td>
                        <td>
                            <a class="active" href="movies.html">Movies</a>
                        </td>
                        <td>
                            <a href="cinema.html">Cinemas</a>
                        </td>
                        <td>
                            <a href="cart.php">Orders</a>
                        </td>
                        <td>
                            <a href="login.html">Login/Register</a>
                        </td>                   
                    </tr>
                </table>
            </nav>
        <?php

            $servername ="localhost";
            $username = "f32ee";
            $password = "f32ee";
            $dbname = "f32ee";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Get selected movie, cinema, date_time, and timing

            $user_id = $_POST["user_id"];
            $movie_id = $_POST["movie_id"];
            $cinema_id = $_POST["cinema_id"];
            $date_time = $_POST["date_time"];
            $timing = $_POST['timing'];
            $seat_code = $_POST['selected_seats'];
            $selectedPaymentMethod = $_POST['payment_method'];
            $totalFee = count($seat_code) * 10; // Assuming $10 per seat

            $movie_names = array(
                1 => "Freelance",
                2 => "Oppenheimer",
                3 => "Creation Of The Gods I: Kingdom Of Storms",
                4 => "Oppenheimer",
            );
            $movie_name = $movie_names[$movie_id];

            $cinema_names = array(
                1 => "Lao~X Theatre VivoCity",
                2 => "Lao~X Theatre Jurong Point",
                3 => "Lao~X Theatre Tiong Bahru",
            );
            $cinema_name = $cinema_names[$cinema_id];


            foreach ($seat_code as $seat) {
                $sql = "INSERT INTO ticketorders (movie_id, userid, cinema_id, seat, dayofweek, timing, payment)
                        VALUES ($movie_id, '$user_id', $cinema_id, '$seat', '$date_time', '$timing', '$selectedPaymentMethod')";
                
                $upd = "UPDATE availability SET booking_status = 1 WHERE cinema_id = $cinema_id AND movie_id = $movie_id AND date_time = '$date_time' AND timing = '$timing' AND seat_code = '$seat'";

                if ($conn->query($sql) !== true) {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                if ($conn->query($upd) !== true) {
                    echo "Error: " . $upd . "<br>" . $conn->error;
                }
            }
            $to = 'f32ee@localhost';
            $subject = 'Booking Confirmation';
            $message = "Movie: $movie_name\n
                        Cinema: $cinema_name\n
                        Date and Time: {$date_time} {$timing}\n
                        Selected Seats: " . implode(", ", $seat_code) . "\n
                        Total Fee: $$totalFee\n
                        Payment Method: $selectedPaymentMethod";

            $headers = 'From: f32ee@localhost' . "\r\n" .
            'Reply-To: f32ee@localhost' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            mail($to, $subject, $message, $headers,'-ff32ee@localhost');

            echo "<h2 class='order_history'>Booking Confirmation:</h2>";
            echo "<p class='order_history'>Movie:$movie_name</p>";
            echo "<p class='order_history'>Cinema: $cinema_name</p>";
            echo "<p class='order_history'>Date and Time: $date_time $timing</p>";
            echo "<p class='order_history'>Selected Seats: " . implode(", ", $seat_code) . "</p>";
            echo "<p class='order_history'>Total Fee: $$totalFee</p>";
            echo "<p class='order_history'>Payment Method: $selectedPaymentMethod</p>";
            echo "<p class='order_history'>Your booking has been confirmed.</p>";
        ?>
        <div class="push"></div>
        <footer class="footer">
            <table>
                <tr>
                    <td><small><b>Terms and Conditions</b></small></a></td>
                </tr>
                <tr>
                    <td><small><i>By using our servicces, you hereby agree to these terms. When you 
                        access this website, you acknowledge that you <br>have read and agree to abide by 
                        the terms described. If you do not agree to the terms, 
                        you should exit this site. <br>Lao~X Cinema</i></small>                      
                     </td>
                </tr>
            </table>
         </footer>
    </div>

</body>
</html>
    