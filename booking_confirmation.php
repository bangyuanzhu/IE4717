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


            $totalFee = count($seat_code) * 10; // Assuming $10 per seat

            $selectedPaymentMethod = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';

            // Display booking details and payment method selection
            echo "<h2 class='order_history'>Booking Confirmation:</h2>";
            echo "<p class='order_history'>Movie:  $movie_name</p>";
            echo "<p class='order_history'> Cinema: $cinema_name</p>";
            echo "<p class='order_history'> Date and Time: $date_time $timing</p>";
            echo "<p class='order_history'> Selected Seats: " . implode(", ", $seat_code) . "</p>";
            echo "<p class='order_history'> Total Fee: $$totalFee</p>";

            echo "<h4 class='order_history'>Select Payment Method:</h4>";
            echo "<form action='payment_confirmation.php' method='post'>";
            echo "<label for='payment_method' style='color:#e9e7d7;font-size: 20px;margin:5%;'>Payment Method:</label>";
            echo "<select name='payment_method' id='payment_method' required>";
            echo "<option value='Master'>Master</option>";
            echo "<option value='Visa'>Visa</option>";
            echo "<option value='PayLah'>PayLah</option>";
            echo "</select>";
            echo "<input type='hidden' name='user_id' value='$user_id'>";
            echo "<input type='hidden' name='movie_id' value='$movie_id'>";
            echo "<input type='hidden' name='cinema_id' value='$cinema_id'>";
            echo "<input type='hidden' name='date_time' value='$date_time'>";
            echo "<input type='hidden' name='timing' value='$timing'>";
            foreach ($seat_code as $seat) {
                echo "<input type='hidden' name='selected_seats[]' value='$seat'>";
            }
            echo "<input style='margin-left:20px;padding: 5px;'type='submit' value='Continue to Payment'>";
            echo "</form>";

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